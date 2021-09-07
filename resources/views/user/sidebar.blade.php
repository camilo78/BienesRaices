<div class="card shadow border-0 mb-4">
    <img src="{{Storage::url('users/'.auth()->user()->image)}}" alt="{{ auth()->user()->name }}">
    <div class="card-body text-center">
        <p class="h5">{{ auth()->user()->name }}</p>
        <p class=""><small>{{ auth()->user()->email }}</small></p>
    </div>
    <ul class="list-group list-group-flush">
        <a href="{{ route('user.dashboard') }}">
            <li class="list-group-item {{ Request::is('user/dashboard') ? 'active' : 'card-fot' }}">
                <i class="fas fa-tachometer-alt fa-fw"></i>
                <span>{{ trans('messages.Dashboard') }}<span>
                </li>
            </a>
            <a href="{{ route('user.profile') }}">
                <li class="list-group-item {{ Request::is('user/profile') ? 'active' : 'card-fot' }}">
                    <i class="fas fa-id-badge fa-fw"></i>
                    <span>{{ trans('messages.Profile') }}<span>
                </li>
            </a>
            <a href="{{ route('user.message') }}">
                <li class="list-group-item {{ Request::is('user/message*') ? 'active' : 'card-fot' }}">
                    <i class="fas fa-mail-bulk fa-fw"></i>
                    <span>{{ trans('messages.Messages') }}<span>
                </li>
            </a>
            <a href="{{ route('user.changepassword') }}">
                <li class="list-group-item {{ Request::is('user/changepassword*') ? 'active' : 'card-fot' }}">
                    <i class="fas fa-id-badge fa-fw"></i>
                    <span>{{ trans('messages.Change Password') }}<span>
                </li>
            </a>
        </ul>
    </div>


