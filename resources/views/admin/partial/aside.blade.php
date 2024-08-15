@php
  $menusAccess = App\Models\UserMenuAccess::where('user_id', Auth::id())
      ->where('status', 1)
      ->join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')
      ->join('menus', 'sub_menus.menu_id', '=', 'menus.id')
      ->distinct('menus.id')
      ->select(['menus.id', 'menus.menu', 'menus.has_submenu', 'menus.icon', 'menus.sortIds'])
      ->orderBy('menus.sortIds')
      ->get();
  //  dd($menusAccess);
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  {{-- <a href="index3.html" class="brand-link" style="display: block"> --}}
  <a href="{{ route('admin.dashboard') }}" class="brand-link" style="display: block">
    <img src="{{ asset('site/images/title-white.png') }}" style="float: none;max-height: 65px;" alt="AdminLTE Logo" class="brand-image "
         style="opacity: .8">
    {{-- <span class="brand-text font-weight-light">Logon Broadband</span> --}}
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        {{-- <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> --}}

        @if (Auth::user()->image == null)
          <i class="fas fa-user img-circle elevation-2"></i>
        @else
          <img src="{{ asset('admin/dist/img/' . Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
        @endif

      </div>
      <div class="info">
        <a class="d-block">{{ Auth::user()->name }} ({{ Auth::user()->role }})</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="{{ route('home') }}" target="_blank" class="nav-link">
            <i @if (Request::route()->getName() == 'home') class="nav-icon fa fa-globe text-success" @else class="nav-icon fa fa-globe" @endif></i>
            <p @if (Request::route()->getName() == 'home') class="text-primary" @endif>
              Preview Website
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @foreach ($menusAccess as $key => $values)
          @php
            $Submenus = App\Models\UserMenuAccess::where('user_id', Auth::id())
                ->where('status', 1)
                ->where('sub_menus.menu_id', $values->id)
                ->join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')
                ->get();
          @endphp
          @if ($values->has_submenu == 0)
            <li class="nav-item">
              <a href="{{ route($Submenus->first()->route_name) }}" class="nav-link">
                <i class="nav-icon {{ $values->icon == '' ? 'fa fa-bars' : $values->icon }}"></i>
                <p>
                  {{ $Submenus->first()->submenu }}
                </p>
              </a>
            </li>
          @else
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon {{ $values->icon == '' ? 'fa fa-bars' : $values->icon }}"></i>
                <p>
                  {{ $values->menu }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @foreach ($Submenus as $submenu)
                  <li class="nav-item">
                    <a href="{{ route($submenu->route_name) }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{ $submenu->submenu }}</p>
                    </a>
                  </li>
                @endforeach

              </ul>
            </li>
          @endif
        @endforeach
        @if (Auth::user()->role == 'admin')
          <li class="nav-item has-treeview">
            <a href="{{ route('employee.index') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Employee
                {{-- <i class="fas fa-angle-left right"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('employee.create') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Add Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee.index') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>View Employee</p>
                </a>
              </li>

            </ul> --}}
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('menus.index') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Admin Menus
                {{-- <i class="fas fa-angle-left right"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('menus.create') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Add Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('menus.index') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>View Menus</p>
                </a>
              </li>
            </ul> --}}
          </li>
        @endif

        <li class="nav-item mx-2 mt-auto">
          <a class="nav-link" style="cursor:pointer;" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
             role="button">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <p>Logout</p>
          </a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
