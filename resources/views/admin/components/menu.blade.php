<!-- Page Header Start-->
<div class="page-header">
    <div class="header-wrapper m-0">
        <div class="header-logo-wrapper p-0">
            <div class="logo-wrapper">
                <a href="{{route('dashboard')}}">
                    <img class="img-fluid main-logo" src="{{asset(settings()->logo)}}" alt="logo">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                {{-- <a href="{{route('dashboard')}}">
                    <img src="{{asset(settings()->logo)}}" class="img-fluid" alt="">
                </a> --}}
            </div>
        </div>

        <form class="form-inline search-full" action="javascript:void(0)" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="{{__("general.search")}} .." name="q" title="" autofocus>
                        <i class="close-search" data-feather="x"></i>
                        <div class="spinner-border Typeahead-spinner" role="status">
                            <span class="sr-only">{{__("general.loading")}}...</span>
                        </div>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="{{ app()->getLocale() == $localeCode ? 'd-none' : '' }}">
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <img src="{{ asset('flags/' . $localeCode . '.png') }}" class="flag" alt="KSA Flag">
                    </a>
                </li>
            @endforeach

            <!-- Add the button here -->
            <li>
                <a href="https://yousab-tech.com/webapp/public/test-image" class="btn btn-sm btn-primary" style="margin-left: 10px;">
                    Compress Images
                </a>
            </li>
                <li>
                    <span class="header-search">
                        <i class="ri-search-line"></i>
                    </span>
                </li>
                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <i class="ri-notification-line"></i>
                        <span class="badge rounded-pill badge-theme">4</span>
                    </div>
                    <ul class="notification-dropdown onhover-show-div">
                        <li>
                            <i class="ri-notification-line"></i>
                            <h6 class="f-18 mb-0">{{ __('general.Notifications') }}</h6>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-primary"></i>{{ __('general.DeliveryProcessing') }} 
                                <span class="pull-right">10 min.</span>
                            </p>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-success"></i>{{ __('general.OrderComplete') }} 
                                <span class="pull-right">1 hr</span>
                            </p>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-info"></i>{{ __('general.TicketsGenerated') }} 
                                <span class="pull-right">3 hr</span>
                            </p>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-danger"></i>{{ __('general.DeliveryComplete') }} 
                                <span class="pull-right">6 hr</span>
                            </p>
                        </li>
                        <li>
                            <a class="btn btn-primary" href="javascript:void(0)">{{ __('general.CheckAllNotifications') }}</a>
                        </li>
                    </ul>
                    
                </li>

                <li>
                    <div class="mode" id="darkModeToggle" style="cursor: pointer;">
                        <i class="ri-moon-line"></i>
                    </div>
                </li>

                <li class="profile-nav onhover-dropdown pe-0 me-0">
                    <div class="media profile-media">
                        <img class="user-profile rounded-circle" src="{{auth()->user()->image}}" alt="">
                        <div class="user-name-hide media-body">
                            <span>{{auth('admin')->user()->name}}</span>
                            <p class="mb-0 font-roboto">{{auth('admin')->user()->type}}<i class="middle ri-arrow-down-s-line"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{route('edit.profile')}}">
                                <i data-feather="users"></i>
                                <span>{{ __('general.profile') }}</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="order-list.html">
                                <i data-feather="archive"></i>
                                <span>{{ __('general.Orders') }}</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="support-ticket.html">
                                <i data-feather="phone"></i>
                                <span>{{ __('general.SupportTickets') }}</span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('edit.setting') }}">
                                <i data-feather="settings"></i>
                                <span>{{ __('general.Settings') }}</span>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                                    <i data-feather="log-out"></i>
                                    <span>{{ __('general.LogOut') }}</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                    
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends-->