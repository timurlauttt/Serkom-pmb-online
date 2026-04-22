{{-- Alert Component --}}
@props([
    'type' => 'info', // info, success, warning, danger
    'dismissible' => true,
    'icon' => null,
    'title' => null
])

@php
    $typeClasses = [
        'info' => 'alert-info',
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'danger' => 'alert-danger',
        'primary' => 'alert-primary',
    ];
    
    $iconMap = [
        'info' => 'fa-info-circle',
        'success' => 'fa-check-circle',
        'warning' => 'fa-exclamation-triangle',
        'danger' => 'fa-exclamation-circle',
        'primary' => 'fa-bell',
    ];
    
    $alertClass = $typeClasses[$type] ?? 'alert-info';
    $alertIcon = $icon ?? ($iconMap[$type] ?? 'fa-info-circle');
@endphp

<div {{ $attributes->merge(['class' => "alert {$alertClass}" . ($dismissible ? ' alert-dismissible fade show' : '')]) }} role="alert">
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
    
    <div class="d-flex align-items-start">
        @if($alertIcon)
            <i class="fa {{ $alertIcon }} me-10 fs-20"></i>
        @endif
        
        <div class="flex-grow-1">
            @if($title)
                <h5 class="alert-heading mb-5">{{ $title }}</h5>
            @endif
            
            <div>{{ $slot }}</div>
        </div>
    </div>
</div>
