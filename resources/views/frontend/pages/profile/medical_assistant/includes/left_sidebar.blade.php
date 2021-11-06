<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                @if( auth('medical_assistant')->user()->image )
                <img src="{{ asset('images/profile/medical_assistant/'.auth('medical_assistant')->user()->image) }}"
                    alt="User Image">
                @else
                <img src="{{ asset('images/profile/user.png') }}" alt="User Image">
                @endif
            </a>
            <div class="profile-det-info">
                <h3>{{ auth('medical_assistant')->user()->name }}</h3>
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li @if( Route::currentRouteName()=='medical.assistant.dashboard' || Route::currentRouteName()=='medical.assistant.dashboard.appoinment.all' ) class="active" @endif>
                    <a href="{{ route('medical.assistant.dashboard') }}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li @if( Route::currentRouteName()=='medical.assistant.profile.setting.page' ) class="active" @endif>
                    <a href="{{ route('medical.assistant.profile.setting.page') }}">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
                <li @if( Route::currentRouteName()=='medical.assistant.change.password.page' ) class="active" @endif>
                    <a href="{{ route('medical.assistant.change.password.page') }}">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                        <form action="{{ route('medical.assistant.logout') }}" id="logout-form" method="post">
                            @csrf</form>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
