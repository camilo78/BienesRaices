@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
<div class="breadcrumbs" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content left">
                    <h1 class="page-title">{{trans('messages.Our Real Estate Agents')}}</h1>
                    <p>{{trans('messages.agents_message')}}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content right">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                        <li>{{trans('messages.Agents')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <div class="row">
            @foreach($agents as $agent)
            <aside class="col-lg-4 col-md-5 col-12">
                <div class="card shadow border-0">
                    <a href="{{ route('agents.show',$agent->id) }}">
                        <img class="card-img-top" src="{{Storage::url('users/'.$agent->image)}}" alt="{{ $agent->name }}">
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                        <a href="{{ route('agents.show',$agent->id) }}" class="card-fot">{{ $agent->name }}</a>
                        </h5>
                        <h6 class="email">{{ $agent->email }}</h6>
                        <p class="about pb-4">{{ str_limit($agent->about,50) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination center">
            {{ $agents->links() }}
        </div>
    </div>
</section>
@endsection
@section('scripts')
@endsection