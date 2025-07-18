<li class="nav-item">
  <a class="nav-link @if(isset($route) && Request::routeIs($route)) active @endif" 
     href="{{ isset($route) ? route($route) : '#' }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      {!! isset($icon) ? $icon : '<span class="default-icon">🔗</span>' !!}
    </div>
    <span class="nav-link-text ms-1">{{ isset($label) ? $label : 'Default Label' }}</span>
  </a>
</li>
