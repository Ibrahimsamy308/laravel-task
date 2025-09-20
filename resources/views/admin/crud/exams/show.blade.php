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
                                        {{ __('general.show') }} {{ __('general.exams') }}
                                    </h5>
                                </div>

                                <div class="row">
                                    {{-- Course --}}
                                    <div class="col-sm-6">
                                        <div class="mb-4  align-items-center">
                                            <label class="form-label-title mb-0">{{ __('general.courses') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{ $exam->course?->title }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Lesson --}}
                                    <div class="col-sm-6">
                                        <div class="mb-4 align-items-center">
                                            <label class="form-label-title mb-0">{{ __('general.lessons') }}</label>
                                            <p class="bg-show p-2 mt-2">
                                                {{ $exam->lesson?->title }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Questions --}}
                                @php
                                    $questions = json_decode($exam->questions, true) ?? [];
                                @endphp

                                @foreach ($questions as $qIndex => $question)
                                    <div class="question-item bg-light border rounded-3 p-3 mb-3">
                                        <h6 class="fw-bold mb-3 text-dark">
                                            <i class="fa-solid fa-circle-question me-2"></i>
                                            {{ __('general.question') }} {{ $qIndex + 1 }}
                                        </h6>

                                        <div class="mb-3">
                                            <label class="form-label-title text-dark">{{ __('general.question') }}</label>
                                            <p class="bg-show p-2 mt-2 text-dark">{{ $question['question'] ?? '' }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label-title text-dark">{{ __('general.answers') }}</label>
                                            <ul class="list-group mt-2">
                                                @foreach ($question['answers'] ?? [] as $answer)
                                                    <li class="list-group-item d-flex justify-content-between text-dark">
                                                        <span>{{ $answer }}</span>
                                                        @if (($question['correct'] ?? '') == $answer)
                                                            <span class="badge bg-success">{{ __('general.correct_answer') }}</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
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
@endsection
