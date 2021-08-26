@extends('frontend.layouts.app')

@section('styles')
    <style>
        #map {
            height: 320px;
        }

        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .jssora106 {
            display: block;
            position: absolute;
            cursor: pointer;
        }

        .jssora106 .c {
            fill: #fff;
            opacity: .3;
        }

        .jssora106 .a {
            fill: none;
            stroke: #000;
            stroke-width: 350;
            stroke-miterlimit: 10;
        }

        .jssora106:hover .c {
            opacity: .5;
        }

        .jssora106:hover .a {
            opacity: .8;
        }

        .jssora106.jssora106dn .c {
            opacity: .2;
        }

        .jssora106.jssora106dn .a {
            opacity: 1;
        }

        .jssora106.jssora106ds {
            opacity: .3;
            pointer-events: none;
        }

        .jssort101 .p {
            position: absolute;
            top: 0;
            left: 0;
            box-sizing: border-box;
            background: #000;
        }

        .jssort101 .p .cv {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            z-index: 1;
        }

        .jssort101 .a {
            fill: none;
            stroke: #fff;
            stroke-width: 400;
            stroke-miterlimit: 10;
            visibility: hidden;
        }

        .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {
            border: none;
            border-color: transparent;
        }

        .jssort101 .p:hover {
            padding: 2px;
        }

        .jssort101 .p:hover .cv {
            background-color: rgba(0, 0, 0, 6);
            opacity: .35;
        }

        .jssort101 .p:hover.pdn {
            padding: 0;
        }

        .jssort101 .p:hover.pdn .cv {
            border: 2px solid #fff;
            background: none;
            opacity: .35;
        }

        .jssort101 .pav .cv {
            border-color: #fff;
            opacity: .35;
        }

        .jssort101 .pav .a, .jssort101 .p:hover .a {
            visibility: visible;
        }

        .jssort101 .t {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            opacity: .6;
        }

        .jssort101 .pav .t, .jssort101 .p:hover .t {
            opacity: 1;
        }
    </style>
@endsection

