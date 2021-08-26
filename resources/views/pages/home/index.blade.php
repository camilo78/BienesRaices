@extends('frontend.layouts.app')

@section('content')
    <section class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ trans('messages.Our Services') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ trans('messages.service_message') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-service wow fadeInUp" data-wow-delay=".2s">
                            <div class="serial">
                                <span><i class="{{ $service->icon }}"></i></span>
                            </div>
                            <h3><a href="service-single.html">{{ $service->title }}</a></h3>
                            <p>{{ $service->description }}</p>
                            <div class="circles-wrap">
                                <div class="circles">
                                    <span class="circle circle-1"></span>
                                    <span class="circle circle-2"></span>
                                    <span class="circle circle-3"></span>
                                    <span class="circle circle-4"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="portfolio-section section">
        <div id="container" class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ trans('messages.Featured Properties') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ trans('messages.featured_message') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="portfolio-btn-wrapper wow fadeInUp" data-wow-delay=".4s">
                        <button class="portfolio-btn active" data-filter="*">{{ trans('messages.All') }}</button>
                        @foreach($features as $feature)
                            <button class="portfolio-btn"
                                    data-filter=".{{ $feature->slug }}">{{ $feature->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row grid">
                @foreach($properties as $property)
                    <div class="col-lg-4 col-md-6 grid-item @foreach($property->features as $features) {{  $features->slug }} @endforeach">
                        <div class="portfolio-item-wrapper wow fadeInUp" data-wow-delay=".3s">
                            <div class="portfolio-img">
                                <img src="{{ asset('/storage/property/'.$property->image) }}" alt="">
                            </div>
                            <div class="portfolio-overlay">
                                <div class="overlay-content">
                                    <h4 class="pb-0 mb-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $property->title }}">{{ str_limit( $property->title, 18 ) }}</h4>
                                    <div class="text-start mt-1 pt-0">
                                        <span class="text-white"><i class="fas fa-city fa-fw"></i> {{ $property->city }}</span><br>
                                        <span class="text-white" data-bs-toggle="tooltip" data-bs-placement="top"
                                              title="{{ $property->address }}"><i
                                                    class="fas fa-map-marker-alt fa-fw"></i> {{ str_limit( $property->address, 30 ) }}</span><br>
                                        <span class="text-white text-capitalize"><i class="far fa-check-square fa-fw"></i> {{ trans("messages.$property->type") }}</span><br>
                                    </div>
                                    <span class="text-white fs-5 mt-1">L. {{ number_format($property->price, 2) }}</span>
                                    <br>
                                    <table class="text-start mb-2 small">
                                        <tr>
                                            <td><span class="text-white"><i class="fas fa-bed fa-fw"></i> {{ trans("messages.Bedroom")}}: {{ $property->bedroom }}</span>
                                            </td>
                                            <td><span class="text-white"><i class="fas fa-bath fa-fw"></i> {{ trans("messages.Bathroom")}}: {{ $property->bathroom }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-white"><i class="fas fa-ruler-combined fa-fw"></i> {{ trans("messages.Area")}}: {{ $property->area }} m<sup>2</sup></span>
                                            </td>
                                            <td><span class="text-white"><i class="fas fa-comment-alt fa-fw"></i> {{ trans("messages.Comments")}}: {{ $property->comments_count}}</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <a href="property/{{ $property->slug }}"
                                       class="btn btn-outline-light btn-sm rounded-0 mt-0">{{ trans("messages.View")}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section id="testimonials" class="section testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ trans('messages.Our Testimonials') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ trans('messages.testimonials_message') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" col-12">
                    <div class="testimonial-slider">
                        @foreach($testimonials as $testimonial)
                            <div class="single-testimonial">
                                <div class="client{{$testimonial->id}} client"
                                     style="background-image: url('{{Storage::url('testimonial/'.$testimonial->image)}}')"></div>
                                <i class="lni lni-quotation"></i>
                                <p>" {{$testimonial->testimonial}}" </p>
                                <div class="bottom">
                                    <h4 class="name">{{$testimonial->name}}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <img class="shape1 wow fadeInLeft" data-wow-delay=".8s" src="assets/images/testi-shape1.png" alt="#">
    </section>

    <!-- BLOG SECTION -->

    <div class="latest-news-area section">
        <div class="letast-news-grid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <div class="section-title">
                            <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ trans('messages.Latest News & Blog') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".6s">{{ trans('messages.blog_message') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 col-12">

                            <div class="letest-news-item wow fadeInUp" data-wow-delay=".4s">
                                <div class="image">
                                    <img src="{{Storage::url('posts/'.$post->image)}}" alt="#">
                                </div>
                                <div class="content-body">
                                    <div class="meta-details">
                                        <a href="#" class="meta-list"><i
                                                    class="lni lni-user"></i><span>{{ $post->user->name }}</span></a>
                                        <a href="#" class="meta-list"><i
                                                    class="lni lni-calendar"></i><span>{{$post->created_at->diffForHumans()}}</span></a>
                                    </div>
                                    <h4 class="title"><a
                                                href="{{ route('blog.show',$post->slug) }}">{{$post->title}}</a></h4>
                                    <p>{!! str_limit($post->body,130) !!}</p>
                                    <div class="mt-2">
                                        @foreach($post->categories as $key => $category)
                                            <a href="{{ route('blog.categories',$category->slug) }}" class="meta-list">
                                                <i class="far fa-folder-open fa-fw"></i>
                                                <span>{{$category->name}}</span>
                                            </a>
                                        @endforeach
                                        <br>
                                        @foreach($post->tags as $key => $tag)
                                            <a href="{{ route('blog.tags',$tag->slug) }}" class="meta-list">
                                                <i class="fas fa-tags fa-fw"></i>
                                                <span>{{$tag->name}}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="button mt-2">
                                        <a class="btn mouse-dir white-bg" href="blog-single-sidebar.html">{{ trans('messages.Read More') }}
                                            <span class="dir-part"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var js_properties = <?php echo json_encode($properties);?>;
            js_properties.forEach(element => {
                if (element.rating) {
                    var elmt = element.rating;
                    var sum = 0;
                    for (var i = 0; i < elmt.length; i++) {
                        sum += parseFloat(elmt[i].rating);
                    }
                    var avg = sum / elmt.length;
                    if (isNaN(avg) == false) {
                        $("#propertyrating-" + element.id).rateYo({
                            rating: avg,
                            starWidth: "20px",
                            readOnly: true
                        });
                    } else {
                        $("#propertyrating-" + element.id).rateYo({
                            rating: 0,
                            starWidth: "20px",
                            readOnly: true
                        });
                    }
                }
            });
        })
    </script>
@endsection
