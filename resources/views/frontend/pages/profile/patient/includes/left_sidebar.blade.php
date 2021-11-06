<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                @if( auth('patient')->user()->image )
                <img src="{{ asset('images/profile/patient/'.auth('patient')->user()->image) }}" alt="User Image">
                @else
                <img src="{{ asset('images/profile/user.png') }}" alt="User Image">
                @endif
            </a>
            <div class="profile-det-info">
                <h3>{{ auth('patient')->user()->name }}</h3>
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li @if( Route::currentRouteName()=='patient.dashboard' || Route::currentRouteName()=='patient.dashboard.appoinment.all' ) class="active" @endif>
                    <a href="{{ route('patient.dashboard') }}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li @if( Route::currentRouteName()=='patient.profile.setting.page' ) class="active" @endif>
                    <a href="{{ route('patient.profile.setting.page') }}">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
                <li @if( Route::currentRouteName()=='patient.change.password.page' ) class="active" @endif>
                    <a href="{{ route('patient.change.password.page') }}">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                        <form action="{{ route('patient.logout') }}" id="logout-form" method="post">
                            @csrf</form>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
