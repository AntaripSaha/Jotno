<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <a href="{{ route('home') }}" class="navbar-brand logo">
                <img src="{{ asset('images/info/'.$app_info->logo) }}" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{ route('home') }}" class="menu-logo">
                    <img src="{{ asset('frontend/img/logo-4.png') }}" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                <li @if( Route::currentRouteName()=='home' ) class="active" @endif>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li @if( Route::currentRouteName()=='about' ) class="active" @endif>
                    <a href="{{ route('about') }}">About US</a>
                </li>
                <li @if( Route::currentRouteName()=='all.services' ) class="active" @endif>
                    <a href="{{ route('all.services') }}">Our Services</a>
                </li>
                <li @if( Route::currentRouteName()=='contact' ) class="active" @endif>
                    <a href="{{ route('contact') }}">Contact US</a>
                </li>
                <li @if( Route::currentRouteName()=='blog' ) class="active" @endif>
                    <a href="{{route('blog')}}">Blog</a>
                </li>
                <li class="login-link">
                    @if( auth('doctor')->check() )
                    <a href="{{ route('doctor.dashboard') }}">
                        My Profile
                    </a>
                    @elseif( auth('medical_assistant')->check() )
                    <a href="{{ route('medical.assistant.dashboard') }}">
                        My Profile
                    </a>
                    @elseif( auth('patient')->check() )
                    <a href="{{ route('patient.dashboard') }}">
                        My Profile
                    </a>
                    @else
                    <a href="{{ route('login') }}">login / Reg </a>
                    @endif
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            <li class="nav-item contact-item">
                <div class="header-contact-img">
                    <i class="far fa-hospital"></i>
                </div>
                <div class="header-contact-detail">
                    <p class="contact-header">Contact</p>
                    <p class="contact-info-header"> +88-{{ $app_info->phone }}</p>
                </div>
            </li>
            <li class="nav-item">
                @if( auth('doctor')->check() )
                <a class="nav-link header-login" href="{{ route('doctor.dashboard') }}">
                    {{ substr(auth("doctor")->user()->name, 0, 1) }}
                </a>
                @elseif( auth('medical_assistant')->check() )
                <a class="nav-link header-login" href="{{ route('medical.assistant.dashboard') }}">
                    {{ substr(auth("medical_assistant")->user()->name, 0, 1) }}
                </a>
                @elseif( auth('patient')->check() )
                <a class="nav-link header-login" href="{{ route('patient.dashboard') }}">
                    {{ substr(auth("patient")->user()->name, 0, 1) }}
                </a>
                @else
                <a class="nav-link header-login" href="{{ route('login') }}">login / Reg </a>
                @endif
            </li>
        </ul>
    </nav>
</header>