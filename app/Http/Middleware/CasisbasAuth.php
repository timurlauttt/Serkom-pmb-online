<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CasisbasAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('casisbas_id')) {
            return redirect()->route('pendaftaran.siswa.login');
        }
        return $next($request);
    }
}
