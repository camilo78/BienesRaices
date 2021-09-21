@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-12">
                <div class="card border-0 mb-3">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <img src="{{Storage::url('users/'.$agent->image)}}" class="img-fluid rounded-start" alt="{{ $agent->username }}">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">{{ $agent->name }}</h5>
                                <a class="card-fot" href="mailto:{{ $agent->email }}">{{ $agent->email }}</a>
                                <p class="card-text">{{ $agent->about }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h5>{{ trans('messages.Property List of') }} {{ $agent->name }}</h5>
                {{-- AGENT PROPERTIES --}}
                @foreach($properties as $property)
                <div class="card mb-3 mt-3">
                    <div class="row g-0">
                        <div class="col-lg-4">
                            <div class="p-ribbon">
                                @if($property->featured == 1)
                                <div class="ribbon"><i
                                class="far fa-star"></i> {{ trans('messages.Featured') }}</div>
                                @endif
                            </div>
                            <img src="{{Storage::url('property/'.$property->image)}}" class="img-fluid rounded-start" alt="{{$property->title}}">
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body">
                                <h5 class="card-title card-fot"><a href="{{ route('property.show',$property->slug) }}">{{$property->title}}</a></h5>
                                <p class="card-text h5">L. {{ number_format($property->price, 2) }}</p>
                                <p>
                                    <span class="text-body text-capitalize"><i class="far fa-check-square fa-fw"></i> {{ trans("messages.$property->type") }}</span>
                                    <span class="text-body text-capitalize"><i
                                    class="far fa-check-square fa-fw"></i> {{ trans("messages.for") }} {{ trans("messages.$property->purpose") }}</span>
                                </p>
                                <p>
                                    <span class="text-body"><i class="fas fa-bed fa-fw"></i> {{ trans("messages.Bedroom")}}: {{ $property->bedroom }}</span>
                                    <span class="text-body"><i class="fas fa-bath fa-fw"></i> {{ trans("messages.Bathroom")}}: {{ $property->bathroom }}</span>
                                    <span class="text-body"><i class="fas fa-ruler-combined fa-fw"></i> {{ trans("messages.Area")}}: {{ $property->area }} m<sup>2</sup></span>
                                    <span class="text-body"><i class="fas fa-comment-alt fa-fw"></i> {{ trans("messages.Comments")}}: {{ $property->comments_count}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="pagination center">
                    {{ $properties->links() }}
                </div>
            </div>
            <aside class="col-lg-4 col-md-5 col-12">
                <div class="sidebar">
                    <div class="widget popular-feeds">
                        <h5 class="widget-title">{{ trans('messages.Contact with Agent')}}</h5>
                        <form class="agent-message-box" action="" method="POST">
                            @csrf
                            <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="box">
                                <input type="text" name="name" placeholder="  {{ trans('messages.Your Name') }}" class="form-control rounded-0 mb-3">
                            </div>
                            <div class="box">
                                <input type="email" name="email" placeholder="  {{ trans('messages.Your Email') }}" class="form-control rounded-0 mb-3">
                            </div>
                            <div class="box">
                                <input type="number" name="phone" placeholder="  {{ trans('messages.Your Phone') }}" class="form-control rounded-0 mb-3">
                            </div>
                            <div class="box">
                                <textarea name="message" placeholder="{{ trans('messages.Your Message') }}" class="form-control rounded-0 mb-3"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="msgsubmitbtn" class="btn btn-primary rounded-0" type="submit">
                                {{ trans('messages.Send') }} <i class="far fa-share-square"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @section('scripts')
    <script>
    $(function(){
    $(document).on('submit','.agent-message-box',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var url = "{{ route('property.message') }}";
        var btn = $('#msgsubmitbtn');
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            beforeSend: function() {
                $(btn).addClass('disabled');
                $(btn).empty().append('{{ trans('messages.Loading') }}... <i class="fas fa-sync fa-spin"></i>');
            },
            success: function(data) {
                if (data.message) {
                    toastr.success(data.message)
                }
            },
            error: function(xhr) {
                toastr.success(xhr.statusText)
            },
            complete: function() {
                $('form.agent-message-box')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('{{ trans('messages.Sent') }} <i class="far fa-share-square"></i>');
            },
            dataType: 'json'
            });
        })
    })
    </script>
    @endsection