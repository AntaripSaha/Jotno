<div class="profile-sidebar">

    <!-- PROFILE INFORMATION START -->
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="{{ route('doctor.dashboard') }}" class="booking-doc-img">
                @if( auth('doctor')->user()->image )
                <img src="{{ asset('images/profile/doctor/'.auth('doctor')->user()->image) }}" alt="User Image">
                @else
                <img src="{{ asset('images/profile/user.png') }}" alt="User Image">
                @endif
            </a>
            <div class="profile-det-info">
                <h3>{{ auth('doctor')->user()->name }}</h3>
                <div class="patient-details">
                    <h5 class="mb-0">
                        <!-- {!! auth('doctor')->user()->designation !!} -->
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <!-- PROFILE INFORMATION END -->

    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li @if( Route::currentRouteName()=='doctor.dashboard' || Route::currentRouteName()=='doctor.dashboard.appoinment.all' ) class="active" @endif>
                    <a href="{{ route('doctor.dashboard') }}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li @if( Route::currentRouteName()=='doctor.profile.setting.page' ) class="active" @endif>
                    <a href="{{ route('doctor.profile.setting.page') }}">
                        <i class="fas fa-user-cog"></i>
                        <span>Update Profile</span>
                    </a>
                </li>
                <li @if( Route::currentRouteName()=='doctor.change.password.page' ) class="active" @endif>
                    <a href="{{ route('doctor.change.password.page') }}">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                        <form action="{{ route('doctor.logout') }}" id="logout-form" method="post">
                            @csrf</form>
                    </a>
                </li>
            </ul>
        </nav>




    </div>
</div>
