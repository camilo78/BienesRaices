@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <div class="breadcrumbs" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content left">
                        <h1 class="page-title">{{trans('messages.Latest News & Blog')}}</h1>
                        <p>{{trans('messages.blog_message')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content right">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                            <li>{{trans('messages.Blog')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section blog-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12">
                    @foreach($posts as $post)
                    <div class="single-list">
                        <div class="post-thumbnils">
                            @if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image)
                                <img src="{{Storage::url('posts/'.$post->image)}}" alt="{{$post->title}}">
                            @endif
                        </div>
                        <div class="post-details">
                            <div class="detail-inner">
                                <h2 class="post-title">
                                    <a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a>
                                </h2>

                                <ul class="custom-flex post-meta">
                                    <li>
                                        <a href="{{ route('blog.author',$post->user->username) }}" class="btn-flat">
                                            <i class="lni lni-user"></i>
                                            <span>{{$post->user->name}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn-flat disabled">
                                            <i class="lni lni-calendar"></i>
                                            <span class="text-capitalize">{{$post->created_at->diffForHumans()}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        @foreach($post->categories as $key => $category)
                                            <a href="{{ route('blog.categories',$category->slug) }}" class="btn-flat">
                                                <i class="lni lni-folder"></i>
                                                <span>{{$category->name}}</span>
                                            </a>
                                        @endforeach
                                    </li>
                                    <li>
                                        @foreach($post->tags as $key => $tag)
                                            <a href="{{ route('blog.tags',$tag->slug) }}" class="btn-flat">
                                                <i class="lni lni-tag"></i>
                                                <span>{{$tag->name}}</span>
                                            </a>
                                        @endforeach
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.show',$post->slug) . '#comments' }}" class="btn-flat">
                                            <i class="lni lni-comments"></i>
                                            <span>{{$post->comments_count}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn-flat disabled">
                                            <i class="far fa-eye"></i>
                                            <span>{{$post->view_count}}</span>
                                        </a>
                                    </li>
                                </ul>
                                {!! str_limit($post->body,120) !!}
                                <div class="button">
                                    <a href="{{ route('blog.show',$post->slug) }}" class="btn mouse-dir white-bg">{{ trans('messages.Read More') }}<span class="dir-part"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="pagination center">
                        {{ $posts->appends(['month' => Request::get('month'), 'year' => Request::get('year')])->links() }}
                    </div>

                </div>
               @include('pages.blog.sidebar')
            </div>
        </div>
    </section>



@endsection

@section('scripts')

@endsection