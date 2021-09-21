@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                @include('agent.sidebar')
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="card bg-primary shadow rounded-0">
                    <div class="card-body">
                        <h4 class="text-white">{{ trans('messages.Dashboard') }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-city fa-fw"></i>
                                <span class="h5">{{ trans('messages.Properties') }}  {{ $propertytotal }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="h5">{{ trans('messages.Messages') }} {{ $messagetotal }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-home fa-fw"></i>
                                <span class="h5">{{ trans('messages.Recent Properties') }}</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            @foreach($properties as $key => $property)
                            <li class="list-group-item">
                                <a href="{{route('property.show',$property->slug)}}" target="_blank">
                                    {{ ++$key }}. {{ str_limit($property->title, 28) }}
                                    <span>&dollar;{{ $property->price }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-envelope-open-text fa-fw"></i>
                                <span class="h5">{{ trans('messages.Recent Mails') }}</span>
                            </div>
                        </div>
                        <ul class="list-group">
                            @foreach($messages as $message)
                            <li class="list-group-item">
                                <a href="/agent/message/read/{{ $message->id }}" class="card-fot">
                                    <strong>{{ strtok($message->name, " ") }}: </strong><span>{{ str_limit($message->message, 25) }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@endsection