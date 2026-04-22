{{-- Page Header Component --}}
@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumbs' => [],
    'backgroundImage' => null,
    'overlay' => true
])

<section class="pt-150 pb-20 @if($backgroundImage) bg-img @endif" 
         @if($backgroundImage) style="background-image: url('{{ $backgroundImage }}')" @endif>
    @if($backgroundImage && $overlay)
        <div class="overlay" style="background: rgba(0,0,0,0.5);"></div>
    @endif
    
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    @if(count($breadcrumbs) > 0)
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center bg-transparent">
                                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="@if($backgroundImage) text-white @endif">Home</a></li>
                                @foreach($breadcrumbs as $crumb)
                                    @if($loop->last)
                                        <li class="breadcrumb-item active @if($backgroundImage) text-white @endif" aria-current="page">{{ $crumb['title'] }}</li>
                                    @else
                                        <li class="breadcrumb-item">
                                            <a href="{{ $crumb['url'] }}" class="@if($backgroundImage) text-white @endif">{{ $crumb['title'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif
                    
                    <h2 class="page-title @if($backgroundImage) text-white @else text-black @endif">{{ $title }}</h2>
                    
                    @if($subtitle)
                        <p class="@if($backgroundImage) text-white-50 @else text-muted @endif fs-16 mt-10">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
