<footer class="footer">

    <div class="footer-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget footer-about">
                        <div class="footer-logo">
                            @php  $footer_logo = App\Models\SettingsModule\AppInfo::select('footer_logo','footer_text')->first(); @endphp
                            <img src="{{ asset('images/info/'.$footer_logo->footer_logo) }}" alt="logo">
                        </div>
                        <div class="footer-about-content">
                            <p>{{ $footer_logo->footer_text }}</p>
                            <div class="social-icon">
                                <ul>
                                    <li>
                                        <a href="{{ $app_info->facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                                    </li>
                                    <li>
                                        <a href="{{ $app_info->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i> </a>
                                    </li>
                                    <li>
                                        <a href="{{ $app_info->linkedin_url }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">Information</h2>
                        
                        <ul>
                            @foreach (\App\Models\PageModule\NewPage::select('id','name','slug','description')->orderBy('id','desc')->get() as $new_page)
                            <li><a href="{{ route('new.page.view', $new_page->slug) }}">{{ $new_page->name }}</a></li>
                            @endforeach
                            
                        </ul>

                        <ul>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">Important Links</h2>
                        <ul>
                            <li><a href="#">Appointments</a></li>

                            @if( auth('doctor')->check() == false && auth('patient')->check() == false && auth('medical_assistant')->check() == false )
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @endif

                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">Contact Us</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address">
                                <span><i class="fas fa-map-marker-alt"></i></span>
                                <p> {{ $app_info->address }}</p>
                            </div>
                            <p>
                                <i class="fas fa-mobile-alt"></i>
                                +88-{{ $app_info->phone }}
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-envelope"></i>
                                <a style="color:white;" href="mailto:info@jotno.com">{{ $app_info->email }}</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="footer-bottom">
        <div class="container-fluid">

            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                            <p class="mb-0">&copy; 2021 jotno. All rights reserved. | Developed by
                                <a style="color: yellow" href="https://zaman-it.com">ZAMAN IT</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">

                    </div>
                </div>
            </div>

        </div>
    </div>

</footer>
