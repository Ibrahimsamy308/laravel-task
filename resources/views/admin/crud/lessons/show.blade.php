@extends('admin.layouts.master')

@section('content')
    <div class="page-body">

        <!-- New Product Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.show') }} {{ __('general.products') }}</h5>
                                    </div>
                                    <ul class="nav nav-pills mb-3 d-flex" id="pills-tab" role="tablist">
                                        @foreach (config('translatable.locales') as $key => $locale)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link @if ($key == 0) active @endif"
                                                    id="pills-{{ $locale }}-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-{{ $locale }}"
                                                    type="button">@lang('general.' . $locale)</button>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        @foreach (config('translatable.locales') as $key => $locale)
                                            <div class="tab-pane fade show @if ($key == 0) active @endif"
                                                id="pills-{{ $locale }}" role="tabpanel">
                                                <!-- normal input -->
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-6"> <label
                                                            class="form-label-title mb-0">{{ __('general.title') }}</label>
                                                        <p class="bg-show p-2 mt-2">
                                                            {{ $category->translate($locale)->title }}</p>
                                                    </div>
                                                </div>

                                                <!-- normal input -->
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-6"> <label
                                                            class="form-label-title mb-0">{{ __('general.subtitle') }}</label>
                                                        <p class="bg-show p-2 mt-2">
                                                            {{ $category->translate($locale)->subtitle }}</p>
                                                    </div>
                                                </div>

                                                <!-- normal input -->
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-6"> <label
                                                            class="form-label-title mb-0">{{ __('general.description') }}</label>
                                                        {!! $category->translate($locale)->description !!} </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- normal input -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6"> <label
                                                class="form-label-title mb-0">{{ __('general.icon') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $category->icon }}</p>
                                        </div>
                                    </div>
                                    <!-- normal input -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6"> <label
                                                class="form-label-title mb-0">{{ __('general.created_at') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $category->created_at }}</p>
                                        </div>
                                    </div>

                                    <!-- normal input -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6"> <label
                                                class="form-label-title mb-0">{{ __('general.updated_at') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $category->updated_at }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Product Add End -->
    </div>
@endsection
