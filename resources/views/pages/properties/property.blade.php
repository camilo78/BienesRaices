@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <div class="breadcrumbs" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content left">
                        <h1 class="page-title">{{trans('messages.Properties')}}</h1>
                        <p>{{trans('messages.properties.page.message')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content right">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                            <li>{{trans('messages.Properties')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('frontend.partials.search')

    <section class="portfolio-section section">
        <div id="container" class="container">
            <div class="row">
                <div class="d-flex justify-content-center mb-40">
                    @foreach($cities as $city)
                        <div class="button service-details p-1">
                            <a href="{{ route('property.city',$city->city_slug) }}"
                               class="btn mouse-dir white-bg">{{ $city->city }}<span class="dir-part"></span></a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($properties as $property)
                    <div class="col">
                        <div class="card h-100 rounded-0 border-0 service-details letest-news-item">
                            <div class="p-ribbon">
                                @if($property->featured == 1)
                                    <div class="ribbon"><i
                                                class="far fa-star"></i> {{ trans('messages.Featured') }}</div>
                                @endif
                            </div>
                            @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                <a class="image" href="{{ route('property.show',$property->slug) }}">
                                    <img src="{{Storage::url('property/'.$property->image)}}"
                                         class="card-img-top rounded-0" alt="{{$property->title}}">
                                </a>
                            @endif
                            <div class="card-body content-body">
                                <a href="{{ route('property.show',$property->slug) }}">
                                    <h6 class="card-title card-fot" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $property->title }}">{{ str_limit( $property->title, 30 ) }}</h6>
                                </a>
                                <div class="text-start mt-1 pt-0">
                                    <span class="text-body"><i
                                                class="fas fa-city fa-fw"></i> {{ $property->city }}</span><br>
                                    <span class="text-body" data-bs-toggle="tooltip" data-bs-placement="top"
                                          title="{{ $property->address }}"><i
                                                class="fas fa-map-marker-alt fa-fw"></i> {{ str_limit( $property->address, 30 ) }}</span><br>
                                    <span class="text-body text-capitalize"><i class="far fa-check-square fa-fw"></i> {{ trans("messages.$property->type") }}</span><br>
                                    <span class="text-body text-capitalize"><i
                                                class="far fa-check-square fa-fw"></i> {{ trans("messages.for") }} {{ trans("messages.$property->purpose") }}</span><br>
                                </div>
                                <span class="text-body fs-5 mt-1">L. {{ number_format($property->price, 2) }}</span>
                                <hr>
                                <table class="text-start mb-0 pb-0">
                                    @if($property->bedroom  and $property->bathroom )
                                    <tr>
                                        <td><span class="text-body"><i class="fas fa-bed fa-fw"></i> {{ trans("messages.Bedroom")}}: {{ $property->bedroom }}</span>
                                        </td>
                                        <td><span class="text-body"><i class="fas fa-bath fa-fw"></i> {{ trans("messages.Bathroom")}}: {{ $property->bathroom }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-body"><i class="fas fa-ruler-combined fa-fw"></i> {{ trans("messages.Area")}}: {{ $property->area }} m<sup>2</sup></span>
                                        </td>
                                        <td><span class="text-body"><i class="fas fa-comment-alt fa-fw"></i> {{ trans("messages.Comments")}}: {{ $property->comments_count}}</span>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-20">
                <div class="col-lg-12 d-flex justify-content-center">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </section>

    
@endsection

@section('scripts')

    <script>

        $(function () {
            var js_properties = <?php echo json_encode($properties);?>;
            js_properties.data.forEach(element => {
                if (element.rating) {
                    var elmt = element.rating;
                    var sum = 0;
                    for (var i = 0; i < elmt.length; i++) {
                        sum += parseFloat(elmt[i].rating);
                    }
                    var avg = sum / elmt.length;
                    if (isNaN(avg) == false) {
                        $("#propertyrating-" + element.id).rateYo({
                            rating: avg,
                            starWidth: "20px",
                            readOnly: true
                        });
                    } else {
                        $("#propertyrating-" + element.id).rateYo({
                            rating: 0,
                            starWidth: "20px",
                            readOnly: true
                        });
                    }
                }
            });
        })
    </script>
@endsection