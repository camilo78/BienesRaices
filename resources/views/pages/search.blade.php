@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="breadcrumbs" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content left">
                        <h1 class="page-title">{{trans('messages.Property Search Engine')}}</h1>
                        <p>{{trans('messages.search.page.message')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content right">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}">{{ trans('messages.Home') }}</a></li>
                            <li>{{trans('messages.Search')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section class="section service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-12">
                    @foreach($properties as $property)
                        <div class="service-details card border-0 mb-4">
                            <div class="p-ribbon">
                                @if($property->featured == 1)
                                    <div class="ribbon" style="color: yellow"><i class="far fa-star"></i> {{ trans('messages.Featured') }}</div>
                                @endif
                            </div>
                            <div class="card-block">
                                <div class="service-single-img">
                                    @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                        <img src="{{Storage::url('property/'.$property->image)}}"
                                             alt="{{$property->title}}">
                                    @endif
                                </div>
                            </div>
                            <div class="content-body">
                                <h3 title="{{$property->title}}">
                                    <a class="card-fot"
                                       href="{{ route('property.show',$property->slug) }}">{{ $property->title }}</a>
                                    @if($property->featured == 1)
                                        <span>
                                            <i class="far fa-star"></i>
                                        </span>
                                    @endif
                                </h3>

                                <div class="address">
                                    <i class="fas fa-map-marker-alt fa-fw"></i>
                                    <span>{{ ucfirst($property->city) }}</span>
                                </div>
                                <div class="address">
                                    <i class="fas fa-map-marked-alt"></i>
                                    <span>{{ ucfirst($property->address) }}</span>
                                </div>

                                <h5 class="d-flex justify-content-between">
                                    <span>L. {{ number_format($property->price, 2) }}</span>
                                    <span class="text-capitalize">{{ trans("messages.$property->type") }} {{ trans('messages.for') }} {{ trans("messages.$property->purpose") }}</span>
                                </h5>
                                <hr>
                                <span class="btn-flat">
                                    <i class="fas fa-bed fa-fw"></i> {{ trans("messages.Bedroom")}}: <strong>{{ $property->bedroom}}</strong>
                                    </span>
                                <span class="btn-flat">
                                        <i class="fas fa-bath fa-fw"></i> {{ trans("messages.Bathroom")}}: <strong>{{ $property->bathroom}}</strong>
                                    </span>
                                <span class="btn-flat">
                                        <i class="fas fa-ruler-combined fa-fw"></i> {{ trans("messages.Area")}}:  <strong>{{ $property->area}}</strong> m<sup>2</sup>
                                    </span>
                                <span class="btn-flat">
                                        <i class="fas fa-comment-alt fa-fw"></i> {{ trans("messages.Comments")}}:
                                        {{ $property->comments_count}}
                                </span>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        {{
                            $properties->appends([
                                'city'      => Request::get('city'),
                                'type'      => Request::get('type'),
                                'purpose'   => Request::get('purpose'),
                                'bedroom'   => Request::get('bedroom'),
                                'bathroom'  => Request::get('bathroom'),
                                'minprice'  => Request::get('minprice'),
                                'maxprice'  => Request::get('maxprice'),
                                'minarea'   => Request::get('minarea'),
                                'maxarea'   => Request::get('maxarea'),
                                'featured'  => Request::get('featured')
                            ])->links()
                        }}
                    </div>
                </div>
                <aside class="col-lg-6 col-md-7 col-12">
                    <div class="sidebar service-sidebar">
                        <div class="custom service-category">
                            <h3 class="text-capitalize mb-2">{{ trans('messages.Search Property') }}</h3>

                            <form action="{{ route('search')}}" method="GET">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <input class="form-control form-control-sm rounded-0" type="text" name="city"
                                               id="autocomplete-input-sidebar"
                                               placeholder=" {{ trans('messages.Enter City or State') }}"
                                               autocomplete="off">
                                    </div>
                                    <div class="col-lg-6 mt-3 mx-auto d-grid gap-2 ">
                                        <input type="checkbox" class="btn-check" id="btn-check-outlined"
                                               autocomplete="off" name="featured">
                                        <label class="btn btn-outline-primary btn-sm  rounded-0"
                                               for="btn-check-outlined">{{ trans('messages.Featured Only') }}</label>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <select class="form-select form-select-sm rounded-0" name="type">
                                            <option value="" disabled
                                                    selected>{{ trans('messages.Choose Type') }}</option>
                                            <option value="apartment">{{ trans('messages.Apartment') }}</option>
                                            <option value="house">{{ trans('messages.House') }}</option>
                                            <option value="house">{{ trans('messages.Land') }}</option>
                                            <option value="house">{{ trans('messages.Building') }}</option>
                                            <option value="house">{{ trans('messages.Warehouse') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <select class="form-select form-select-sm rounded-0" name="purpose"
                                                class="browser-default">
                                            <option value="" disabled
                                                    selected>{{ trans('messages.Choose Purpose') }}</option>
                                            <option value="rent">{{ trans('messages.Rent') }}</option>
                                            <option value="sale">{{ trans('messages.Sale') }}</option>
                                        </select>

                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <select class="form-select form-select-sm rounded-0" name="bedroom"
                                                class="browser-default">
                                            <option value="" disabled
                                                    selected>{{ trans('messages.Choose Bedroom') }}</option>
                                            @foreach($bedroomdistinct as $bedroom)
                                                <option value="{{$bedroom->bedroom}}">{{$bedroom->bedroom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <select class="form-select form-select-sm rounded-0" name="bathroom"
                                                class="browser-default">
                                            <option value="" disabled
                                                    selected>{{ trans('messages.Choose Bathroom') }}</option>
                                            @foreach($bathroomdistinct as $bathroom)
                                                <option value="{{$bathroom->bathroom}}">{{$bathroom->bathroom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <input class="form-control form-control-sm rounded-0" type="number"
                                               name="minprice"
                                               placeholder="{{ trans('messages.Min Price') }}" id="minprice">
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <input class="form-control form-control-sm rounded-0" type="number"
                                               name="maxprice"
                                               placeholder="{{ trans('messages.Max Price') }}" id="maxprice">
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="input-field col s12">
                                            <input class="form-control form-control-sm rounded-0" type="number"
                                                   name="minarea"
                                                   placeholder="{{ trans('messages.Floor Min Area') }}"
                                                   id="minarea">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="input-field col s12">
                                            <input class="form-control form-control-sm rounded-0" type="number"
                                                   name="maxarea"
                                                   placeholder="{{ trans('messages.Floor Max Area') }}"
                                                   id="maxarea">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="input-field col s12 d-flex justify-content-end">
                                            <button class="btn btn-primary rounded-0" type="submit">
                                                <i class="fas fa-search"></i>
                                                <span>{{ trans('messages.Search') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>


@endsection

@section('scripts')

@endsection