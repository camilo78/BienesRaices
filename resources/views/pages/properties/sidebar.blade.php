<aside class="col-lg-4 col-md-5 col-12">
    @if($property->user)
        <div class="sidebar">
            <div class="widget popular-feeds">
                <h5 class="widget-title">{{ trans('messages.Contact Our Agent') }}</h5>
                <div class="row d-flex align-items-center">
                    <div class="col-md-3">
                        <img src="{{Storage::url('users/'.$property->user->image)}}"
                             alt="{{ $property->user->username }}">
                    </div>
                    <div class="col-md-7">
                        <h5 class="no-margin"><i class="lni lni-user"></i> {{ $property->user->name }}</h5>
                        <a class="no-margin small card-fot" href="mailto:{{ $property->user->email }}"><i class="lni lni-envelope"></i> {{ $property->user->email }}</a>
                    </div>
                    <div class="col-md-12 mt-2">
                        <p> {{ $property->user->about }}</p>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-outline-primary btn-sm rounded-0 mt-3 mb-4"
                               href="{{ route('agents.show',$property->agent_id) }}"> {{ trans('messages.Profile') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 mt-2">
                        <form class="agent-message-box" action="" method="POST">
                            @csrf
                            <input type="hidden" name="agent_id" value="{{ $property->user->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="property_id" value="{{ $property->id }}">

                            <div class="mb-3">
                                <input type="text" class="form-control rounded-0" name="name" placeholder="  {{ trans('messages.Your Name') }}">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control rounded-0" name="email"
                                       placeholder="  {{ trans('messages.Your Email') }}">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control rounded-0" name="phone"
                                       placeholder="  {{ trans('messages.Your Phone') }}">
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control rounded-0"
                                          placeholder="{{ trans('messages.Your Message') }}"></textarea>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button class="btn btn-primary rounded-0" id="msgsubmitbtn" type="submit">{{ trans('messages.Send') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="widget categories-widget">
                <h5 class="widget-title">{{ trans('messages.City List') }}</h5>
                <ul class="custom">
                    @foreach($cities as $city)
                        <li>
                            <a style="border-bottom: 2px solid #3e54ff;"
                               href="{{ route('property.city',$city->city_slug) }}">
                                {{ $city->city }}
                                <span class="rounded-0 border-0"><i class="fas fa-arrow-right"></i></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="widget popular-feeds">
                <h5 class="widget-title">{{ trans('messages.Related Properties') }}</h5>
                <div class="popular-feed-loop ">
                    @foreach($relatedproperty as $property_related)
                        <div class="single-popular-feed ">
                            <div class="feed-img animate-img">
                                <a href="{{ route('property.show',$property_related->id) }}">
                                    <img style=" object-fit: cover;width:75px;height:75px;" src="{{Storage::url('property/'.$property_related->image)}}" alt="{{$property_related->title}}">
                                </a>
                            </div>
                            <div class="feed-desc">
                                <h6 class="post-title">
                                    <a class="fw-bold" href="{{ route('property.show',$property_related->id) }}">{{$property_related->title}}</a>
                                </h6>
                                <span>L. {{$property_related->price}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</aside>

