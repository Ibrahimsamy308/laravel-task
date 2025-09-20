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

                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-12">
                                                        <label class="form-label-title mb-0">{{ __('general.title') }}</label>
                                                        <p class="bg-show p-2 mt-2">
                                                            {{ $course->translate($locale)->title ?? '-' }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-12">
                                                        <label class="form-label-title mb-0">{{ __('general.description') }}</label>
                                                        <div class="bg-show p-2 mt-2">
                                                            {!! $course->translate($locale)->description ?? '-' !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6">
                                            <label class="form-label-title mb-0">{{ __('general.price') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $course->price }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6">
                                            <label class="form-label-title mb-0">{{ __('general.discount') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $course->discount ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6">
                                            <label class="form-label-title mb-0">{{ __('general.active') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                @if($course->active)
                                                    <span class="badge bg-success">{{ __('general.active') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('general.inactive') }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6">
                                            <label class="form-label-title mb-0">{{ __('general.start_date') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $course->start_date ?? '-' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label-title mb-0">{{ __('general.end_date') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $course->end_date ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6">
                                            <label class="form-label-title mb-0">{{ __('general.duration_hours') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ $course->duration_hours ?? '-' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label-title mb-0">{{ __('general.level') }}</label>
                                            <p class="bg-show p-2 mt-2">{{ ucfirst($course->level) ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12">
                                            <label class="form-label-title mb-0">{{ __('general.introVideo') }}</label>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
