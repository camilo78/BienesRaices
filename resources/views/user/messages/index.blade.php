




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
                <div class="card rounded-0 shadow border-0 bg-primary">
                    <div class="card-body">
                        <h4 class="agent-title text-white">{{ trans('messages.Messages') }}</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>{{ trans('messages.Name') }}</th>
                                        <th>{{ trans('messages.Email') }}</th>
                                        <th>{{ trans('messages.Message') }}</th>
                                        <th>{{ trans('messages.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $messages as $key => $message )
                                    <tr>
                                        <td class="right-align">{{$key+1}}.</td>
                                        <td>{{ ucfirst(strtok($message->name,' ')) }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>
                                            <span class="tooltipped" data-position="bottom" data-tooltip="{{$message->message}}">
                                                {{ str_limit($message->message,20) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($message->status == 0)
                                            <a href="{{route('user.message.read',$message->id)}}" class="btn btn-warning btn-sm rounded-0">
                                                <i class="fas fa-book-reader text-white"></i>
                                            </a>
                                            @else
                                            <a href="{{route('user.message.read',$message->id)}}" class="btn btn-success btn-sm rounded-0">
                                                <i class="fas fa-check text-white"></i>
                                            </a>
                                            @endif
                                            <a href="{{route('user.message.replay',$message->id)}}" class="btn btn-primary btn-sm rounded-0">
                                                <i class="fas fa-reply text-white"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm rounded-0" onclick="deleteMessage({{$message->id}})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <form action="{{route('user.messages.destroy',$message->id)}}" method="POST" id="del-message-{{$message->id}}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination center">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteMessage(id){
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel", "Yes, delete it!"]
            }).then((value) => {
                if (value) {
                    document.getElementById('del-message-'+id).submit();
                    swal(
                    'Deleted!',
                    'Message has been deleted.',
                    'success',
                    {
                        buttons: false,
                        timer: 1000,
                    })
                }
            })
        }
    </script>
@endsection