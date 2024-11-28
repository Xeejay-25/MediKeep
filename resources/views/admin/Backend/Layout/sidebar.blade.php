@include('components.preloader')
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    @include('components.sidenav-logo')
    <hr class="horizontal dark mt-0">
    
    <div class="collapse navbar-collapse w-auto max-height-vh-70 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @include('components.nav-link', [
                'route' => 'admin.home',
                'icon' => '
                  <svg width="12px" height="12px" viewBox="0 0 45 40" xmlns="http://www.w3.org/2000/svg">
                    <g fill="#FFFFFF" fill-rule="nonzero">
                      <path class="color-background opacity-4" d="M46.72,10.74 L40.84,0.95 C40.49,0.36 39.85,0 39.17,0 L7.83,0 C7.15,0 6.51,0.36 6.16,0.95 L0.28,10.74 C0.1,11.05 0,11.39 0,11.75 C0,16.07 3.48,19.57 7.8,19.58 C9.75,19.59 11.62,18.87 13.05,17.58 C16.02,20.26 20.53,20.26 23.49,17.58 C26.46,20.26 30.98,20.26 33.95,17.58 C36.24,19.65 39.54,20.17 42.37,18.91 C45.19,17.65 47,14.84 47,11.75 C47,11.39 46.9,11.05 46.72,10.74 Z"></path>
                      <path class="color-background" d="M39.2,22.49 C37.38,22.49 35.58,22.01 33.95,21.1 L33.92,21.11 C31.14,22.68 27.93,22.93 24.98,21.8 C24.48,21.61 23.98,21.37 23.5,21.1 L23.47,21.11 C20.7,22.69 17.48,22.93 14.54,21.8 C14.03,21.61 13.53,21.37 13.05,21.1 C11.43,22.02 9.63,22.49 7.82,22.49 C7.17,22.48 6.52,22.42 5.88,22.29 L5.88,44.72 C5.88,45.95 6.75,46.95 7.83,46.95 L19.58,46.95 L19.58,33.61 L27.42,33.61 L27.42,46.95 L39.17,46.95 C40.25,46.95 41.13,45.95 41.13,44.72 L41.13,22.28 C40.49,22.41 39.84,22.48 39.2,22.49 Z"></path>
                    </g>
                  </svg>',
                'label' => 'Home'
            ])
            
            @include('components.nav-link', [
                'route' => 'users.index',
                'icon' => '
                  <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <g fill="#FFFFFF">
                        <circle cx="12" cy="8" r="4" class="color-background"></circle>
                        <path class="color-background" d="M12,14c-4,0-8,2-8,6v2h16v-2C20,16,16,14,12,14z"></path>
                    </g>
                </svg>',
                'label' => 'Users'
            ])
            
            <li class="nav-item">
                <a class="nav-link @if(Request::is('activity-logs')) active @endif" href="{{ route('activity.logs') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                            <g fill="#FFFFFF" fill-rule="nonzero">
                                <path class="color-background opacity-6" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78 9.53,0 10.5,0 L31.5,0 C32.47,0 33.25,0.78 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                                <path class="color-background" d="M40.25,14 L24.5,14 C23.53,14 22.75,14.78 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78 18.47,21 17.5,21 L1.75,21 C0.78,21 0,21.78 0,22.75 L0,40.25 C0,41.22 0.78,42 1.75,42 L40.25,42 C41.22,42 42,41.22 42,40.25 L42,15.75 C42,14.78 41.22,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z"></path>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Activity Logs</span>
                </a>
            </li>
        </ul>
    </div>
    @include('components.logout-button')
</aside>
