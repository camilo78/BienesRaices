<div class="card shadow border-0 mb-4">
    <img src="{{Storage::url('users/'.auth()->user()->image)}}" alt="{{ auth()->user()->name }}">
    <div class="card-body text-center">
        <p class="h5">{{ auth()->user()->name }}</p>
        <p class=""><small>{{ auth()->user()->email }}</small></p>
    </div>
    <ul class="list-group list-group-flush">
        <a href="{{ route('agent.dashboard') }}">
            <li class="list-group-item {{ Request::is('agent/dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt fa-fw"></i>
                <span>{{ trans('messages.Dashboard') }}<span>
            </li>
        </a>
        <a href="{{ route('agent.profile') }}">
            <li class="list-group-item {{ Request::is('agent/profile') ? 'active' : '' }}">
                <i class="fas fa-id-badge fa-fw"></i>
                <span>{{ trans('messages.Profile') }}<span>
            </li>
        </a>
        <a href="{{ route('agent.message') }}">
            <li class="list-group-item {{ Request::is('agent/message*') ? 'active' : '' }}">
                <i class="fas fa-mail-bulk fa-fw"></i>
                <span>{{ trans('messages.Messages') }}<span>
            </li>
        </a>

    <a href="{{ route('agent.properties.index') }}">
        <li class="list-group-item {{ Request::is('agent/properties') ? 'active' : '' }}">
            <i class="fas fa-city"></i>
            <span>{{ trans('messages.Properties') }}<span>
        </li>
    </a>
    <a href="{{ route('agent.properties.create') }}">
        <li class="list-group-item {{ Request::is('agent/properties/create') ? 'active' : '' }}">
            <i class="fas fa-laptop-house fa-fw"></i>
            <span>{{ trans('messages.Create Property') }}<span>
        </li>
    </a>
    <a href="{{ route('agent.changepassword') }}">
        <li class="list-group-item {{ Request::is('agent/changepassword') ? 'active' : '' }}">
            <i class="fas fa-id-badge fa-fw"></i>
            <span>{{ trans('messages.Change Password') }}<span>
        </li>
    </a>
</ul>
</div>