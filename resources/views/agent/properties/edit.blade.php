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
                <h4 class="agent-title">EDIT PROPERTY</h4>
                <form action="{{route('agent.properties.update',$property->slug)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="title" class="form-label"><i class="fas fa-home fa-fw"></i> {{ trans('messages.Title') }}</label>
                            <input id="title" name="title" type="text" class="form-control rounded-0" value="{{ old('title', $property->title) }}" data-length="200">
                            @if ($errors->has('title'))
                            <span class="text-danger small">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label class="form-label" for="price"><i class="fas fa-dollar-sign fa-fw"></i> {{ trans('messages.Price') }}</label>
                            <input id="price" name="price" value="{{ old('price', $property->price) }}" type="number" class="form-control rounded-0">
                            @if ($errors->has('price'))
                            <span class="text-danger small">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label class="form-label" for="area"><i class="fas fa-ruler-combined fa-fw"></i> {{ trans('messages.Floor Area') }}</label>
                            <input id="area" name="area" value="{{ old('area', $property->area) }}" type="number" class="form-control rounded-0">
                            @if ($errors->has('area'))
                            <span class="text-danger small">{{ $errors->first('area') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label class="form-label" for="bedroom"><i class="fas fa-bed fa-fw"></i> {{ trans('messages.Bedroom') }}</label>
                            <input id="bedroom" name="bedroom" value="{{ old('bedroom', $property->bedroom) }}" type="number" class="form-control rounded-0">
                            @if ($errors->has('bedroom'))
                            <span class="text-danger small">{{ $errors->first('bedroom') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label class="form-label" for="bathroom"><i class="fas fa-bath fa-fw"></i> {{ trans('messages.Bathroom') }}</label>
                            <input id="bathroom" name="bathroom" value="{{ old('bathroom', $property->bathroom) }}" type="number" class="form-control rounded-0">
                            @if ($errors->has('bathroom'))
                            <span class="text-danger small">{{ $errors->first('bathroom') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label class="form-label" for="city"><i class="fas fa-city fa-fw"></i> {{ trans('messages.City') }}</label>
                            <input id="city" name="city" value="{{ old('city', $property->city) }}" type="text" class="form-control rounded-0">
                            @if ($errors->has('city'))
                            <span class="text-danger small">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-9 col-md-9 mb-3">
                            <label class="form-label" for="address"><i class="fas fa-map-marker-alt fa-fw"></i> {{ trans('messages.Address') }}</label>
                            <textarea id="address" name="address" rows="1" class="form-control rounded-0">{{ old('address', $property->address) }}</textarea>
                            @if ($errors->has('address'))
                            <span class="text-danger small">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="form-label" for="description"><i class="fas fa-edit fa-fw"></i> {{ trans('messages.Description') }}</label>
                            <textarea id="description" name="description" rows="10" class="form-control rounded-0">{{ strip_tags(old('description', $property->description)) }}</textarea>
                            @if ($errors->has('description'))
                            <span class="text-danger small">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label class="form-label" for="featured"><i class="fas fa-star fa-fw"></i> {{ trans('messages.Featured') }}</label>
                            <div class="form-check">
                                <input class="form-check-input rounded-0" type="checkbox" @if(old('featured', $property->featured)) checked @endif name="featured">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    {{ trans('messages.Featured') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 mb-3">
                            <i class="fas fa-check fa-fw"></i>
                            <label class="form-label" for="purpose">{{ trans('messages.Property Purpose') }}</label>
                            <div class="form-check">
                                <label>
                                    <input class="form-check-input" name="type" value="house" type="radio" @if(old('type', $property->type) == 'house') checked @endif />
                                    <span>{{ trans('messages.Sale') }}</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label>
                                    <input class="form-check-input" name="type" value="apartment" type="radio" @if(old('type', $property->type) == 'apartment') checked @endif />
                                    <span>{{ trans('messages.Rent') }}</span>
                                </label>
                            </div>
                            @if ($errors->has('type'))
                            <span class="text-danger small">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3 mb-3">
                            <i class="fas fa-check fa-fw"></i>
                            <label class="form-label" for="type">{{ trans('messages.Property Type') }}</label>
                            <div class="form-check">
                                <label>
                                    <input class="form-check-input" name="purpose" value="sale" @if(old('purpose', $property->purpose) == 'sale') checked @endif type="radio"  />
                                    <span>{{ trans('messages.House') }}</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label>
                                    <input class="form-check-input" name="purpose" value="rent" @if(old('purpose', $property->purpose) == 'rent') checked @endif type="radio"  />
                                    <span>{{ trans('messages.Apartment') }}</span>
                                </label>
                            </div>
                            @if ($errors->has('purpose'))
                            <span class="text-danger small">{{ $errors->first('purpose') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3 mb-3">
                            <i class="fas fa-check fa-fw"></i>
                            <label  class="form-label">{{ trans('messages.Select Features') }}</label>
                            <select  class="form-select rounded-0"  size="2"  multiple name="features[]">
                                @foreach($features as $feature)
                                <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label for="formFile" class="form-label"><i class="far fa-image fa-fw"></i> {{ trans('messages.Featured Image') }}</label>
                            @if($property->image)
                            <img src="{{ asset('/storage/property/'.$property->image) }}" class="img-fluid" alt="{{ $property->title }}">
                            @endif
                            <input class="form-control rounded-0" type="file" name="image" value="{{ old('image', $property->image) }}">
                            @if ($errors->has('image'))
                            <span class="text-danger small">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label for="floor_plan" class="form-label"><i class="far fa-image fa-fw"></i> {{ trans('messages.Floor Plan') }}</label>
                            @if($property->floor_plan)
                            <img src="{{ asset('/storage/property/'.$property->floor_plan) }}" class="img-fluid" alt="{{ $property->title }}">
                            @endif
                            <input type="file" name="floor_plan" class="form-control rounded-0" value="{{ old('floor_plan') }}">
                            @if ($errors->has('floor_plan'))
                            <span class="text-danger small">{{ $errors->first('floor_plan') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label for="location_latitude" class="form-label"><i class="fas fa-map-marked-alt fa-fw"></i> {{ trans('messages.Latitude') }}</label>
                            <input id="location_latitude" name="location_latitude" type="text" class="form-control rounded-0" value="{{ old('location_latitude', $property->location_latitude) }}">
                            @if ($errors->has('location_latitude'))
                            <span class="text-danger small">{{ $errors->first('location_latitude') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3 mb-3">
                            <label for="location_latitude" class="form-label"><i class="fas fa-map-marked-alt fa-fw"></i> {{ trans('messages.Longitude') }}</label>
                            <input id="location_longitude" name="location_longitude" type="text" class="form-control rounded-0" value="{{ old('location_longitude', $property->location_longitude) }}">
                            @if ($errors->has('location_longitude'))
                            <span class="text-danger small">{{ $errors->first('location_longitude') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label for="video" class="form-label"><i class="fab fa-youtube fa-fw"></i> {{ trans('messages.Youtube Link') }}</label>
                            <input id="video" name="video" type="text" class="form-control rounded-0" value="{{ old('video', $property->video) }}">
                            @if ($errors->has('video'))
                            <span class="text-danger small">{{ $errors->first('video') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="nearby" class="form-label"><i class="fas fa-church fa-fw"></i> {{ trans('messages.Nearby') }}</label>
                            <textarea id="nearby" name="nearby" rows="1" class="form-control rounded-0">{{ old('nearby') }}</textarea>
                            @if ($errors->has('nearby'))
                            <span class="text-danger small">{{ $errors->first('nearby') }}</span>
                            @endif
                        </div>
                    </div>
                    @if($property->gallery)
                    <div class="row m-b-0">
                        @foreach($property->gallery as $gallery)
                        <div class="col-lg-3 col-md-3 mb-3">
                            <div class="gallery-image-edit" id="gallery-{{$gallery->id}}">
                                <img class="img-fluid" src="{{Storage::url('property/gallery/'.$gallery->name)}}" alt="{{$gallery->name}}">
                                <button type="button" data-id="{{$gallery->id}}" style="position: absolute; margin-left: -35px;margin-top:5px" class="btn btn-danger btn-sm rounded-0"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="gallaryimage" class="form-label"><i class="far fa-images fa-fw"></i> {{ trans('messages.Gallery Images') }}</label>
                            <input type="file" name="gallaryimage[]" class="form-control rounded-0" multiple>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3 d-flex justify-content-end">
                            <button class="btn btn-lg btn-primary rounded-0" type="submit">
                            {{ trans('messages.Send') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div> <!-- /.col -->
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // DELETE PROPERTY GALLERY IMAGE
        $('.gallery-image-edit button').on('click',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var image = $('#gallery-'+id+' img').attr('alt');
            $.post("{{route('agent.gallery-delete')}}",{id:id,image:image},function(data){
                if(data.msg == true){
                    $('#gallery-'+id).parent().remove();
                    toastr.success('{{ trans('messages.Image deleted successfully') }}.')
                }
            });
            
        });
    });
</script>
@endsection