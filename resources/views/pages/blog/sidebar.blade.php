<aside class="col-lg-4 col-md-5 col-12">
    <div class="sidebar">
        <div class="widget popular-feeds">
            <h5 class="widget-title">{{ trans('messages.Popular Posts') }}</h5>
            <div class="popular-feed-loop">
                @foreach($popularposts as $post)
                    <div class="single-popular-feed">
                        <div class="feed-img animate-img">
                            <a href="{{ route('blog.show',$post->slug) }}">
                                <img src="{{Storage::url('posts/'.$post->image)}}" style=" object-fit: cover;width:75px;height:75px;" alt="{{ $post->title}}">
                            </a>
                        </div>
                        <div class="feed-desc">
                            <h6 class="post-title"><a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}
                                    </a></h6>
                            <span class="time"><i
                                        class="lni lni-calendar"></i> {{$post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="widget categories-widget">
            <h5 class="widget-title">{{ trans('messages.Archives') }}</h5>
            <ul class="custom">
                @foreach($archives as $stats)
                    <li>
                        <a style="border-bottom: 2px solid #3e54ff;" href="{{route('blog')}}?month={{ $stats['month'] }}&year={{ $stats['year'] }}">
                            {{ $stats['month'] . ' ' . $stats['year'] }}
                            <span class="rounded-0 border-0">{{ $stats['published'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="widget categories-widget">
            <h5 class="widget-title">{{ trans('messages.Categories') }}</h5>
            <ul class="custom">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('blog.categories',$category->slug) }}">
                            {{ $category->name }}
                            <span>{{ $category->posts_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="widget popular-tag-widget">
            <h5 class="widget-title">{{ trans('messages.Popular Tags') }}</h5>
            <div class="tags">
                @foreach($tags as $tag)
                    <a href="{{ route('blog.tags',$tag->slug) }}">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="widget social-widget">
            <h5 class="widget-title">{{ trans('messages.Follow Us') }}</h5>
            <ul class="custom-flex">
                @foreach($settings as $setting)
                    <li><a href="{{$setting->facebook}}"><i class="lni lni-facebook-filled"></i></a></li>
                    <li><a href="{{$setting->twitter}}"><i class="lni lni-twitter-original"></i></a></li>
                    <li><a href="{{$setting->linkedin}}"><i class="lni lni-instagram-original"></i></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</aside>

