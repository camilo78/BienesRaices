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
            <div class="col-lg-9">
                <div class="card rounded-0 shadow border-0 bg-primary">
                    <div class="card-body">
                        <h4 class="agent-title text-white">{{ trans('messages.Read Message') }}</h4>
                    </div>
                </div>
                <div class="card rounded-0 shadow border-0">
                    <div class="card-body">
                        <span><strong>{{ trans('messages.From') }}:</strong> <em>{{ $message->name }} < {{ $message->email }} ></em></span> <br>
                        <span><strong>{{ trans('messages.Phone') }}:</strong> {{ $message->phone }}</span>
                        <div class="read-message">
                            <span>{{ trans('messages.Message') }}:</span>
                            <p>{!! $message->message !!}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{route('agent.message.replay',$message->id)}}" class="btn btn-primary btn-sm rounded-0 mt-3">
                                <i class="fas fa-reply text-white"></i>
                                <span class="text-white">{{ trans('messages.Reply') }}</span>
                            </a>
                            <form class="right" action="{{route('agent.message.readunread')}}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="{{ $message->status }}">
                                <input type="hidden" name="messageid" value="{{ $message->id }}">
                                @if($message->status)
                                <button type="submit" class="btn btn-success btn-sm rounded-0 mt-3">
                                <i class="fas fa-check text-white"></i>
                                <span class="text-white">{{ trans('messages.Unread') }}</span>
                                @else
                                <button type="submit" class="btn btn-warning btn-sm rounded-0 mt-3">
                                <i class="fas fa-book-reader text-white"></i>
                                <span class="text-white">{{ trans('messages.Read') }}</span>
                                @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

@endsection