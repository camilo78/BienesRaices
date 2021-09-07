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
                        <h4 class="text-white">{{ trans('messages.Dashboard') }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-city fa-fw"></i>
                                <span class="h5">Properties  {{ $propertytotal }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="h5">Messages {{ $messagetotal }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-home fa-fw"></i>
                                <span class="h5">Recent Properties</span>
                            </div>
                        </div>
                        <div class="box-content">
                            @foreach($properties as $key => $property)
                            <div class="grey lighten-4">
                                <a href="{{route('property.show',$property->slug)}}" target="_blank" class="border-bottom display-block p-15  grey-text-d-2">
                                    {{ ++$key }}. {{ str_limit($property->title, 28) }}
                                    <span class="right">&dollar;{{ $property->price }}</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-primary shadow rounded-0 mt-3">
                            <div class="card-body text-white h4">
                                <i class="fas fa-envelope-open-text fa-fw"></i>
                                <span class="h5">Recent Mails</span>
                            </div>
                        </div>
                        <div class="box-content">
                            @foreach($messages as $message)
                            <div class="grey lighten-4">
                                <a href="" class="border-bottom display-block p-15 grey-text-d-2">
                                    <strong>{{ strtok($message->name, " ") }}:</strong>
                                    <span class="p-l-5">{{ str_limit($message->message, 25) }}</span>
                                </a>
                            </div>
                            @endforeach
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