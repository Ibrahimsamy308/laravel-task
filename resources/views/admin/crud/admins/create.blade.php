@extends('admin.components.form')
@section('form_action', route('admins.store'))
@section('form_type', 'POST')
@section('fields_content')

    <div class="page-body">

        <!-- New admin Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">

                    @include('admin.components.alert-error')

                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __(key: 'general.create') }} {{ __('general.admins') }}</h5>
                                    </div>

                                    <!-- Normal title input -->
                                    <div class="mb-4 row align-items-center"> <label
                                            class="form-label-title col-sm-3 mb-0">{{ __('general.name') }} <span
                                                class="text-danger"> * </span></label>
                                        <div class="col-sm-9"> <input type="text" name="name"
                                                placeholder="{{ __('general.name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}"> </div>
                                    </div>

                                    <!-- Normal title input -->
                                    <div class="mb-4 row align-items-center"> <label
                                            class="form-label-title col-sm-3 mb-0">{{ __('general.email') }} <span
                                                class="text-danger"> * </span></label>
                                        <div class="col-sm-9"> <input type="email" placeholder="{{ __('general.email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" name="email"> </div>
                                    </div>


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

                                    <div class="mb-4 row align-items-center"> <label
                                            class="col-sm-3 col-form-label form-label-title">{{ __('general.select') }}</label>
                                        <div class="col-sm-9"> <select class="js-example-basic-single w-100" name="roles"
                                                id="role">
                                                <option value="">{{ __('general.select') }}</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }} </option>
                                                @endforeach
                                            </select> </div>
                                    </div>


                                      {{-- Image Input --}} 
                                    <div class="row">
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
        <!-- New admin Add End -->
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