@section('content')

    <div class="breadcrumbs"
         style="background: url({{Storage::url('property/'.$property->image)}}); background-size: cover;background-repeat: no-repeat; background-position: center"
         data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content left">
                        <h1 class="page-title">{{ $property->title }}</h1>
                        <p><i class="lni lni-map-marker"></i> {{ $property->city }}, {{ $property->address }}</p>
                        <h4 class="text-capitalize"><span class="badge bg-primary rounded-0"><i
                                        class="fas fa-door-open"></i> {{ trans("messages.$property->type") }} {{ trans("messages.for") }} {{ trans("messages.$property->purpose") }}</span>
                            <span class="badge bg-success rounded-0"><i class="fas fa-bed fa-fw"></i> {{ trans("messages.Bedroom")}}: {{ $property->bedroom }}</span>
                            <span class="badge bg-secondary rounded-0"><i class="fas fa-bath fa-fw"></i> {{ trans("messages.Bathroom")}}: {{ $property->bathroom }}</span>
                            <span class="badge bg-info text-dark rounded-0"><i class="fas fa-ruler-combined fa-fw"></i> {{ trans("messages.Area")}}: {{ $property->area }} m<sup>2</sup></span>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content right">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                            <li><a href="{{ route('property') }}">{{ trans('messages.Properties') }}</a></li>
                            <li>{{ str_limit($property->title,42) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="service-details">
                        <div class="service-single-img card rounded-0">
                            @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                <div class="p-ribbon">
                                    @if($property->featured == 1)
                                        <div class="ribbon"><i
                                                    class="far fa-star"></i> {{ trans('messages.Featured') }}</div>
                                    @endif
                                </div>
                                <div class="single-image">
                                    <img src="{{Storage::url('property/'.$property->image)}}"
                                         alt="{{$property->title}}" class="imgresponsive">
                                </div>
                            @endif
                        </div>
                        <div class="content-body">
                            <h3 class="page-title">{{ $property->title }}</h3>
                            <table class="table table-success table-striped text-capitalize">
                                <tr>
                                    <td>
                                        <i class="fas fa-city fa-fw"></i> {{ $property->city }}
                                    </td>
                                    <td>
                                        <i class="fas fa-map-marker-alt fa-fw"></i> {{ $property->address }}
                                    </td>
                                </tr>
                                @if($property->bedroom  and $property->bathroom )
                                <tr>
                                    <td><span class="text-body"><i class="fas fa-bed fa-fw"></i> {{ trans("messages.Bedroom")}}: {{ $property->bedroom }}</span>
                                    </td>
                                    <td><span class="text-body"><i class="fas fa-bath fa-fw"></i> {{ trans("messages.Bathroom")}}: {{ $property->bathroom }}</span>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td><span class="text-body"><i class="fas fa-ruler-combined fa-fw"></i> {{ trans("messages.Area")}}: {{ $property->area }} m<sup>2</sup></span>
                                    </td>
                                    <td><span class="text-body"><i class="fas fa-comment-alt fa-fw"></i> {{ trans("messages.Comments")}}: {{ $property->comments_count}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-door-open"></i> {{ trans("messages.$property->type") }} {{ trans("messages.for") }} {{ trans("messages.$property->purpose") }}
                                    </td>
                                    <td class="fw-bold">
                                        {{ trans('messages.Price') }} L. {{ number_format($property->price, 2) }}
                                    </td>
                                </tr>
                            </table>

                            <h4>{{ trans('messages.Description') }}</h4>
                            {!! $property->description !!}
                        </div>
                        @if(!$property->gallery->isEmpty())
                            <div class="single-slider">
                                @include('pages.properties.slider')
                            </div>
                        @endif
                    </div>
                    @if($property->features)
                        <div class="services related-service">
                            <h3 class="title">{{ trans('messages.Features') }}</h3>
                            @foreach($property->features as $feature)
                                <h4><span class="badge bg-primary rounded-0">{{$feature->name}}</span></h4>
                            @endforeach
                        </div>
                    @endif
                    @if(Storage::disk('public')->exists('property/'.$property->floor_plan) && $property->floor_plan)
                        <div class="services related-service">
                            <h3 class="title">{{ trans('messages.Floor Plan') }}</h3>
                            <img src="{{Storage::url('property/'.$property->floor_plan)}}"
                                 alt="{{$property->title}}" class="imgresponsive">
                        </div>
                    @endif
                    <div class="services related-service">
                        <h3 class="title">{{ trans('messages.Location') }}</h3>
                        <div id="map"></div>
                    </div>
                    @if($videoembed)
                        <div class="services related-service">
                            <h3 class="title">{{ trans('messages.Video') }}</h3>
                            {!! $videoembed !!}
                        </div>
                    @endif
                    @if($property->nearby)
                        <div class="services related-service">
                            <h3 class="title">{{ trans('messages.Nearby') }}</h3>
                            {!! $property->nearby !!}
                        </div>
                    @endif
                    @auth
                        <div class="services related-service">
                            <h3 class="title">{{ trans('messages.Give It A Score') }}</h3>
                            <div class="pos_rel">
                                <div id="rateYo"></div>
                                <div class="counter"></div>
                            </div>
                        </div>
                    @endauth
                    <div class="post-comments">
                        <h3 class="comment-title">{{ $property->comments_count }} {{ trans('messages.Comments') }}</h3>
                        <ul class="comments-list">
                            @foreach($property->comments as $comment)
                                @if($comment->parent_id == null)
                                    <li>
                                        <div class="comment-img">
                                            <img src="{{  $comment->users->image ? asset('/assets/images/no_imagen.png') : Storage::url('users/'.$comment->users->image) }}"
                                                 class="rounded-circle" alt="img">
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
                                                <img src="{{  $comment->users->image ? asset('/assets/images/no_imagen.png') : Storage::url('users/'.$comment->users->image) }}"
                                                     class="rounded-circle" alt="img">
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
                            <form id="messages" action="{{ route('property.comment',$property->id) }}" method="POST">
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
                                            <button type="submit" class="btn mouse-dir white-bg" >{{ trans('messages.Post Comment') }}
                                                <span class="dir-part"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endauth
                    @guest
                        <div class="comment-form">
                            <h3 class="comment-reply-title">{{ trans('messages.Please Login To Comment') }}</h3>
                            <a href="{{ route('login') }}" style="color: #3E54FF"
                               class="btn btn-outline-primary btn-lg rounded-0 btn-login">{{ trans('messages.Login') }}</a>
                        </div>
                    @endguest
                </div>
                @include('.pages.properties.sidebar')
            </div>
        </div>
    </section>


    {{-- RATING --}}
    @php
        $rating = ($rating == null) ? 0 : $rating;
    @endphp

@endsection

@section('scripts')

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // RATING
            $("#rateYo").rateYo({
                rating: <?php echo json_encode($rating); ?>,
                halfStar: true,
                ratedFill: "#3e54ff",
                onChange: function (rating, rateYoInstance) {
                    $(this).next().text(rating);
                },
                starWidth: "28px"
            })
                .on("rateyo.set", function (e, data) {
                    console.log(data);
                    var rating = data.rating;
                    var property_id = <?php echo json_encode($property->id); ?>;
                    var user_id = <?php echo json_encode(auth()->id()); ?>;

                    $.post("{{ route('property.rating') }}", {
                        rating: rating,
                        property_id: property_id,
                        user_id: user_id
                    }, function (data) {
                        if (data.rating.rating) {
                            toastr.success('Rating: ' + data.rating.rating + ' added successfully.')
                        }
                    });
                });


            // COMMENT
            $(document).on('click', 'span.right.replay', function (e) {
                e.preventDefault();

                var commentid = $(this).data('commentid');

                $('#comment-' + commentid).empty().append(
                    `<div class="comment-box">
                        <form action="{{ route('property.comment',$property->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent" value="1">
                    <input type="hidden" name="parent_id" value="` + commentid + `">

                    <textarea name="body"  class="form-control form-control-custom" placeholder="Leave a comment"></textarea>
                    <button type="submit" class="btn btn-primary border-0 mt-3 rounded-0">Comment</button>
                </form>
            </div>`
                );
            });

            // MESSAGE
            $(document).on('submit', '.agent-message-box', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('property.message') }}";
                var btn = $('#msgsubmitbtn');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function () {
                        $(btn).addClass('disabled');
                        $(btn).empty().append('{{ trans('messages.Loading') }}... <i class="fas fa-sync fa-spin"></i>');
                    },
                    success: function (data) {
                        if (data.message) {
                            toastr.success(data.message)
                        }
                    },
                    error: function (xhr) {
                        toastr.success(xhr.statusText)
                    },
                    complete: function () {
                        $('form.agent-message-box')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('{{ trans('messages.Sent') }} <i class="far fa-share-square"></i>');
                    },
                    dataType: 'json'
                });

            })
        })
    </script>

    <script src="{{ asset('frontend/js/jssor.slider.min.js') }}"></script>
    <script>
        jssor_1_slider_init = function () {

            var jssor_1_SlideshowTransitions = [
                {
                    $Duration: 1200,
                    x: 0.3,
                    $During: {$Left: [0.3, 0.7]},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: -0.3,
                    $SlideOut: true,
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: -0.3,
                    $During: {$Left: [0.3, 0.7]},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $SlideOut: true,
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $During: {$Top: [0.3, 0.7]},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: -0.3,
                    $SlideOut: true,
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: -0.3,
                    $During: {$Top: [0.3, 0.7]},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $SlideOut: true,
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $Cols: 2,
                    $During: {$Left: [0.3, 0.7]},
                    $ChessMode: {$Column: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $Cols: 2,
                    $SlideOut: true,
                    $ChessMode: {$Column: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $Rows: 2,
                    $During: {$Top: [0.3, 0.7]},
                    $ChessMode: {$Row: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $Rows: 2,
                    $SlideOut: true,
                    $ChessMode: {$Row: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $Cols: 2,
                    $During: {$Top: [0.3, 0.7]},
                    $ChessMode: {$Column: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: -0.3,
                    $Cols: 2,
                    $SlideOut: true,
                    $ChessMode: {$Column: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7]},
                    $ChessMode: {$Row: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: -0.3,
                    $Rows: 2,
                    $SlideOut: true,
                    $ChessMode: {$Row: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    y: 0.3,
                    $Cols: 2,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]},
                    $ChessMode: {$Column: 3, $Row: 12},
                    $Easing: {$Left: $Jease$.$InCubic, $Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    y: 0.3,
                    $Cols: 2,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]},
                    $SlideOut: true,
                    $ChessMode: {$Column: 3, $Row: 12},
                    $Easing: {$Left: $Jease$.$InCubic, $Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 3,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 3,
                    $SlideOut: true,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$OutCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 12,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 12,
                    $SlideOut: true,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$OutCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                }
            ];

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: jssor_1_SlideshowTransitions,
                    $TransitionsOrder: 1
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $SpacingX: 5,
                    $SpacingY: 5
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };

        @if(!$property->gallery->isEmpty())
        jssor_1_slider_init();
        @endif

    </script>
    <script>
        function initMap() {
            var propLatLng = {
                lat: <?php echo $property->location_latitude; ?>,
                lng: <?php echo $property->location_longitude; ?>
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: propLatLng
            });

            var marker = new google.maps.Marker({
                position: propLatLng,
                map: map,
                title: '<?php echo $property->title; ?>'
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGSJaz-2tMInt2Uqr2ouILZtY-YwgkF_w&callback=initMap">
    </script>
@endsection