@extends('admin.components.form')
@section('form_action', route('videos.update', $video->id))
@section('form_type', 'POST')
@section('fields_content')
    @method('put')
    <div class="page-body">

        <!-- New video Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">

                    @include('admin.components.alert-error')

                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.edit') }} {{ __('general.videos') }}</h5>
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
                                                <!-- Normal title input -->
                                                <div class="mb-4 row align-items-center"> <label
                                                        class="form-label-title col-sm-3 mb-0">{{ __('general.title') }} -
                                                        @lang('general.' . $locale)<span class="text-danger"> * </span></label>
                                                    <div class="col-sm-9"> <input type="text"
                                                            name="{{ $locale . '[title]' }}"
                                                            placeholder="{{ __('general.title') }}"
                                                            class="form-control @error('title') invalid @enderror @error($locale . '.title') is-invalid @enderror"
                                                            value="{{ old($locale . '.title', $video->translate($locale)->title) }}">
                                                    </div>
                                                </div>


                                                <div class="mb-4 row align-items-center"> <label
                                                    class="form-label-title col-sm-3 mb-0">{{ __('general.description') }}
                                                    - @lang('general.' . $locale)<span class="text-danger"> * </span></label>
                                                <div class="col-sm-9">
                                                    <textarea rows="100" class="summernote @error($locale . '.description') is-invalid @enderror"
                                                        name="{{ $locale . '[description]' }}"> {!! old($locale . '.description', $video->translate($locale)->description) !!} </textarea>
                                                </div>
                                            </div>


                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Image Input --}}
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">{{ __('general.lessons') }}</label>
                                            <div class="col-sm-9">
                                                <select class="js-example-basic-single w-100" name="lesson_id" id="lesson">
                                                    <option value="">{{ __('general.select') }}</option>
                                                    @foreach ($lessons as $lesson)
                                                        <option value="{{ $lesson->id }}"
                                                            {{ old('lesson_id', $video->lesson_id ?? null) == $lesson->id ? 'selected' : '' }}>
                                                            {{ $lesson->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.duration') }} <span class="text-danger"> * </span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" 
                                                        placeholder="{{ __('general.duration') }}"
                                                        class="form-control @error('duration') is-invalid @enderror"
                                                        value="{{ old('duration', $video->duration ?? '') }}" 
                                                        name="duration">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.is_active') }}
                                                </label>
                                                <div class="col-sm-9">
                                                    <!-- hidden input to force 0 if unchecked -->
                                                    <input type="hidden" name="is_active" value="0">
                                        
                                                    <input type="checkbox"
                                                        class="form-check-input"
                                                        id="is_active"
                                                        name="is_active"
                                                        value="1"
                                                        {{ old('is_active', $video->is_active ?? 0) ? 'checked' : '' }}>
                                                    <label for="is_active" class="form-check-label">
                                                        {{ __('general.active') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6">
                                            @include('admin.components.video', [
                                                'label' => __('general.video'),
                                                'value' => old('video',$video->video),
                                                'name' => 'video',
                                                'id' => 'kt_video_1',
                                                'accept' => 'video/*',
                                                'required' => true,
                                            ])
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
        <!-- New video Add End -->
    </div>

@endsection


@push('scripts')
    <script>
        $(function() {
            // Summernote
            $('.summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
@endpush
