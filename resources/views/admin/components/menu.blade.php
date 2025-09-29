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