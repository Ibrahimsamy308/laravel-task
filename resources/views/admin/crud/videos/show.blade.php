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
                                        <h5>{{ __('general.show') }} {{ __('general.videos') }}</h5>
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
                                                            class="form-label-title mb-0">{{ __('general.title') }}</label>
                                                        <p class="bg-show p-2 mt-2">
                                                            {{ $video->translate($locale)->title }}</p>
                                                    </div>
                                                </div>

                                                <!-- normal input -->
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-12"> <label
                                                            class="form-label-title mb-0">{{ __('general.description') }}</label>
                                                        {!! $video->translate($locale)->description !!} </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                    

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">{{ __('general.lessons') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" 
                                                       class="form-control" 
                                                       value="{{ $video->lesson->title ?? __('general.not_found') }}" 
                                                       disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.duration') }}
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" 
                                                           class="form-control" 
                                                           value="{{ $video->duration }}" 
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">
                                                    {{ __('general.is_active') }}
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" 
                                                           class="form-control" 
                                                           value="{{ $video->is_active ? __('general.active') : __('general.inactive') }}" 
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label-title mb-2">{{ __('general.video') }}</label>

                                            @if (!empty($video->video))
                                                <video width="100%" height="auto" controls>
                                                    <source src="{{ asset($video->video) }}" type="video/mp4">
                                                    {{ __('general.browser_not_support_video') }}
                                                </video>
                                            @else
                                                <p class="text-muted">{{ __('general.no_video_available') }}</p>
                                            @endif
                                        </div>


                                        
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
