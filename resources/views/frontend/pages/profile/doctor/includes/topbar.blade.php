<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
    <li class="nav-item">
        <a class="nav-link @if(  Route::currentRouteName() == 'doctor.dashboard' ) active @endif" href="{{ route('doctor.dashboard') }}">Today</a>
    </li>
    <li class="nav-item @if(  Route::currentRouteName() == 'doctor.dashboard.appoinment.all' ) active @endif">
        <a class="nav-link" href="{{ route('doctor.dashboard.appoinment.all') }}" >All</a>
    </li>
</ul>
