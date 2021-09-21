@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="agent-sidebar">
                        @include('agent.sidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                   <div class="card bg-primary shadow rounded-0">
                    <div class="card-body">
                        <h4 class="text-white">{{ trans('messages.Profile') }}</h4>
                    </div>
                </div>
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <form action="{{route('agent.profile.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text rounded-0 btn-primary" id="basic-addon1"><i class="fas fa-user fa-fw"></i></span>
                                        <input id="name" name="name" type="text" value="{{ $profile->name }}" placeholder="{{ trans('messages.Name') }}" class="form-control rounded-0">
                                    </div>
                                </div>
                               <div class="col-lg-6 col-md-6">
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text rounded-0 btn-primary" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                                        <input id="username" name="username" type="text" value="{{ $profile->username ? $profile->username : '' }}" placeholder="{{ trans('messages.Username') }}" class="form-control rounded-0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text rounded-0 btn-primary" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                        <input id="email" name="email" type="email" value="{{ $profile->email }}" placeholder="{{ trans('messages.Mail') }}" class="form-control rounded-0">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-group input-group-lg mt-3">
                                        <input type="file" name="image" class="form-control form-control-lg rounded-0 btn-primary">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text rounded-0 btn-primary" id="basic-addon1"><i class="fas fa-edit"></i></span>
                                        <textarea id="about" name="about" placeholder="{{ trans('messages.About me') }}" class="form-control rounded-0">{{ $profile->about }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 d-flex mt-3 mb-3 justify-content-end">
                                    <button type="submit" class="btn btn-lg btn-primary rounded-0">{{ trans('messages.Send') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- /.col -->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection