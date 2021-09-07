@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="agent-sidebar">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="card bg-primary shadow rounded-0">
                    <div class="card-body">
                        <h4 class="text-white">{{ trans('messages.Dashboard') }}</h4>
                    </div>
                </div>
                <div class="card bg-primary shadow rounded-0 mt-3">
                    <div class="card-body text-white">
                        <i class="fas fa-comment fa-fw h4"></i>
                        <span class="h4">{{ trans('messages.Comments') }} {{ $commentcount }}</span>
                    </div>
                </div>
                <div class="card bg-primary shadow rounded-0 mt-3">
                    <div class="card-body text-white">
                        <i class="far fa-comments fa-fw h4"></i>
                        <span class="h5">Recent Comments</span>
                    </div>
                </div>
                <ul class="list-group shadow">
                    @foreach($comments as $key => $comment)
                        <li class="list-group-item">{{ ++$key }}. {{ $comment->body }}</li>
                    @endforeach
                </ul>
                  <div class="pagination center">
                        {{ $comments->links() }}
                  <div class="pagination center">
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@section('scripts')
@endsection