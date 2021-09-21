@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('agent.sidebar')
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="card rounded-0 shadow border-0 bg-primary">
                    <div class="card-body">
                        <h4 class="text-white">{{ trans('messages.Reply Message') }}</h4>
                    </div>
                </div>
                <div class="card rounded-0 shadow border-0">
                    <div class="card-body">
                        @if($message->user_id)
                        <form action="{{route('agent.message.send')}}" method="POST">
                            @csrf
                            <input type="hidden" name="agent_id" value="{{ $message->user_id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                            <div class="row">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text input-group-lg rounded-0 btn-primary" id="addon-wrapping"><i class="fas fa-envelope fa-fw align-self-center"></i></span>
                                    <input id="email" type="email" value="{{ $message->email }}" placeholder="{{ trans('messages.Email') }}" class="form-control form-control-lg px-3" readonly>
                                    <span class="input-group-text rounded-0 btn-primary">{{ trans('messages.TO') }}</span>
                                </div>
                                <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text input-group-lg rounded-0 btn-primary" id="addon-wrapping"><i class="fas fa-phone"></i></span>
                                        <input id="phone" name="phone" type="number" placeholder="{{ trans('messages.Phone') }}" class="form-control form-control-lg px-3">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text input-group-lg rounded-0 btn-primary"  id="addon-wrapping"><i class="fas fa-edit"></i></span>
                                        <textarea id="message" name="message" placeholder="{{ trans('messages.Write your message') }}"  class="form-control form-control-lg px-3"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 d-flex mt-3 mb-3 justify-content-end">
                                    <button class="btn btn-lg btn-primary rounded-0" type="submit">{{ trans('messages.Send') }}</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <form action="{{route('agent.message.mail')}}" method="POST">
                            @csrf
                            <input type="hidden" name="name" value="{{ $message->name }}">
                            <input type="hidden" name="mailfrom" value="{{ auth()->user()->email }}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text input-group-lg rounded-0 btn-primary" id="addon-wrapping"><i class="fas fa-envelope fa-fw align-self-center"></i></span>
                                        <input id="email" name="email" type="email" value="{{ $message->email }}"  value="{{ $message->email }}" class="form-control form-control-lg px-3" readonly>
                                        <span class="input-group-text rounded-0 btn-primary">{{ trans('messages.TO') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text input-group-lg rounded-0 btn-primary" id="addon-wrapping"><i class="fas fa-user-edit fa-fw align-self-center"></i></span>
                                        <input id="subject" name="subject" type="text" placeholder="{{ trans('messages.Subject of mail') }}" class="form-control form-control-lg px-3">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 d-flex justify-content-between mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text input-group-lg rounded-0 btn-primary"  id="addon-wrapping"><i class="fas fa-edit"></i></span>
                                        <textarea id="message" name="message" placeholder="{{ trans('messages.Write your message') }}"  class="form-control form-control-lg px-3"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 d-flex mt-3 mb-3 justify-content-end">
                                    <button class="btn btn-lg btn-primary rounded-0" type="submit">{{ trans('messages.Send') }}</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@endsection