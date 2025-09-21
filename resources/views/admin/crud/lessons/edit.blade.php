@extends('admin.components.form')
@section('form_action', route('lessons.update', $lesson->id))
@section('form_type', 'PUT')
@section('fields_content')

<div class="page-body">
    <!-- Edit Lesson Start -->
    <div class="container-fluid">
        <div class="row theme-form">
            <div class="col-12">

                @include('admin.components.alert-error')

                <div class="row">
                    <div class="col-sm-10 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title mb-4">
                                    <h5>{{ __('general.edit') }} {{ __('general.lesson') }}</h5>
                                </div>

                                <!-- Tabs for locales -->
                                <ul class="nav nav-pills mb-3 d-flex" id="pills-tab" role="tablist">
                                    @foreach (config('translatable.locales') as $key => $locale)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link @if ($key == 0) active @endif"
                                                id="pills-{{ $locale }}-tab"
                                                data-bs-toggle="pill"
                                                data-bs-target="#pills-{{ $locale }}"
                                                type="button">
                                                @lang('general.' . $locale)
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Translations -->
                                <div class="tab-content" id="pills-tabContent">
                                    @foreach (config('translatable.locales') as $key => $locale)
                                        <div class="tab-pane fade show @if ($key == 0) active @endif"
                                            id="pills-{{ $locale }}" role="tabpanel">

                                            <!-- Title -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.title') }} - @lang('general.' . $locale)
                                                    <span class="text-danger"> * </span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        name="{{ $locale . '[title]' }}"
                                                        placeholder="{{ __('general.title') }}"
                                                        class="form-control @error($locale . '.title') is-invalid @enderror"
                                                        value="{{ old($locale . '.title', $lesson->translate($locale)->title ?? '') }}">
                                                    @error($locale.'.title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.description') }} - @lang('general.' . $locale)
                                                    <span class="text-danger"> * </span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <textarea rows="5"
                                                        class="summernote @error($locale . '.description') is-invalid @enderror"
                                                        name="{{ $locale . '[description]' }}">{{ old($locale . '.description', $lesson->translate($locale)->description ?? '') }}</textarea>
                                                    @error($locale.'.description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <!-- Course -->
                                    <div class="col-md-6 mb-4">
                                        <label for="course_id" class="form-label-title">
                                            {{ __('general.course') }}
                                        </label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="">{{ __('general.choose_course') }}</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" 
                                                    {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Duration -->
                                    <div class="col-md-6 mb-4">
                                        <label for="duration" class="form-label-title">
                                            {{ __('general.duration') }} <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" step="0.01"
                                            placeholder="{{ __('general.duration') }}"
                                            class="form-control @error('duration') is-invalid @enderror"
                                            value="{{ old('duration', $lesson->duration) }}"
                                            name="duration">
                                        @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Order -->
                                    <div class="col-md-6 mb-4">
                                        <label for="lessonOrder" class="form-label-title">
                                            {{ __('general.order') }}
                                        </label>
                                        <input type="number"
                                            name="lessonOrder"
                                            id="lessonOrder"
                                            class="form-control"
                                            value="{{ old('lessonOrder', $lesson->lessonOrder) }}">
                                    </div>

                                    <!-- Is Free -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label-title d-block">
                                            {{ __('general.is_free') }}
                                        </label>
                                        <input type="hidden" name="is_free" value="0">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                name="is_free"
                                                value="1"
                                                class="form-check-input"
                                                id="is_free"
                                                {{ old('is_free', $lesson->is_free) ? 'checked' : '' }}>
                                            <label for="is_free" class="form-check-label">
                                                {{ __('general.free_lesson') }}
                                            </label>
                                        </div>
                                    </div>


                                     <div class="col-md-6">
                                            @include('admin.components.video', [
                                                'label' => __('general.introVideo'),
                                                'value' => old('video', $lesson->video),
                                                'name' => 'video',
                                                'id' => 'kt_video_1',
                                                'accept' => 'video/*',
                                                'required' => false,
                                            ])
                                        </div>
                                </div>

                                <div class="card-submit-button text-end">
                                    <button class="btn btn-primary" type="submit">
                                        {{ __('general.submit') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Edit Lesson End -->
</div>

@endsection

@push('scripts')
<script>
    $(function() {
        $('.summernote').summernote()
    })
</script>
@endpush
