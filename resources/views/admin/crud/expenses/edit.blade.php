@extends('admin.components.form')
@section('form_action', route('expenses.update', $expense->id))
@section('form_type', 'POST')
@section('fields_content')
    @method('put')
    <div class="page-body">

        <!-- New expense Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">

                    @include('admin.components.alert-error')

                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.edit') }} {{ __('general.expenses') }}</h5>
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
                                            
                                                    <!-- Description -->
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">
                                                        @lang('general.description') - @lang('general.' . $locale)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <textarea name="{{ $locale . '[description]' }}"
                                                            class="form-control summernote @error($locale.'.description') is-invalid @enderror">{!! old($locale . '.description', $expense->translate($locale)->description) !!}</textarea>
                                                        @error($locale.'.description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>



                                    {{-- Image Input --}}
                                    <div class="row">

                                        
                                           <!-- category -->
                                    <div class="col-md-6 mb-4">
                                        <div class="mb-4 align-items-center"> <label
                                                class="col-sm-3 col-form-label form-label-title">{{ __('general.categories') }}</label>
                                            <div class="col-sm-9"> <select class="js-example-basic-single w-100" name="category_id"
                                                    id="category">
                                                    <option value="">{{ __('general.select') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id',$expense->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->title }} </option>
                                                    @endforeach
                                                </select> </div>
                                        </div>
                                    </div>


                                    <!-- vendor -->
                                    <div class="col-md-6 mb-4">
                                            <div class="mb-4 align-items-center"> <label
                                                    class="col-sm-3 col-form-label form-label-title">{{ __('general.vendors') }}</label>
                                                <div class="col-sm-9"> <select class="js-example-basic-single w-100" name="vendor_id"
                                                        id="vendor">
                                                        <option value="">{{ __('general.select') }}</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->id }}"
                                                                {{ old('vendor_id',$expense->vendor_id) == $vendor->id ? 'selected' : '' }}>
                                                                {{ $vendor->title }} </option>
                                                        @endforeach
                                                    </select> </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <!-- amount -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">{{ __('general.amount') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="string" name="amount"
                                                        class="form-control @error('amount') is-invalid @enderror"
                                                        value="{{ old('amount',$expense->amount) }}">
                                                    @error('amount')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <!--Date -->
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">{{ __('general.date') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="date"
                                                        class="form-control @error('date') is-invalid @enderror"
                                                        value="{{ old('date',$expense->date) }}">
                                                    @error('date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                               
                                        <div class="col-md-6"> @include('admin.components.image', [
                                            'label' => __('general.image'),
                                            'value' => old('image', $expense->image),
                                            'name' => 'image',
                                            'id' => 'kt_image_3',
                                            'accept' => 'image/*',
                                            'required' => false,
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
        <!-- New expense Add End -->
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
