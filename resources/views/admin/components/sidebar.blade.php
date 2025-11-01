<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{route('dashboard')}}" data-bs-original-title="" title="">
                <img class="img-fluid for-white logo-circle" src="{{asset(settings()->logo)}}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{route('dashboard')}}">
                <img class="img-fluid main-logo main-white" src="{{asset(settings()->logo)}}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{asset(settings()->logo)}}" alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    {{-- Dashboard --}}
                    <li class="sidebar-list mt-4">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('dashboard')}}">
                            <i class="ri-home-line"></i>
                            <span>{{__('general.dashboard')}}</span>
                        </a>
                    </li>

                    {{-- Admins --}}
                    @canany(['admin-list','admin-create'])
                        <li class="sidebar-list">
                            <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>{{__('general.admins')}}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('admin-list')
                                    <li><a href="{{route('admins.index')}}">{{__('general.list')}}</a></li>
                                @endcan
                                @can('admin-create')
                                    <li><a href="{{route('admins.create')}}">{{__('general.create')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- Roles --}}
                    @canany(['role-list','role-create'])
                        <li class="sidebar-list">
                            <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>{{__('general.roles')}}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('role-list')
                                    <li><a href="{{route('roles.index')}}">{{__('general.list')}}</a></li>
                                @endcan
                                @can('role-create')
                                    <li><a href="{{route('roles.create')}}">{{__('general.create')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- Users --}}
                    @canany(['user-list','user-create'])
                        <li class="sidebar-list">
                            <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>{{__('general.users')}}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('user-list')
                                    <li><a href="{{route('users.index')}}">{{__('general.list')}}</a></li>
                                @endcan
                                @can('user-create')
                                    <li><a href="{{route('users.create')}}">{{__('general.create')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>

