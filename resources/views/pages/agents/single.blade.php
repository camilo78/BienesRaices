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
                <h5>Property List of {{ $agent->name }}</h5>
                {{-- AGENT PROPERTIES --}}
                @foreach($properties as $property)
                <div class="card border-0 mb-3">

                        <span class="card-image-bg" style="background-image:url({{Storage::url('property/'.$property->image)}});"></span>

                    <div class="card-body">
                        <div class="p-20 property-content">
                            <span class="card-title search-title" title="{{$property->title}}">
                                <a href="{{ route('property.show',$property->slug) }}">{{ str_limit($property->title,25) }}</a>
                            </span>
                            <h5>
                            &dollar;{{ $property->price }}
                            <small class="right p-r-10">{{ $property->type }} for {{ $property->purpose }}</small>
                            </h5>
                        </div>
                        <div class="card-action property-action">
                            <span class="btn-flat">
                                <i class="material-icons">check_box</i>
                                Beds: <strong>{{ $property->bedroom}}</strong>
                            </span>
                            <span class="btn-flat">
                                <i class="material-icons">check_box</i>
                                Baths: <strong>{{ $property->bathroom}}</strong>
                            </span>
                            <span class="btn-flat">
                                <i class="material-icons">check_box</i>
                                Area: <strong>{{ $property->area}}</strong> Sq Ft
                            </span>
                            @if($property->featured == 1)
                            <span class="right featured-stars">
                                <i class="material-icons">stars</i>
                            </span>
                            @endif
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
                        <h5 class="widget-title">Contact with Agent</h5>
                        <li class="collection agent-message">
                            <form class="agent-message-box" action="" method="POST">
                                @csrf
                                <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div class="box">
                                    <input type="text" name="name" placeholder="Your Name">
                                </div>
                                <div class="box">
                                    <input type="email" name="email" placeholder="Your Email">
                                </div>
                                <div class="box">
                                    <input type="number" name="phone" placeholder="Your Phone">
                                </div>
                                <div class="box">
                                    <textarea name="message" placeholder="Your Msssage"></textarea>
                                </div>
                                <div class="box">
                                    <button id="msgsubmitbtn" class="btn waves-effect waves-light w100 indigo" type="submit">
                                    SEND
                                    <i class="material-icons left">send</i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
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
$(btn).empty().append('LOADING...<i class="material-icons left">rotate_right</i>');
},
success: function(data) {
if (data.message) {
M.toast({html: data.message, classes:'green darken-4'})
}
},
error: function(xhr) {
M.toast({html: xhr.statusText, classes: 'red darken-4'})
},
complete: function() {
$('form.agent-message-box')[0].reset();
$(btn).removeClass('disabled');
$(btn).empty().append('SEND<i class="material-icons left">send</i>');
},
dataType: 'json'
});
})
})
</script>
@endsection