@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row theme-form">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-10 m-auto">
                        <div class="card shadow-lg border-0 rounded-3">
                            <div class="card-body">
                                <div class="title-header option-title mb-4">
                                    <h5 class="fw-bold text-primary">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        {{ __('general.show') }} {{ __('general.userExams') }}
                                    </h5>
                                </div>

                                <div class="row">
                                    {{-- Course --}}
                                    <div class="col-sm-6">
                                        <div class="mb-4  align-items-center">
                                            <label class="form-label-title mb-0">{{ __('general.courses') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{ $userExam->exam->course?->title }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Lesson --}}
                                    <div class="col-sm-6">
                                        <div class="mb-4 align-items-center">
                                            <label class="form-label-title mb-0">{{ __('general.lessons') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{ $userExam->exam->lesson?->title }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Lesson --}}
                                    <div class="col-sm-6">
                                        <div class="mb-4 align-items-center">
                                            <label class="form-label-title mb-0">{{ __('general.score') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{ $userExam->score }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="fw-bold text-secondary mb-3">{{ __('general.answers') }}</h5>
                                
                                        @foreach ($userExam->decoded_answers as $index => $answer)
                                            <div class="mb-4 p-3 border rounded bg-light">
                                                <h6 class="fw-bold text-primary">
                                                    {{ __('general.question') }} {{ $loop->iteration }} ({{ $index }})
                                                </h6>
                                
                                                <div class="mt-2 p-2 border rounded 
                                                    @if($answer['correct']) bg-success-subtle border-success @else bg-danger-subtle border-danger @endif">
                                                    <span class="fw-bold text-dark">{{ __('general.userAnswer') }} : {{ $answer['answer'] }} </span>  
                                
                                                    @if($answer['correct'])
                                                        <i class="fa fa-check text-success ms-2"></i>
                                                    @else
                                                        <i class="fa fa-times text-danger ms-2"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                

                            </div>

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
@endsection
