    <div class="sidenav-footer mx-3 ">
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>

      <a class="btn bg-gradient-primary mt-4 w-100" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
      </a>
    </div>