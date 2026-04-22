{{-- Card Component for News, Events, Announcements --}}
@props([
    'title' => '',
    'slug' => '',
    'route' => '',
    'image' => null,
    'author' => null,
    'date' => null,
    'category' => null,
    'excerpt' => '',
    'horizontal' => false,
    'readMoreText' => 'Selengkapnya'
])

@if($horizontal)
    {{-- Horizontal Card Layout --}}
    <div {{ $attributes->merge(['class' => 'box mb-20']) }}>
        <div class="row g-0">
            <div class="col-md-4 col-12 bg-img h-md-auto h-250" 
                 @if($image) style="background-image: url('{{ $image }}')" @endif>
            </div>
            <div class="col-md-8 col-12">
                <div class="box-body">
                    @if($category)
                        <span class="badge badge-primary mb-10">{{ $category }}</span>
                    @endif
                    
                    <h4>
                        <a href="{{ $route }}">{{ $title }}</a>
                    </h4>
                    
                    @if($author || $date)
                        <div class="d-flex mb-10">
                            @if($author)
                                <div class="me-10">
                                    <i class="fa fa-user me-5"></i> {{ $author }}
                                </div>
                            @endif
                            @if($date)
                                <div>
                                    <i class="fa fa-calendar me-5"></i> {{ $date }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <p>{{ $excerpt }}</p>

                    <div class="flexbox align-items-center mt-3">
                        <a class="btn btn-sm btn-primary" href="{{ $route }}">{{ $readMoreText }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Vertical Card Layout --}}
    <div {{ $attributes->merge(['class' => 'box']) }}>
        @if($image)
            <div class="box-header with-border p-0">
                <img src="{{ $image }}" class="img-fluid" alt="{{ $title }}" style="width: 100%; height: 200px; object-fit: cover;">
            </div>
        @endif
        
        <div class="box-body">
            @if($category)
                <span class="badge badge-primary mb-10">{{ $category }}</span>
            @endif
            
            <h4 class="box-title">
                <a href="{{ $route }}">{{ $title }}</a>
            </h4>
            
            @if($author || $date)
                <div class="d-flex mb-10 text-muted fs-14">
                    @if($author)
                        <div class="me-10">
                            <i class="fa fa-user me-5"></i> {{ $author }}
                        </div>
                    @endif
                    @if($date)
                        <div>
                            <i class="fa fa-calendar me-5"></i> {{ $date }}
                        </div>
                    @endif
                </div>
            @endif

            <p>{{ $excerpt }}</p>
        </div>
        
        <div class="box-footer">
            <a href="{{ $route }}" class="btn btn-sm btn-primary">{{ $readMoreText }}</a>
        </div>
    </div>
@endif
