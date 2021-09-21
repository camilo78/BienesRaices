@extends('frontend.layouts.app')

@section('styles')
@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('agent.sidebar')
                </div>

                <div class="col-md-9">

                    <h4 class="agent-title">{{ trans('messages.Property List') }}</h4>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>{{ trans('messages.Title') }}</th>
                                    <th>{{ trans('messages.Type') }}</th>
                                    <th>{{ trans('messages.City') }}</th>
                                    <th class="text-center"><i class="far fa-comment"></i></th>
                                    <th class="text-center"><i class="far fa-star"></i></th>
                                    <th class="text-center">{{ trans('messages.Action') }}</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach( $properties as $key => $property )
                                    <tr>
                                        <td class="right-align">{{$key+1}}.</td>
                                        <td>
                                            <span class="tooltipped" data-position="bottom" data-tooltip="{{$property->title}}">
                                                {{ str_limit($property->title,30) }}
                                            </span>
                                        </td>
                                        
                                        <td>{{ ucfirst($property->type) }}</td>
                                        <td>{{ ucfirst($property->city) }}</td>

                                        <td class="text-center">
                                            <span><i class="fas fa-comment fa-fw"></i> {{ $property->comments_count }}</span>
                                        </td>

                                        <td class="text-center">
                                            @if($property->featured == true)
                                                <span class="text-warning"><i class="fas fa-star"></i></span>
                                            @endif
                                        </td>
    
                                        <td class="text-center">
                                            <a href="{{route('property.show',$property->slug)}}" target="_blank" class="btn btn-info btn-sm rounded-0">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a href="{{route('agent.properties.edit',$property->slug)}}" class="btn btn-warning btn-sm rounded-0">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm rounded-0" onclick="deleteProperty({{$property->id}})">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <form action="{{route('agent.properties.destroy',$property->slug)}}" method="POST" id="del-property-{{$property->id}}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="center">
                            {{ $properties->links() }}
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
        function deleteProperty(id){
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel", "Yes, delete it!"]
            }).then((value) => {
                if (value) {
                    document.getElementById('del-property-'+id).submit();
                    swal(
                    'Deleted!',
                    'Property has been deleted.',
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