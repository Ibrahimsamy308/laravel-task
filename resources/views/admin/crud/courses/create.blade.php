@extends('admin.components.form')
@section('form_action', route('courses.store'))
@section('form_type', 'POST')
@section('fields_content')

<div class="page-body">
    <div class="container-fluid">
        <div class="row theme-form">
            <div class="col-12">
                @include('admin.components.alert-error')

                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>{{ __('general.create') }} {{ __('general.courses') }}</h5>
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
                                                    @lang('general.title') - @lang('general.' . $locale)
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="{{ $locale . '[title]' }}"
                                                        placeholder="@lang('general.title')"
                                                        class="form-control @error($locale.'.title') is-invalid @enderror"
                                                        value="{{ old($locale.'.title') }}">
                                                    @error($locale.'.title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    @lang('general.description') - @lang('general.' . $locale)
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <textarea name="{{ $locale . '[description]' }}"
                                                        class="form-control summernote @error($locale.'.description') is-invalid @enderror">{{ old($locale.'.description') }}</textarea>
                                                    @error($locale.'.description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <!-- Price -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.price') }} *</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.01" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}">
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Discount -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.discount') }}</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.01" name="discount"
                                                class="form-control @error('discount') is-invalid @enderror"
                                                value="{{ old('discount') }}">
                                            @error('discount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Start Date -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Start Date *</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="start_date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">End Date *</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="end_date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Duration Hours -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Duration (Hours) *</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="duration_hours"
                                                class="form-control @error('duration_hours') is-invalid @enderror"
                                                value="{{ old('duration_hours') }}">
                                            @error('duration_hours')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Level -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Level *</label>
                                        <div class="col-sm-9">
                                            <select name="level" class="form-control @error('level') is-invalid @enderror">
                                                <option value="beginner" {{ old('level')=='beginner' ? 'selected' : '' }}>Beginner</option>
                                                <option value="intermediate" {{ old('level')=='intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                <option value="advanced" {{ old('level')=='advanced' ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Active Checkbox -->
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Active</label>
                                        <div class="col-sm-9">
                                            <input type="checkbox" name="active" value="1"
                                                {{ old('active') ? 'checked' : '' }}>
                                            @error('active')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @include('admin.components.video', [
                                            'label' => __('general.introVideo'),
                                            'value' => old('introvideo'),
                                            'name' => 'introvideo',
                                            'id' => 'kt_video_1',
                                            'accept' => 'video/*',
                                            'required' => true,
                                        ])
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-submit-button">
                            <button class="btn btn-animation ms-auto" type="submit">{{__('general.submit')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function() {
        // Summernote
        $('.summernote').summernote()

        // CodeMirror
        if(document.getElementById("codeMirrorDemo")){
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        }
    })
</script>
@endpush
