<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    private $serverKey;
    private $clientKey;
    private $isProduction;
    private $apiUrl;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.server_key');
        $this->clientKey = config('services.midtrans.client_key');
        $this->isProduction = config('services.midtrans.is_production');
        $this->apiUrl = $this->isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }

    /**
     * Create Snap Token
     */
    public function createSnapToken($kodePendaftaran)
    {
        try {
            $pendaftaran = Pendaftaran::where('kode_pendaftaran', $kodePendaftaran)
                ->with('jurusan')
                ->firstOrFail();

            if ($pendaftaran->isPaid()) {
                return response()->json([
                    'error' => 'Pembayaran sudah lunas'
                ], 400);
            }

            // Generate unique order ID
            $orderId = 'PD-' . $pendaftaran->kode_pendaftaran . '-' . time();

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $pendaftaran->biaya_pendaftaran,
                ],
                'item_details' => [
                    [
                        'id' => 'BIAYA_PENDAFTARAN',
                        'price' => $pendaftaran->biaya_pendaftaran,
                        'quantity' => 1,
                        'name' => 'Biaya Pendaftaran SMK Tamansiswa',
                    ]
                ],
                'customer_details' => [
                    'first_name' => $pendaftaran->nama_lengkap,
                    'email' => $pendaftaran->email,
                    'phone' => $pendaftaran->no_hp_siswa,
                ],
                'callbacks' => [
                    'finish' => url('/payment/finish/' . $pendaftaran->kode_pendaftaran),
                ]
            ];

            $response = Http::withBasicAuth($this->serverKey, '')
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post($this->apiUrl, $params);

            Log::info('Midtrans API Response Status: ' . $response->status());
            Log::info('Midtrans API Response Body: ' . $response->body());

            if ($response->successful()) {
                $result = $response->json();
                
                // Save order ID
                $pendaftaran->update([
                    'midtrans_order_id' => $orderId,
                ]);

                return response()->json([
                    'snap_token' => $result['token'],
                    'client_key' => $this->clientKey,
                ], 200, [
                    'Content-Type' => 'application/json'
                ]);
            } else {
                Log::error('Midtrans Error Response: ' . $response->body());
                $errorMessage = $response->json()['error_messages'][0] ?? 'Gagal membuat transaksi';
                return response()->json([
                    'error' => $errorMessage
                ], 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Midtrans Exception: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500, [
                'Content-Type' => 'application/json'
            ]);
        }
    }

    /**
     * Notification handler dari Midtrans
     */
    public function notificationHandler(Request $request)
    {
        try {
            $notif = $request->all();
            
            $orderId = $notif['order_id'];
            $statusCode = $notif['status_code'];
            $grossAmount = $notif['gross_amount'];
            $transactionStatus = $notif['transaction_status'];
            $fraudStatus = $notif['fraud_status'] ?? 'accept';

            // Verify signature
            $signatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $this->serverKey);
            
            if ($signatureKey !== $notif['signature_key']) {
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            // Find pendaftaran
            $pendaftaran = Pendaftaran::where('midtrans_order_id', $orderId)->first();

            if (!$pendaftaran) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Update status based on transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $pendaftaran->update([
                        'status_pembayaran' => 'paid',
                        'midtrans_transaction_id' => $notif['transaction_id'],
                        'paid_at' => now(),
                        'status_pendaftaran' => 'verifikasi_dokumen',
                    ]);
                }
            } else if ($transactionStatus == 'settlement') {
                $pendaftaran->update([
                    'status_pembayaran' => 'paid',
                    'midtrans_transaction_id' => $notif['transaction_id'],
                    'paid_at' => now(),
                    'status_pendaftaran' => 'verifikasi_dokumen',
                ]);
            } else if ($transactionStatus == 'pending') {
                $pendaftaran->update([
                    'status_pembayaran' => 'pending',
                    'midtrans_transaction_id' => $notif['transaction_id'],
                ]);
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'cancel') {
                $pendaftaran->update([
                    'status_pembayaran' => 'failed',
                    'midtrans_transaction_id' => $notif['transaction_id'],
                ]);
            } else if ($transactionStatus == 'expire') {
                $pendaftaran->update([
                    'status_pembayaran' => 'expired',
                    'midtrans_transaction_id' => $notif['transaction_id'],
                ]);
            }

            return response()->json(['message' => 'Notification processed']);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }

    /**
     * Halaman setelah pembayaran selesai
     */
    public function paymentFinish($kodePendaftaran)
    {
        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $kodePendaftaran)->firstOrFail();
        return view('pendaftaran.payment-finish', compact('pendaftaran'));
    }

    /**
     * Check payment status
     */
    public function checkStatus($kodePendaftaran)
    {
        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $kodePendaftaran)->firstOrFail();

        return response()->json([
            'status_pembayaran' => $pendaftaran->status_pembayaran,
            'status_pendaftaran' => $pendaftaran->status_pendaftaran,
            'paid_at' => $pendaftaran->paid_at?->format('d M Y H:i'),
        ]);
    }
}
