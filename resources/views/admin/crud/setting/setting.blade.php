@extends('admin.components.form')
@section('form_action', route('setting', $setting->id))
@section('form_type', 'POST')
@section('fields_content')
    @method('put')
    <div class="page-body">

        <!-- New setting Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                    @include('admin.components.alert-error')
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.edit') }} {{ __('general.settings') }}</h5>
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
                                                            value="{{ old($locale . '.title', $setting->translate($locale)->title) }}">
                                                    </div>
                                                </div>

                                                <!-- Normal title input -->
                                                <div class="mb-4 row align-items-center"> <label
                                                        class="form-label-title col-sm-3 mb-0">{{ __('general.description') }}
                                                        - @lang('general.' . $locale)<span class="text-danger"> * </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea rows="10" class="summernote @error($locale . '.description') is-invalid @enderror"
                                                            name="{{ $locale . '[description]' }}"> {!! old($locale . '.description', $setting->translate($locale)->description) !!} </textarea>
                                                    </div>
                                                </div>

                                                <!-- Normal title input -->
                                                <div class="mb-4 row align-items-center"> <label
                                                        class="form-label-title col-sm-3 mb-0">{{ __('general.appointment') }}
                                                        - @lang('general.' . $locale)<span class="text-danger"> * </span></label>
                                                    <div class="col-sm-9"> <input type="text"
                                                            name="{{ $locale . '[appointment]' }}"
                                                            placeholder="{{ __('general.appointment') }}"
                                                            class="form-control @error('appointment') invalid @enderror @error($locale . '.appointment') is-invalid @enderror"
                                                            value="{{ old($locale . '.appointment', $setting->translate($locale)->appointment) }}">
                                                    </div>
                                                </div>

                                                <!-- Normal title input -->
                                                <div class="mb-4 row align-items-center"> <label
                                                        class="form-label-title col-sm-3 mb-0">{{ __('general.copyright') }}
                                                        - @lang('general.' . $locale)<span class="text-danger"> * </span></label>
                                                    <div class="col-sm-9"> <input type="text"
                                                            name="{{ $locale . '[copyright]' }}"
                                                            placeholder="{{ __('general.copyright') }}"
                                                            class="form-control @error('copyright') invalid @enderror @error($locale . '.copyright') is-invalid @enderror"
                                                            value="{{ old($locale . '.copyright', $setting->translate($locale)->copyright) }}">
                                                    </div>
                                                </div>


                                                <!-- Normal title input -->
                                                <div class="mb-4 row align-items-center"> <label
                                                    class="form-label-title col-sm-3 mb-0">{{ __('general.address') }}
                                                    <span class="text-danger"> * </span></label>
                                                <div class="col-sm-9"> <input type="text" name="address"
                                                        placeholder="{{ __('general.address') }}"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        value="{{ old('address', $setting->address) }}"> </div>
                                            </div>
                                            

                                                <!-- Normal title input -->
                                                <div class="mb-4 row align-items-center"> <label
                                                        class="form-label-title col-sm-3 mb-0">{{ __('general.meta_data') }}
                                                        - @lang('general.' . $locale)<span class="text-danger"> * </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea rows="10" class="summernote @error($locale . '.meta_data') is-invalid @enderror"
                                                            name="{{ $locale . '[meta_data]' }}"> {!! old($locale . '.meta_data', $setting->translate($locale)->meta_data) !!} </textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>

                                <div class="row">
                                        <!-- Normal title input -->
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label class="form-label-title mb-0">
                                                    {{ __('general.map') }} <span class="text-danger"> * </span>
                                                </label>
                                                <textarea rows="10" class="form-control @error('map') is-invalid @enderror" name="map">{!! old('map', $setting->map) !!}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            @include('admin.components.image', [
                                            'label' => __('general.logo'),
                                            'value' => old('logo', $setting->logo),
                                            'name' => 'logo',
                                            'id' => 'kt_image_1',
                                            'accept' => 'image/*',
                                            'required' => true,
                                            ]) 
                                        </div>


                                        <div class="col-md-6">
                                            @include('admin.components.image', [
                                            'label' => __('general.white_logo'),
                                            'value' => old('white_logo', $setting->white_logo),
                                            'name' => 'white_logo',
                                            'id' => 'kt_image_2',
                                            'accept' => 'image/*',
                                            'required' => true,
                                            ]) 
                                        </div>


                                        <div class="col-md-6"> 
                                            @include('admin.components.image', [
                                                'label' => __('general.tab'),
                                                'value' => old('tab', $setting->tab),
                                                'name' => 'tab',
                                                'id' => 'kt_image_3',
                                                'accept' => 'image/*',
                                                'required' => true,
                                            ]) 
                                        </div>


                                        <div class="col-md-6"> 
                                            @include('admin.components.image', [
                                            'label' => __('general.loginImage'),
                                            'value' => old('image', $setting->loginImage),
                                            'name' => 'image',
                                            'id' => 'kt_image_4',
                                            'accept' => 'image/*',
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
        <!-- New setting Add End -->
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
