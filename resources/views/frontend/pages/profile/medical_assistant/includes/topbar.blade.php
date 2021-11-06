


<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
    <li class="nav-item">
        <a class="nav-link @if(  Route::currentRouteName() == 'medical.assistant.dashboard' ) active @endif" href="{{ route('medical.assistant.dashboard') }}">Today</a>
    </li>
    <li class="nav-item @if(  Route::currentRouteName() == 'medical.assistant.dashboard.appoinment.all' ) active @endif">
        <a class="nav-link" href="{{ route('medical.assistant.dashboard.appoinment.all') }}">All</a>
    </li> 
</ul>



