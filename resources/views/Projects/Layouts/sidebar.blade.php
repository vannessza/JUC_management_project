<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary" style="height: 1000px;">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="sidebar">
        <a class="<?php echo Request::is('dashboard') ? 'bg-dark text-white' : ''; ?>" href="/dashboard"><svg class="bi"><use xlink:href="#house-fill"/></svg> Home</a>
        <a class="<?php echo Request::is('dashboard/projects') ? 'bg-dark text-white' : ''; ?>" href="/dashboard/projects"><svg class="bi"><use xlink:href="#file-earmark"/></svg> Projects</a>
        <a class="<?php echo Request::is('dashboard/vendor') ? 'bg-dark text-white' : ''; ?>" href="/dashboard/vendor"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
          <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
          <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z"/>
          </svg> Vendor</a>
          <a class="<?php echo Request::is('dashboard/user') ? 'bg-dark text-white' : ''; ?>" href="/dashboard/user"><i class="bi bi-person-plus-fill"></i> User</a>
          <a class="<?php echo Request::is('dashboard/admin') ? 'bg-dark text-white' : ''; ?>" href="/dashboard/admin"><i class="bi bi-person-plus-fill"></i> Admin</a>
          <hr class="my-3">
        <ul class="nav flex-column mb-auto">
            <li class="nav-item dropdown">
                <button class="nav-link d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: black;">
                    <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
                    Settings
                </button>
                <ul class="dropdown-menu dropdown-menu-link">
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                </ul>
            </li>            
          <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="#">
                  <svg class="bi"><use xlink:href="#door-closed"/></svg>
                  <form action="/logout" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item"> Logout</button>
                  </form>
              </a>
          </li>
      </ul>
      </div>
      
      <!-- Page content -->
      <div class="content">
        ..
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <hr class="my-3">
          <ul class="nav flex-column mb-auto">
              <li class="nav-item dropdown">
                  <button class="nav-link d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                      <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
                      Settings
                  </button>
                  <ul class="dropdown-menu dropdown-menu-link">
                      <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fi fi-rr-user"></i>Profile</a></li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="/logout">
                      <svg class="bi"><use xlink:href="#door-closed"/></svg>
                      <form action="/logout" method="post">
                          @csrf
                          <button type="submit" class="dropdown-item"> Logout</button>
                      </form>
                  </a>
              </li>
          </ul>
      </div>
  </div>
</div>
