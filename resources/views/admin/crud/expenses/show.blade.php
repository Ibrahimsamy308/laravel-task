@extends('admin.layouts.master')

@section('content')
    <div class="page-body">

        <!-- New Product Add Start -->
        <div class="container-fluid">



            <div class="row theme-form ">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>{{ __('general.show') }} {{ __('general.expenses') }}</h5>
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
                                                <!-- normal input -->
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-12"> <label
                                                            class="form-label-title mb-0">{{ __('general.description') }}</label>
                                                        <p class="bg-show p-2 mt-2">
                                                            {!! $expense->translate($locale)->description !!}</p>
                                                    </div>
                                                </div>

                                               

                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12"> <label
                                                class="form-label-title mb-0">{{ __('general.category') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{  isset($expense->category)?$expense->category->title:'NA'  }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12"> <label
                                                class="form-label-title mb-0">{{ __('general.vendor') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{  isset($expense->vendor)?$expense->vendor->title:'NA'  }}</p>
                                        </div>
                                    </div>


                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12"> <label
                                                class="form-label-title mb-0">{{ __('general.amount') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{$expense->amount  }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-12"> <label
                                                class="form-label-title mb-0">{{ __('general.date') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{$expense->date  }}</p>
                                        </div>
                                    </div>



                                    <div class="col-sm-12"> 
                                        <label
                                            class="form-label-title mb-0">{{ __('general.image :') }}
                                        </label> 
                                        <img
                                            class="bg-show p-2 mt-2" width="250" height="250"
                                            src="{{ $expense->image }}" alt=""> 
                                    </div>

                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Product Add End -->
    </div>
@endsection
