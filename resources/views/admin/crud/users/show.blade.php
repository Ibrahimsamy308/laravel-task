@extends('admin.layouts.master')

@section('content')
    <div class="page-body">

        <!-- New user Add Start -->
        <div class="container-fluid">
            <div class="row theme-form ">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.show') }} {{ __('general.users') }}</h5>
                                    </div>
                                    <!-- normal input -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6"> <label
                                                class="form-label-title mb-0">{{ __('general.name') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $user->fullname }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-5 bg-light p-3 rounded h-100">
                                            <div class="card-title fw-bold">
                                                <h5 class="font-weight-bolder text-dark">{{ __('general.email') }}: </h5> <a
                                                    href="mailto:{{ $user->email }}"
                                                    style="margin: 0; color: inherit; font-weight: normal;">{{ $user->email }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- normal input -->
                                    
                                    <div class="mb-4  align-items-center">
                                            <label
                                                class="form-label-title mb-0">{{ __('general.phone') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $user->phone }}</p>
                                    </div>

                                    <!-- normal input -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6"> <label
                                                class="form-label-title mb-0">{{ __('general.image') }}</label> <img
                                                class="bg-show p-2 mt-2" width="300" height="300"
                                                src="{{ $user->image }}" alt=""> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New user Add End -->
    </div>
@endsection
