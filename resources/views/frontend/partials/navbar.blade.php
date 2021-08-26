<!-- Toolbar Start -->
@foreach($settings as $setting)
@endforeach
<div class="toolbar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-9 col-12">
                <div class="toolbar-contact">
                    @if(isset($setting->email))
                        <p><i class="lni lni-envelope"></i><a
                                    href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
                    @endif
                    @if(isset($setting->phone))
                        <p><i class="lni lni-phone"></i><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                        </p>
                    @endif

                    @if (config('locale.status') && count(config('locale.languages')) > 1)
                        @foreach (array_keys(config('locale.languages')) as $lang)
                            @if ($lang != App::getLocale())
                                <p><i class="fas fa-globe"></i><a href="{!! route('lang.swap', $lang) !!}">{{ $lang === "es" ? "Español" : "Inglish" }}</a></p>
                            @endif
                        @endforeach

                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-12">
                <div class="toolbar-sl-share">
                    <ul>   
                        @if(isset($setting->facebook))
                        <li><a href="{{ $setting->facebook }}" target="_blank"><i
                                        class="lni lni-facebook-filled"></i></a></li>
                        @endif
                        @if(isset($setting->twitter))
                        <li><a href="{{ $setting->twitter }}" target="_blank"><i
                                        class="lni lni-twitter-original"></i></a></li>
                        @endif
                        @if(isset($setting->linkedin))
                        <li><a href="{{ $setting->linkedin }}" target="_blank"><i class="lni lni-instagram"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Toolbar End -->
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-12">
            <div class="nav-inner">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('/assets/images/logo.svg') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="page-scroll {{ Request::is('/') ? 'active' : '' }}"
                                   href="{{ route('home') }}">{!! trans('messages.Home') !!}</a>
                            </li>

                            <li class="nav-item">
                                <a class="page-scroll {{ Request::is('property') ? 'active' : '' }}"
                                   href="{{ route('property') }}">{!! trans('messages.Properties') !!}</a>
                            </li>

                            <li class="nav-item">
                                <a class="page-scroll {{ Request::is('agents') ? 'active' : '' }}"
                                   href="{{ route('agents') }}">{!! trans('messages.Agents') !!}</a>
                            </li>

                            <li class="nav-item">
                                <a class="page-scroll {{ Request::is('gallery') ? 'active' : '' }}"
                                   href="{{ route('gallery') }}">{!! trans('messages.Gallery') !!}</a>
                            </li>

                            <li class="nav-item">
                                <a class="page-scroll {{ Request::is('blog') ? 'active' : '' }}"
                                   href="{{ route('blog') }}">{!! trans('messages.Blog') !!}</a>
                            </li>

                            <li class="nav-item">
                                <a class="page-scroll {{ Request::is('contact') ? 'active' : '' }}"
                                   href="{{ route('contact') }}">{!! trans('messages.Contact') !!}</a>
                            </li>
                            @guest
                                <li class="nav-item"><a class="page-scroll" href="{{ route('login') }}">login</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{ route('register') }}">register</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="page-scroll dd-menu collapsed" href="javascript:void(0)"
                                       data-bs-toggle="collapse" data-bs-target="#submenu-1-1"
                                       aria-controls="navbarSupportedContent" aria-expanded="false"
                                       aria-label="Toggle navigation">{{ ucfirst(Auth::user()->username) }}</a>
                                    <ul class="sub-menu collapse" id="submenu-1-1">
                                        <li class="nav-item">
                                            @if(Auth::user()->role->id == 1)
                                                <a href="{{ route('admin.dashboard') }}" class="indigo-text">
                                                    <i class="lni lni-user"></i> {!! trans('messages.Dashboard') !!}
                                                </a>
                                            @elseif(Auth::user()->role->id == 2)
                                                <a href="{{ route('agent.dashboard') }}" class="indigo-text">
                                                    <i class="lni lni-user"></i> {!! trans('messages.Dashboard') !!}
                                                </a>
                                            @elseif(Auth::user()->role->id == 3)
                                                <a href="{{ route('user.dashboard') }}" class="indigo-text">
                                                    <i class="lni lni-user"></i> {!! trans('messages.Dashboard') !!}
                                                </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdownitem indigo-text" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                                <i class="lni lni-exit"></i> {!! trans('messages.Logout') !!}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest

                        </ul>

                    </div> <!-- navbar collapse -->
                    <!--                    <div class="button">
                                            <a href="javascript:void(0)" class="btn white-bg mouse-dir">Get a Quote <span class="dir-part"></span></a>
                                        </div>-->
                </nav> <!-- navbar -->
            </div>
        </div>
    </div> <!-- row -->
</div> <!-- container -->