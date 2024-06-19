<div class="content-wrapper pt-5">
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning">401</h2>
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page can only accessed by Admin</h3>
          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
         </a><form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
          </p>
        </div>
      </div>
    </section>
  </div>
