@extends('frontend.layouts.app1')

@section('styles')
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
        body{
            background: url("{{ asset('/assets/images/login.jpg') }}") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

    </style>
@endsection

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100  pt-30 pb-30">
                <div class="col-md-6 col-lg-6 col-xl-5" style="width: 300px">
                    <img src="{{ asset('/assets/images/logo.svg') }}" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" style="width: 400px">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-4">
                                <p class="lead fw-bold me-3">{{ __('Register') }}</p>
                            </div>
                            <a href="{{ route('home') }}" class="card-fot lead"><i class="fas fa-undo-alt fa-fw"></i> {{ trans('messages.Home') }}</a>
                        </div>
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input id="name" type="text"
                                   class="{{ $errors->has('name') ? 'is-invalid' : '' }} rounded-0 form-control form-control-sm"
                                   placeholder="  {{ __('Name') }}"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <label class="form-label text-danger"
                                       for="form3Example3">{{ $errors->first('name') }}</label>
                            @endif

                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input id="email" type="email"
                                   class="{{ $errors->has('email') ? 'is-invalid' : '' }} rounded-0 form-control form-control-sm"
                                   placeholder="  {{ __('E-Mail Address') }}"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <label class="form-label text-danger"
                                       for="form3Example3">{{ $errors->first('email') }}</label>
                            @endif

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input id="password" type="password"
                                   class="{{ $errors->has('password') ? 'is-invalid' : '' }} rounded-0 form-control form-control-sm"
                                   name="password"
                                   required placeholder="  {{ __('Password') }}">
                            @if ($errors->has('password'))
                                <label class="form-label text-danger"
                                       for="form3Example4">{{ $errors->first('password') }}</label>
                            @endif
                        </div>

                        <!-- Password confirm input -->
                        <div class="form-outline mb-3">
                            <input id="password-confirm" class="rounded-0 form-control form-control-sm" type="password" name="password_confirmation" required>
                        </div>


                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary rounded-0"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;"> {{ __('Register') }}
                            </button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">{{ trans("messages.Don't have an account?") }} <a href="{{ route('register') }}" class="link-danger"> {{ trans('messages.Register') }}</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-center py-4 px-4 px-xl-5">
            <!-- Copyright -->
            <div class="mb-3 mb-md-0">
                Copyright © 2020. {{ config('app.name', 'Casa Propia') }} {{ trans('messages.All rights reserved') }}.
            </div>
            <!-- Copyright -->
        </div>
    </section>
@endsection
