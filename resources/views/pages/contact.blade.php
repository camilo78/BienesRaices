@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <div class="breadcrumbs" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content left">
                        <h1 class="page-title">{{ trans('messages.Contact Us') }}</h1>
                        <p>{{ trans('messages.contact.message') }}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content right">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                            <li>{{ trans('messages.Contact') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.partials.search')


    <div class="container">
        <div class="row mt-5">

            <div class="col-md-6">
                <div class="shadow py-5 px-5 pb-4">
                    <h5 class="widget-title mb-4" style="border-left: 3px solid #3e54ff; padding-left: 15px;">
                        Formulario de Contacto</h5>
                    <form id="contact-us" action="" method="POST">
                        @csrf
                        <input type="hidden" name="mailto"
                               value="{{ $contactsettings[0]['email'] ?? 'p4alam@gmail.com' }}">
                        @auth
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        @endauth

                        @auth
                            <div class="col-md-12 mb-4">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <span class="fw-bold">{{ trans('messages.Name') }}</span>
                                    </div>
                                    <div class="col-lg-10">
                                        <input id="name" name="name" type="text"
                                               class="form-control bg-white rounded-0"
                                               value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        @guest
                            <div class="col-md-12 mb-4">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <span class="fw-bold">{{ trans('messages.Name') }}</span>
                                    </div>
                                    <div class="col-lg-10">
                                        <input id="name" name="name" type="text"
                                               class="form-control bg-white rounded-0">
                                    </div>
                                </div>
                            </div>
                        @endguest

                        @auth
                            <div class="col-md-12 mb-4">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <span class="fw-bold">{{ trans('messages.Mail') }}</span>
                                    </div>
                                    <div class="col-lg-10">
                                        <input id="email" name="email" type="email"
                                               class="form-control bg-white rounded-0"
                                               value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        @guest
                            <div class="col-md-12 mb-4">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <span class="fw-bold">{{ trans('messages.Mail') }}</span>
                                    </div>
                                    <div class="col-lg-10">
                                        <input id="email" name="email" type="email"
                                               class="form-control bg-white rounded-0">
                                    </div>
                                </div>
                            </div>
                        @endguest
                        <div class="col-md-12 mb-4">
                            <div class="row">
                                <div class="col-lg-2">
                                    <span class="fw-bold">{{ trans('messages.Phone') }}</span>
                                </div>
                                <div class="col-lg-10">
                                    <input id="phone" name="phone" type="number"
                                           class="form-control bg-white rounded-0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="row">
                                <div class="col-lg-2">
                                    <span class="fw-bold">{{ trans('messages.Message') }}</span>
                                </div>
                                <div class="col-lg-10">
                                    <textarea id="message" name="message" class="materialize-textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 d-flex justify-content-end">
                            <button id="msgsubmitbtn" class="btn btn-primary rounded-0" type="submit">
                                <span>{{ trans('messages.Send') }}</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div> <!-- /.col -->

            <div class="col-md-6">
                <div class="shadow py-5 px-5 pb-4">
                    <div class="row mb-4">
                        <div class="col-md-1 align-self-center">
                            <i class="fas fa-phone fs-4"></i>
                        </div>
                        <div class="col-lg-11">
                            <h6>{{ trans('messages.Call us Now') }}</h6>
                            @if(isset($contactsettings[0]) && $contactsettings[0]['phone'])
                                <h6 class="bold m-l-40">{{ $contactsettings[0]['phone'] }}</h6>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-1 align-self-center">
                            <i class="fas fa-envelope fs-4"></i>
                        </div>
                        <div class="col-md-10">
                            <h6 class="uppercase">{{ trans('messages.Email Address') }}</h6>
                            @if(isset($contactsettings[0]) && $contactsettings[0]['email'])
                                <h6 class="bold m-l-40">{{ $contactsettings[0]['email'] }}</h6>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-1 fs-4 align-self-center">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="col-md-10">
                            <h6 class="uppercase">{{ trans('messages.Address') }}</h6>
                            @if(isset($contactsettings[0]) && $contactsettings[0]['address'])
                                <h6 class="bold m-l-40">{!! $contactsettings[0]['address'] !!}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12 my-5">
                <div class="ratio ratio-16x9 shadow">
                    <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?hl=es&amp;q=avenida 14 de julio&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>

        $(function () {
            $(document).on('submit', '#contact-us', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('contact.message') }}";
                var btn = $('#msgsubmitbtn');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function () {
                        $(btn).addClass('disabled');
                        $(btn).empty().append('<span>LOADING...</span><i class="material-icons right">rotate_right</i>');
                    },
                    success: function (data) {
                        if (data.message) {
                            M.toast({html: data.message, classes: 'green darken-4'})
                        }
                    },
                    error: function (xhr) {
                        M.toast({html: 'ERROR: Failed to send message!', classes: 'red darken-4'})
                    },
                    complete: function () {
                        $('form#contact-us')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('<span>SEND</span><i class="material-icons right">send</i>');
                    },
                    dataType: 'json'
                });

            })
        })

    </script>
@endsection