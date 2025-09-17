@extends('admin.components.form')
@section('form_action', route('users.store'))
@section('form_type', 'POST')
@section('fields_content')

    <div class="page-body">

        <!-- New user Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">

                    @include('admin.components.alert-error')

                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.create') }} {{ __('general.users') }}</h5>
                                    </div>
                                    <!-- Normal title input --> 
                                    <div class="mb-4 row align-items-center"> <label
                                            class="form-label-title col-sm-3 mb-0">{{ __('general.fullname') }} <span
                                                class="text-danger"> * </span></label>
                                        <div class="col-sm-9"> <input type="text" name="fullname"
                                                placeholder="{{ __('general.fullname') }}"
                                                class="form-control @error('fullname') is-invalid @enderror"
                                                value="{{ old('fullname') }}"> </div>
                                    </div>
                                    <!-- Normal title input --> 
                                     <div class="mb-4 row align-items-center"> <label class="form-label-title col-sm-3 mb-0">{{ __('general.email') }} <span class="text-danger"> * </span></label> <div class="col-sm-9"> <input type="email" placeholder="{{ __('general.email') }}" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email"> </div> </div>

                                    <div class="mb-4 row align-items-center"> <label
                                            class="form-label-title col-sm-3 mb-0">{{ __('general.phone') }} <span
                                                class="text-danger"> * </span></label>
                                        <div class="col-sm-9"> <input type="string" placeholder="{{ __('general.phone') }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone') }}" name="phone"> </div>
                                    </div>


                                      <!-- Normal title input -->
                                    <div class="mb-4 row align-items-center"> 
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.password') }} <span
                                            class="text-danger"> * </span></label>
                                        <div class="col-sm-9"> <input type="password" placeholder="{{ __('general.password') }}"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}" name="password"> 
                                        </div>
                                    </div>

                                    <!-- Normal title input -->
                                    <div class="mb-4 row align-items-center"> 
                                        <label class="form-label-title col-sm-3 mb-0">{{ __('general.confirm-password') }} <span
                                            class="text-danger"> * </span></label>
                                        <div class="col-sm-9"> <input type="password" placeholder="{{ __('general.confirm-password') }}"
                                                class="form-control @error('confirm-password') is-invalid @enderror"
                                                value="{{ old('confirm-password') }}" name="confirm-password"> 
                                        </div>
                                    </div>
                                        <div class="col-md-6"> @include('admin.components.image', [
                                            'label' => __('general.image'),
                                            'value' => old('image'),
                                            'name' => 'image',
                                            'id' => 'kt_image_3',
                                            'accept' => 'image/*',
                                            'required' => true,
                                        ]) </div>

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
        <!-- New user Add End -->
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
