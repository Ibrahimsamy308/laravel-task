@extends('admin.components.form')
@section('form_action', route('materials.update', $material->id))
@section('form_type', 'POST')
@section('fields_content')
    @method('put')
    <div class="page-body">

        <!-- New material Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">

                    @include('admin.components.alert-error')

                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.edit') }} {{ __('general.materials') }}</h5>
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
                                                            value="{{ old($locale . '.title', $material->translate($locale)->title) }}">
                                                    </div>
                                                </div>


                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Image Input --}}
                                    <div class="row">

                                        <div class="mb-4 row align-items-center"> <label
                                            class="col-sm-3 col-form-label form-label-title">{{ __('general.lessons') }}</label>
                                        <div class="col-sm-9"> <select class="js-example-basic-single w-100" name="lesson_id"
                                                id="lesson">
                                                <option value="">{{ __('general.select') }}</option>
                                                @foreach ($lessons as $lesson)
                                                    <option value="{{ $lesson->id }}"
                                                        {{ old('lesson_id',$material->lesson_id) == $lesson->id ? 'selected' : '' }}>
                                                        {{ $lesson->title }} </option>
                                                @endforeach
                                            </select> </div>
                                    </div>

                                        <div class="col-md-6">
                                            @include('admin.components.materials', [
                                                'label' => __('general.materials'),
                                                'value' => old('materials',$material->materials_urls),
                                                'name' => 'materials[]',
                                                'id' => 'kt_materials_1',
                                                'accept' => '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif',
                                                'required' => false,
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
        <!-- New material Add End -->
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
