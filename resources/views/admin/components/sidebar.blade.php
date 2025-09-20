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
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
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

                    {{-- Videos --}}
                    @canany(['video-list','video-create'])
                        <li class="sidebar-list">
                            <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>{{__('general.videos')}}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('video-list')
                                    <li><a href="{{route('videos.index')}}">{{__('general.list')}}</a></li>
                                @endcan
                                @can('video-create')
                                    <li><a href="{{route('videos.create')}}">{{__('general.create')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- Exams --}}
                    @canany(['exam-list','exam-create'])
                        <li class="sidebar-list">
                            <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>{{__('general.exams')}}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('exam-list')
                                    <li><a href="{{route('exams.index')}}">{{__('general.list')}}</a></li>
                                @endcan
                                @can('exam-create')
                                    <li><a href="{{route('exams.create')}}">{{__('general.create')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                     @canany(['lesson-list','lesson-create'])
                        <li class="sidebar-list">
                            <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>{{__('general.lessons')}}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('lesson-list')
                                    <li><a href="{{route('lessons.index')}}">{{__('general.list')}}</a></li>
                                @endcan
                                @can('lesson-create')
                                    <li><a href="{{route('lessons.create')}}">{{__('general.create')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- Courses --}}
                    @canany(['course-list','course-create'])
                        <li class="sidebar-list">
                            <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>{{__('general.courses')}}</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('course-list')
                                    <li><a href="{{route('courses.index')}}">{{__('general.list')}}</a></li>
                                @endcan
                                @can('course-create')
                                    <li><a href="{{route('courses.create')}}">{{__('general.create')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- Materials --}}
                    @canany(['material-list','material-create'])
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-user-3-line"></i>
                            <span>{{__('general.materials')}}</span>
                        </a>
                        <ul class="sidebar-submenu">
                            @can('material-list')
                                <li><a href="{{route('materials.index')}}">{{__('general.list')}}</a></li>
                            @endcan
                            @can('material-create')
                                <li><a href="{{route('materials.create')}}">{{__('general.create')}}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    {{-- Categories --}}
                    @canany(['category-list','category-create'])
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>{{__('general.catgeories')}}</span>
                        </a>
                        <ul class="sidebar-submenu">
                            @can('category-list')
                                <li><a href="{{route('categories.index')}}">{{__('general.list')}}</a></li>
                            @endcan
                            @can('category-create')
                                <li><a href="{{route('categories.create')}}">{{__('general.create')}}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    {{-- Contacts --}}
                    @canany(['contact-list','contact-create'])
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>{{__('general.contacts')}}</span>
                        </a>
                        <ul class="sidebar-submenu">
                            @can('contact-list')
                                <li><a href="{{route('contacts.index')}}">{{__('general.list')}}</a></li>
                            @endcan
                            @can('contact-create')
                                <li><a href="{{route('contacts.create')}}">{{__('general.create')}}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    {{-- Messages --}}
                    @canany(['message-list','message-reply'])
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>{{__('general.messages')}}</span>
                        </a>
                        <ul class="sidebar-submenu">
                            @can('message-list')
                                <li><a href="{{route('messages.index')}}">{{__('general.list')}}</a></li>
                            @endcan
                            @can('message-reply')
                                <li><a href="{{route('messages.create')}}">{{__('general.create')}}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    {{-- Newsletters --}}
                    @canany(['newsletter-list','newsletter-reply'])
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>{{__('general.newsletters')}}</span>
                        </a>
                        <ul class="sidebar-submenu">
                            @can('newsletter-list')
                                <li><a href="{{route('newsletters.index')}}">{{__('general.list')}}</a></li>
                            @endcan
                            @can('newsletter-reply')
                               <li><a href="{{route('newsletters.create')}}">{{__('general.create')}}</a></li>
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

