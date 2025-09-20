@extends('admin.components.form')

@section('form_action', route('courses.update', $course->id))
@section('form_type', 'POST')

@section('fields_content')
    @method('put')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row theme-form">
                <div class="col-12">

                    @include('admin.components.alert-error')

                    <div class="row">
                        <div class="col-sm-10 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.edit') }} {{ __('general.courses') }}</h5>
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
                                                    <label class="form-label-title col-sm-3 mb-0">
                                                        {{ __('general.title') }} - @lang('general.' . $locale)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                            name="{{ $locale . '[title]' }}"
                                                            class="form-control"
                                                            value="{{ old($locale . '.title', $course->translate($locale)->title) }}">
                                                    </div>
                                                </div>

           
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">
                                                        {{ __('general.description') }} - @lang('general.' . $locale)
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <textarea name="{{ $locale . '[description]' }}" class="form-control summernote">{{ old($locale . '.description', $course->translate($locale)->description) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


               
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.price') }}</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.01" name="price"
                                                value="{{ old('price', $course->price) }}"
                                                class="form-control">
                                        </div>
                                    </div>

             
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.discount') }}</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.01" name="discount"
                                                value="{{ old('discount', $course->discount) }}"
                                                class="form-control">
                                        </div>
                                    </div>

             
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.duration_hours') }}</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="duration_hours"
                                                value="{{ old('duration_hours', $course->duration_hours) }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.level') }}</label>
                                        <div class="col-sm-9">
                                            <select name="level" class="form-control">
                                                <option value="beginner" @if(old('level', $course->level) == 'beginner') selected @endif>Beginner</option>
                                                <option value="intermediate" @if(old('level', $course->level) == 'intermediate') selected @endif>Intermediate</option>
                                                <option value="advanced" @if(old('level', $course->level) == 'advanced') selected @endif>Advanced</option>
                                            </select>
                                        </div>
                                    </div>

 
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.start_date') }}</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="start_date"
                                                value="{{ old('start_date', $course->start_date) }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.end_date') }}</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="end_date"
                                                value="{{ old('end_date', $course->end_date) }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-9 offset-sm-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="active"
                                                    id="active" value="1"
                                                    {{ old('active', $course->active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="active">
                                                    {{ __('general.active') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-md-6">
                                            @include('admin.components.video', [
                                                'label' => __('general.introVideo'),
                                                'value' => old('video', $course->video),
                                                'name' => 'video',
                                                'id' => 'kt_video_1',
                                                'accept' => 'video/*',
                                                'required' => false,
                                            ])
                                        </div>
                                    </div>

                                </div>

                                <div class="card-submit-button">
                                    <button class="btn btn-animation ms-auto" type="submit">
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
@endsection
