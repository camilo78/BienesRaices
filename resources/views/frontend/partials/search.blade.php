<section class="section free-version-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="text-white wow fadeInLeft" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">{{ trans('messages.Property Search Engine') }}</h2>
                </div>
                <form action="{{ route('search')}} "class="row gx-3 gy-2 align-items-center wow fadeInRight" data-wow-delay=".4s"
                      style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-text rounded-0"><i style="color:  #3e54ff" class="fas fa-map-marked-alt"></i></div>
                            <input type="text" name="city" id="autocomplete-input"  class="form-control rounded-0" style="height: 38px" placeholder="{{ trans('messages.City or State') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <select name="type" class="form-select form-select-md rounded-0">
                            <option value="" disabled selected>{{ trans('messages.Choose Type') }}</option>
                            <option value="apartment">{{ trans('messages.Apartment') }}</option>
                            <option value="house">{{ trans('messages.House') }}</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select name="purpose" class="form-select form-select-md rounded-0">
                            <option value="" disabled selected>{{ trans('messages.Purpose') }}</option>
                            <option value="rent">{{ trans('messages.Rent') }}</option>
                            <option value="sale">{{ trans('messages.Sale') }}</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select name="bedroom" class="form-select form-select-md rounded-0">
                            <option value="" disabled selected>{{ trans('messages.Bedroom') }}</option>
                            @if(isset($bedroomdistinct))
                                @foreach($bedroomdistinct as $bedroom)
                                    <option value="{{$bedroom->bedroom}}">{{$bedroom->bedroom}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group input-group-md">
                            <div class="input-group-text rounded-0"><i  style="color:  #3e54ff" class="fas fa-dollar-sign"></i></div>
                            <input type="text" name="maxprice" id="autocomplete-input"  class="form-control rounded-0" style="height: 38px"  placeholder="Max Price">
                        </div>
                    </div>
                    <div class="col-sm-2 d-grid">
                        <button type="submit" class="btn btn-outline-light rounded-0"><i class="fas fa-search"></i> {{ trans('messages.Search') }} </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
