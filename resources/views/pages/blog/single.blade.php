@extends('frontend.layouts.app')
@section('style')
@endsection
@section('metas')
<meta property="og:url" content="{{url()->current()}}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ $post->title }}"/>
<meta property="og:description" content="{!! str_limit($post->body,120) !!}"/>
<meta property="og:image" content="{{Storage::url('posts/'.$post->image)}}"/>
@endsection
@section('content')
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s);
js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="breadcrumbs" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content left">
                    <h1 class="page-title">{{ $post->title }}</h1>
                    <p>{!! str_limit($post->body,120) !!}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content right">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                        <li><a href="{{ route('blog') }}">{{ trans('messages.Blog') }}</a></li>
                        <li>{{ str_limit($post->title,42) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section blog-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-12">
                <div class="post-thumbnils">
                    @if(Storage::disk('public')->exists('posts/'.$post->image))
                    <img src="{{Storage::url('posts/'.$post->image)}}" alt="{{$post->title}}">
                    @endif
                </div>
                <div class="post-details">
                    <div class="detail-inner">
                        <h2 class="post-title">
                        <a href="#">{{ $post->title }}</a>
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
                        {!! $post->body !!}
                        <div class="post-tags-media">
                            <div class="post-tags popular-tag-widget mb-xl-40">
                                <h5 class="tag-title">{{ trans('messages.Tags') }}</h5>
                                <div class="tags">
                                    @foreach($post->tags as $key => $tag)
                                    <a href="{{ route('blog.tags',$tag->slug) }}">{{$tag->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="post-social-media">
                                <h5 class="share-title">{{ trans('messages.Social Share') }}</h5>
                                <!-- Your share button code -->
                                <div class="fb-share-button"
                                    data-href="{{url()->current()}}"
                                    data-layout="button_count">
                                </div>
                                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"
                                data-show-count="false">Tweet</a>
                                <script async src="https://platform.twitter.com/widgets.js"
                                charset="utf-8"></script>
                            </div>
                        </div>
                        <div class="detail-post-navigation">
                            <div class="prev-post">
                                @if($previous)
                                <span><i class="lni lni-arrow-left"></i>{{ trans('messages.Prev Post') }}</span>
                                <a href="{{ $previous->slug }}">{{ $previous->title }}</a>
                                @endif
                            </div>
                            <div class="next-post">
                                @if($next)
                                <span>{{ trans('messages.Next Post') }} <i
                                class="lni lni-arrow-right"></i></span>
                                <a href="{{ $next->slug }}">{{ $next->title }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-comments">
                    <h3 class="comment-title">{{ $post->comments_count }} {{ trans('messages.Comments') }}</h3>
                    <ul class="comments-list">
                        @foreach($post->comments as $comment)
                        @if($comment->parent_id == null)
                        <li>
                            <div class="comment-img">
                                <img src="{{  $comment->users->image ? Storage::url('users/'.$comment->users->image) : asset('/assets/images/no_imagen.png') }}" class="rounded-circle" alt="img">
                            </div>
                            <div class="comment-desc mb-2">
                                <div class="desc-top">
                                    <h6>{{ $comment->users->name }}</h6>
                                    <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                                    @auth
                                    <span class="right replay reply-link d-none d-sm-block" data-commentid="{{ $comment->id }}"><i class="lni lni-reply"></i> {{ trans('messages.Reply') }}</span>
                                    @endauth
                                </div>
                                <p>
                                    {{ $comment->body }}
                                </p>
                            </div>
                            <div id="comment-{{$comment->id}}"></div>
                        </li>
                        @endif
                        @if($comment->children->count() > 0)
                        @foreach($comment->children as $comment)
                        <li class="children">
                            <div class="comment-img">
                                <img src="{{  $comment->users->image ? Storage::url('users/'.$comment->users->image) : asset('/assets/images/no_imagen.png') }}" class="rounded-circle" alt="img">
                            </div>
                            <div class="comment-desc">
                                <div class="desc-top">
                                    <h6>{{ $comment->users->name }}</h6>
                                    <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p>
                                    {{ $comment->body }}
                                </p>
                            </div>
                        </li>
                        @endforeach
                        @endif
                        @endforeach
                    </ul>
                </div>
                @auth
                <div class="comment-form">
                    <h3 class="comment-reply-title">{{ trans('messages.Post Comments') }}</h3>
                    <form action="{{ route('blog.comment',$post->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent" value="0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-box form-group">
                                    <textarea name="body" rows="6" class="form-control form-control-custom"
                                    placeholder="{{ trans('messages.Type your comments...') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button">
                                    <button type="submit" class="btn mouse-dir white-bg">{{ trans('messages.Post Comment') }} <span
                                    class="dir-part"></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endauth
                @guest
                <div class="comment-form">
                    <h3 class="comment-reply-title">Please Login to comment</h3>
                    <a href="{{ route('login') }}" style="color: #3E54FF" class="btn btn-outline-primary btn-lg rounded-0 btn-login">Login</a>
                </div>
                @endguest
            </div>
            @include('pages.blog.sidebar')
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).on('click', 'span.right.replay', function (e) {
e.preventDefault();
var commentid = $(this).data('commentid');
$('#comment-' + commentid).empty().append(
`<div class="comment-box">
    <form action="{{ route('blog.comment',$post->id) }}" method="POST">
        @csrf
        <input type="hidden" name="parent" value="1">
        <input type="hidden" name="parent_id" value="` + commentid + `">
        <textarea name="body"  class="form-control form-control-custom" placeholder="Leave a comment"></textarea>
        <button type="submit" class="btn btn-primary border-0 mt-3 rounded-0">Comment</button>
    </form>
</div>`
);
});
</script>
@endsection