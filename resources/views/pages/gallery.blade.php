@extends('frontend.layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="breadcrumbs" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content left">
                        <h1 class="page-title">{{trans('messages.Gallery')}}</h1>
                        <p>{{trans('messages.properties.page.message')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content right">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                            <li>{{trans('messages.Gallery')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.partials.search')

    <section class="section">
        <div class="container">
            <div class="row">
                @foreach($galleries as $gallery)
                    @if(Storage::disk('public')->exists('gallery/'.$gallery->image) && $gallery->image)
                        <div class="col-lg-3 p-1">
                            <a href="{{Storage::url('gallery/'.$gallery->image)}}"
                               data-lightbox="image-{{ $gallery->id }}" data-title="{{$gallery->album->name}}">
                                <img class="img-thumbnail" src="{{Storage::url('gallery/'.$gallery->image)}}"
                                     alt=""></a>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="row mt-20">
                <div class="col-lg-12 d-flex justify-content-center">
                    {{ $galleries->links() }}
                </div>
            </div>
    </section>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"
            integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        lightbox.option({
            'resizeDuration': 100,
            'wrapAround': true,
            'alwaysShowNavOnTouchDevices': true,
            'fitImagesInViewport' :true,
        })
    </script>
@endsection