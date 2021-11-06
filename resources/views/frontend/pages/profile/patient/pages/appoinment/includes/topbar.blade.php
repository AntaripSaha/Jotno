

<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
    <li class="nav-item">
        <a class="nav-link @if(  Route::currentRouteName() == 'patient.appoinment.details' ) active @endif" href="{{ route('patient.appoinment.details',$appoinment->appoinment_no) }}">
            Appoinment Details
        </a>
    </li>

    @if( $appoinment->prescription->count() != 0 )
        <li class="nav-item @if( Route::currentRouteName() == 'patient.perscription.view' || Route::currentRouteName() == 'patient.perscription.billing' ) active @endif">
            <a class="nav-link" href="{{ route('patient.perscription.view',$appoinment->prescription[0]->prescription_no) }}">
                Prescription No : {{ $appoinment->prescription[0]->prescription_no }}
            </a>
        </li>
    @endif
    
</ul>