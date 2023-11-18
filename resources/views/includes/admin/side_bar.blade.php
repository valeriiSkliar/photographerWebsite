<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index.page') }}" class="brand-link">
        <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="text-brand" style="font-size: 0.9rem">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-between">
            <div class="image">
                <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <div class="ml-1 btn-group" role="group">
                    <p> {{ auth()->user()->name }} </p>
                </div>
                {{--                <a href="#" class="d-block">{{ auth()->user()->name }}</a>--}}
            </div>
            <form
                method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="btn-sm btn-danger"
                    type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Contact Info
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('gallery.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
                @can('superAdminAccess', auth()->user())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Pages
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.page.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All pages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.page.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create new page</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
