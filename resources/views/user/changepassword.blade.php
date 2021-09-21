@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                @include('user.sidebar')
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="card rounded-0 shadow border-0 bg-primary">
                    <div class="card-body">
                        <h4 class="text-white">{{ trans('messages.Change Password') }}</h4>
                    </div>
                </div>
                <div class="card rounded-0 shadow border-0">
                    <div class="card-body">
                        <form action="{{route('user.changepassword.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text input-group-lg rounded-0 btn-primary"  id="addon-wrapping"><i class="fas fa-lock-open"></i></span>
                                    <input id="currentpassword" name="currentpassword" placeholder="{{ trans('messages.Current Password') }}" type="password" class="form-control form-control-lg px-3">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text input-group-lg rounded-0 btn-primary"  id="addon-wrapping"><i class="fas fa-unlock"></i></span>
                                    <input id="newpassword" name="newpassword" type="password" placeholder="{{ trans('messages.New Password') }}" class="form-control form-control-lg px-3">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text input-group-lg rounded-0 btn-primary"  id="addon-wrapping"><i class="fas fa-unlock-alt"></i></span>
                                    <input id="new-password_confirmation" name="newpassword_confirmation" type="password" placeholder="{{ trans('messages.Confirm') }}" class="form-control form-control-lg px-3">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 d-flex justify-content-end">
                                <div class="col-lg-12 col-md-12 d-flex mt-3 mb-3 justify-content-end">
                                    <button class="btn btn-lg btn-primary rounded-0" type="submit">{{ trans('messages.Send') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@endsection