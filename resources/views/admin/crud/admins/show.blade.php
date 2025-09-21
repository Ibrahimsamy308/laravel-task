@extends('admin.layouts.master')

@section('content')
    <div class="page-body">

        <!-- New admin Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <!-- normal input -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4  align-items-center">
                                            <label
                                                class="form-label-title mb-0">{{ __('general.name') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $admin->name }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-5 bg-light p-3 rounded h-100">
                                            <div class="card-title fw-bold">
                                                <h5 class="font-weight-bolder text-dark">{{ __('general.email') }}: </h5> <a
                                                    href="mailto:{{ $admin->email }}"
                                                    class="bg-show mt-2" >{{ $admin->email }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-4  align-items-center">
                                            <label
                                                class="form-label-title mb-0">{{ __('general.phone') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $admin->phone }}</p>
                                        </div>
                                        <div class="col-sm-12"> 
                                            <label
                                                class="form-label-title mb-0">{{ __('general.image :') }}
                                            </label> 
                                            <img
                                                class="bg-show p-2 mt-2" width="300" height="200"
                                                src="{{ $admin->image }}" alt=""> 
                                        </div>

                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New admin Add End -->
    </div>
@endsection
