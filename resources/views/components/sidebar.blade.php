{{-- Sidebar Component --}}
@props([
    'showSearch' => true,
    'showCategories' => true,
    'showRecent' => true,
    'categories' => [],
    'recentPosts' => [],
    'categoryRoute' => 'berita.index',
    'postRoute' => 'berita.show'
])

<div {{ $attributes->merge(['class' => 'side-block px-20 py-10 bg-white']) }}>
    {{-- Search Widget --}}
    @if($showSearch)
        <div class="widget courses-search-bx placeholdertx mb-30">
            <form method="GET" action="{{ url()->current() }}">
                <div class="form-group">
                    <label class="form-label">Cari...</label>
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" 
                               placeholder="Ketik kata kunci..." 
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif

    {{-- Categories Widget --}}
    @if($showCategories && count($categories) > 0)
        <div class="widget clearfix mb-30">
            <h4 class="pb-15 mb-15 bb-1">Kategori</h4>
            <div class="media-list media-list-divided">
                @foreach($categories as $cat)
                    <a class="px-0 media media-single" href="{{ route($categoryRoute, ['category' => $cat['name']]) }}">
                        <span class="title ms-0">{{ $cat['name'] }}</span>
                        <span class="mx-0 badge badge-secondary-light">{{ $cat['count'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Recent Posts Widget --}}
    @if($showRecent && count($recentPosts) > 0)
        <div class="widget clearfix">
            <h4 class="pb-15 mb-25 bb-1">Terbaru</h4>
            @foreach($recentPosts as $post)
                <div class="recent-post clearfix mb-20">
                    @if(isset($post['image']) && $post['image'])
                        <div class="recent-post-image">
                            <img class="img-fluid bg-primary-light" 
                                 src="{{ $post['image'] }}" 
                                 alt="{{ $post['title'] }}">
                        </div>
                    @endif
                    <div class="recent-post-info">
                        <a href="{{ route($postRoute, $post['slug']) }}">
                            {{ \Illuminate\Support\Str::limit($post['title'], 60) }}
                        </a>
                        @if(isset($post['date']) && $post['date'])
                            <span>
                                <i class="fa fa-calendar-o"></i> {{ $post['date'] }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    {{-- Custom Content Slot --}}
    {{ $slot }}
</div>
