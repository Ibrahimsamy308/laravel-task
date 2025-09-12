@extends('admin.components.form')
@section('form_action', route('categories.update', $category->id))
@section('form_type', 'POST')
@section('fields_content')
    @method('put')
    <div class="page-body">

        <!-- New category Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">

                    @include('admin.components.alert-error')

                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.edit') }} {{ __('general.categories') }}</h5>
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
                                                            value="{{ old($locale . '.title', $category->translate($locale)->title) }}">
                                                    </div>
                                                </div>


                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Image Input --}}
                                    <div class="row">
                                        {{-- <div class="col-md-6"> @include('admin.components.image', [
                                            'label' => __('general.image'),
                                            'value' => old('image', $category->image),
                                            'name' => 'image',
                                            'id' => 'kt_image_3',
                                            'accept' => 'image/*',
                                            'required' => true,
                                        ]) </div> --}}

                                        <div class="col-md-6">
                                            @include('admin.components.video', [
                                                'label' => __('general.video'),
                                                'value' => old('video',$category->video),
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
        <!-- New category Add End -->
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
