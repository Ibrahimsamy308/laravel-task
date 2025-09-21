@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row theme-form">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>{{ __('general.show') }} {{ __('general.courses') }}</h5>
                                </div>

                                {{-- Tabs for locales --}}
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

                                            <!-- Title -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.title') }}
                                                </label>
                                                <div class="col-sm-9">
                                                    <p class="bg-show p-2 mt-2">
                                                        {{ $course->translate($locale)->title ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.description') }}
                                                </label>
                                                <div class="col-sm-9">
                                                    <div class="bg-show p-2 mt-2">
                                                        {!! $course->translate($locale)->description ?? '-' !!}
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- curriculum -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.curriculum') }}
                                                </label>
                                                <div class="col-sm-9">
                                                    <div class="bg-show p-2 mt-2">
                                                        {!! $course->translate($locale)->curriculum ?? '-' !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <!-- Price -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.price') }}</label>
                                            <div class="col-sm-9">
                                                <p class="bg-show p-2 mt-2">{{ $course->price }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Discount -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.discount') }}</label>
                                            <div class="col-sm-9">
                                                <p class="bg-show p-2 mt-2">{{ $course->discount ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Active -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.active') }}</label>
                                            <div class="col-sm-9">
                                                @if($course->active)
                                                    <span class="badge bg-success">{{ __('general.active') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('general.inactive') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Level -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.level') }}</label>
                                            <div class="col-sm-9">
                                                <p class="bg-show p-2 mt-2">{{ ucfirst($course->level) ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Level -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.language') }}</label>
                                            <div class="col-sm-9">
                                                <p class="bg-show p-2 mt-2">{{ __('general.'.$course->language) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Start Date -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.start_date') }}</label>
                                            <div class="col-sm-9">
                                                <p class="bg-show p-2 mt-2">{{ $course->start_date ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- End Date -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.end_date') }}</label>
                                            <div class="col-sm-9">
                                                <p class="bg-show p-2 mt-2">{{ $course->end_date ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Duration Hours -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.duration_hours') }}</label>
                                            <div class="col-sm-9">
                                                <p class="bg-show p-2 mt-2">{{ $course->duration_hours ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <!-- Intro Video -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.introVideo') }}</label>
                                            <div class="col-sm-9">
                                                @if ($course->Video)
                                                    <video width="320" height="240" controls class="mt-2">
                                                        <source src="{{ asset($course->Video) }}" type="video/mp4">
                                                    </video>
                                                @else
                                                    <p class="bg-show p-2 mt-2">-</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div> <!-- row end -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
