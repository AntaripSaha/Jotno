<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
    <li class="nav-item">
        <a class="nav-link @if(  Route::currentRouteName() == 'doctor.appoinment.details' ) active @endif" href="{{ route('doctor.appoinment.details',$appoinment->appoinment_no) }}">
            Appoinment Details
        </a>
    </li>
    @if( $appoinment->prescription->count() < 1 )
    <li class="nav-item">
        <a class="nav-link @if(  Route::currentRouteName() == 'doctor.appoinment.create.page' ) active @endif" href="{{ route('doctor.appoinment.create.page',$appoinment->appoinment_no) }}">
            Add Prescription
        </a>
    </li>
    @endif

    @if( $appoinment->prescription->count() != 0 )
        <li class="nav-item @if(  Route::currentRouteName() == 'doctor.perscription.view' || Route::currentRouteName() == 'doctor.perscription.edit.page' || Route::currentRouteName() == 'doctor.perscription.billing' ) active @endif">
            <a class="nav-link" href="{{ route('doctor.perscription.view',$appoinment->prescription[0]->prescription_no) }}">
                Prescription No : {{ $appoinment->prescription[0]->prescription_no }}
            </a>
        </li>
    @endif

</ul>