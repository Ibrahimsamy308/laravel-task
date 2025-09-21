@extends('admin.layouts.master')

@section('content')
    <div class="page-body">

        <!-- Lesson Show Start -->
        <div class="container-fluid">
            <div class="row theme-form ">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.show') }} {{ __('general.lesson') }}</h5>
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
                                                    <div class="col-sm-12">
                                                        <label class="form-label-title mb-0">{{ __('general.title') }}</label>
                                                        <p class="bg-show p-2 mt-2">
                                                            {{ $lesson->translate($locale)->title ?? '-' }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-12">
                                                        <label class="form-label-title mb-0">{{ __('general.description') }}</label>
                                                        <p class="bg-show p-2 mt-2">
                                                            {!! $lesson->translate($locale)->description ?? '-' !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Course -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12">
                                            <label class="form-label-title mb-0">{{ __('general.course') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $lesson->course->title ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <!-- Duration -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12">
                                            <label class="form-label-title mb-0">{{ __('general.duration') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $lesson->duration ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <!-- Order -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12">
                                            <label class="form-label-title mb-0">{{ __('general.order') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $lesson->lessonOrder }}</p>
                                        </div>
                                    </div>

                                    <!-- Is Free -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12">
                                            <label class="form-label-title mb-0">{{ __('general.is_free') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{ $lesson->is_free ? __('general.yes') : __('general.no') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Created At -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12">
                                            <label class="form-label-title mb-0">{{ __('general.created_at') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $lesson->created_at }}</p>
                                        </div>
                                    </div>

                                     <div class="col-12">
                                        <!-- Intro Video -->
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">{{ __('general.introVideo') }}</label>
                                            <div class="col-sm-9">
                                                @if ($lesson->Video)
                                                    <video width="320" height="240" controls class="mt-2">
                                                        <source src="{{ asset($lesson->Video) }}" type="video/mp4">
                                                    </video>
                                                @else
                                                    <p class="bg-show p-2 mt-2">-</p>
                                                @endif
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
        <!-- Lesson Show End -->
    </div>
@endsection
