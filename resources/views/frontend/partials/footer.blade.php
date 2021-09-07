<!-- Start Footer Area -->
<footer class="footer">
    <!-- Start Middle Top -->
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Single Widget -->
                    <div class="f-about single-footer">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('assets/images/logo.svg') }}" alt="#"></a>
                        </div>
                        @if(isset($footersettings[0]) && $footersettings[0]['aboutus'])
                        <p>{{ $footersettings[0]['aboutus'] }}</p>
                        @else
                        <p>Real estate company description goes here.</p>
                        @endif
                        <div class="footer-social">
                            <ul>
                                @if(isset($footersettings[0]) && $footersettings[0]['facebook'])
                                <li><a href="{{ $footersettings[0]['facebook'] }}"><i class="lni lni-facebook-filled"></i></a></li>
                                @endif
                                @if(isset($footersettings[0]) && $footersettings[0]['twitter'])
                                <li><a href="{{ $footersettings[0]['twitter'] }}"><i class="lni lni-twitter-original"></i></a></li>
                                @endif
                                @if(isset($footersettings[0]) && $footersettings[0]['linkedin'])
                                <li><a href="{{ $footersettings[0]['linkedin'] }}"><i class="lni lni-instagram-original"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="row">
                        <!-- Single Widget -->
                        <div class="single-footer f-contact f-link">
                            <h3>{{ trans('messages.Contact Us') }}</h3>
                            <p>{{ trans('messages.contact_message') }}</p>
                            <ul class="footer-contact">
                                @foreach($settings as $setting)
                                @if(isset($setting->linkedin))
                                <li><i class="lni lni-phone fa-fw"></i> <a href="phone:{{ $setting->phone }}"> {{ $setting->phone }}</a></li>
                                @endif
                                @if(isset($setting->linkedin))
                                <li><i class="lni lni-envelope fa-fw"></i><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
                                @endif
                                @if(isset($setting->linkedin))
                                <li><i class="lni lni-map-marker fa-fw"></i>{{ $setting->address }}</li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer gallery">
                        <h3>{{ trans('messages.Recent Properties') }}</h3>
                        @foreach($footerproperties as $property)
                        <div class="card mb-3 rounded-0 card-fot border-0" >
                            <a href="{{ route('property.show',$property->slug) }}">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="{{Storage::url('property/'.$property->image)}}" class="img-fluid rounded-0" alt="$property->name">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <p class="fw-bold mt-0 pt-0 card-fot" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$property->title}}">{{ str_limit($property->title,33) }}</p>
                                            <p class="small"><i class="fas fa-bed fa-fw"></i> {{ trans('messages.Bedroom') }}: {{ $property->bedroom }} <i class="fas fa-bath fa-fw"></i> {{ trans('messages.Bathroom') }}: {{ $property->bathroom }} <i class="fas fa-ruler-combined fa-fw"></i> {{ trans('messages.Area') }}: {{ $property->area }} m<sup>2</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Middle -->
    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="left">
                            <p>{{trans('messages.Developed by')}}<a href="https://emprende.dev/" rel="nofollow" target="_blank">Emprende en la Web</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="right">
                            <p>{{ trans('messages.All rights reserved') }} © @if(isset($setting->name)) {{ $setting->name }}@endif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->
</footer>
<!--/ End Footer Area -->