<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
    <li class="nav-item">
        <a class="nav-link @if(  Route::currentRouteName() == 'medical.assistant.appoinment.details' ) active @endif" href="{{ route('medical.assistant.appoinment.details',$appoinment->appoinment_no) }}">
            Appoinment Details
        </a>
    </li>
    @if( $appoinment->doctor_id )
        @if( $appoinment->prescription->count() < 1 )
        <li class="nav-item">
            <a class="nav-link @if(  Route::currentRouteName() == 'medical.assistant.appoinment.create.page' ) active @endif" href="{{ route('medical.assistant.appoinment.create.page',$appoinment->appoinment_no) }}">
                Add Prescription
            </a>
        </li>
        @endif
        
        @if( $appoinment->prescription->count() != 0 )
        <li class="nav-item @if(  Route::currentRouteName() == 'medical.assistant.perscription.view' || Route::currentRouteName() == 'medical.assistant.perscription.edit.page' || Route::currentRouteName() == 'medical.assistant.perscription.billing' ) active @endif">
            <a class="nav-link" href="{{ route('medical.assistant.perscription.view',$appoinment->prescription[0]->prescription_no) }}">
                Prescription No : {{ $appoinment->prescription[0]->prescription_no }}
            </a>
        </li>
        @endif
    @endif


    

</ul>