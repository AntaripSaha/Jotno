<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
    <li class="nav-item">
        <a class="nav-link @if(  Route::currentRouteName() == 'patient.dashboard' ) active @endif" href="{{ route('patient.dashboard') }}">Today</a>
    </li>
    <li class="nav-item @if(  Route::currentRouteName() == 'patient.dashboard.appoinment.all' ) active @endif">
        <a class="nav-link" href="{{ route('patient.dashboard.appoinment.all') }}">All</a>
    </li>
    <li class="nav-item">
        <button type="button" class="btn btn-primary" id="get_appoinment">
            Get Appoinment
        </button>
    </li>
</ul>
