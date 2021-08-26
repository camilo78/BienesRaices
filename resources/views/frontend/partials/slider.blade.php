<!-- Start Hero Area -->
<section class="hero-slider">
    <!-- Single Slider -->
    <div class="single-slider">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 co-12">
                    <div class="home-slider" style="padding-top: 30px; padding-bottom: 30px">
                        @if($sliders)
                            @foreach($sliders as $slider)
                                <div class="hero-text">
                                    <h1 class="wow fadeInUp" data-wow-delay=".5s">{{ $slider->title }}</h1>
                                    <p class="wow fadeInUp" data-wow-delay=".7s">{{ $slider->description }}</p>
                                    <div class="button wow fadeInUp" data-wow-delay=".9s">
                                        <a href="about-us.html" class="btn mouse-dir">{{ trans('messages.Properties') }} <span
                                                    class="dir-part"></span></a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="hero-text">

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Single Slider -->
</section>
<!--/ End Hero Area -->

