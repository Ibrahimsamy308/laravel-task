@extends('admin.components.form')
@section('form_action', route('exams.update', $exam->id))
@section('form_type', 'PUT')
@section('fields_content')

<div class="page-body">
    <div class="container-fluid">
        <div class="row theme-form">
            <div class="col-12">
                @include('admin.components.alert-error')

                <div class="row">
                    <div class="col-sm-10 m-auto">
                        <div class="card shadow-lg border-0 rounded-3">
                            <div class="card-body">
                                <div class="title-header option-title mb-4">
                                    <h5 class="fw-bold text-primary">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        {{ __('general.edit') }} {{ __('general.exams') }}
                                    </h5>
                                </div>

                                {{-- Course & Lesson --}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-4 row align-items-center"> 
                                            <label class="col-sm-3 col-form-label form-label-title">{{ __('general.courses') }}</label>
                                            <div class="col-sm-9">
                                                <select class="js-example-basic-single w-100" name="course_id" id="course">
                                                    <option value="">{{ __('general.select') }}</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}" {{ $exam->course_id == $course->id ? 'selected' : '' }}>
                                                            {{ $course->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-4 row align-items-center"> 
                                            <label class="col-sm-3 col-form-label form-label-title">{{ __('general.lessons') }}</label>
                                            <div class="col-sm-9">
                                                <select class="js-example-basic-single w-100" name="lesson_id" id="lesson">
                                                    <option value="">{{ __('general.select') }}</option>
                                                    @foreach ($lessons as $lesson)
                                                        <option value="{{ $lesson->id }}" {{ $exam->lesson_id == $lesson->id ? 'selected' : '' }}>
                                                            {{ $lesson->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    {{-- Questions --}}
                                <div id="questions-wrapper">
                              
                                    @foreach ($questions as $qIndex => $question)
                                        <div class="question-item bg-light border rounded-3 p-3 mb-3 position-relative">
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-question">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <h6 class="fw-bold mb-3 text-dark">
                                                <i class="fa-solid fa-circle-question me-2"></i>
                                                {{ __('general.question') }}
                                            </h6>

                                            <input type="text" 
                                                name="questions[{{ $qIndex }}][question]" 
                                                class="form-control mb-3" 
                                                value="{{ $question['question'] ?? '' }}" 
                                                placeholder="{{ __('general.enter_question') }}" required>

                                            <div class="answers-wrapper">
                                                @if (!empty($question['answers']) && is_array($question['answers']))
                                                    @foreach ($question['answers'] as $answer)
                                                        <div class="answer-item d-flex mb-2">
                                                            <input type="text" 
                                                                name="questions[{{ $qIndex }}][answers][]" 
                                                                class="form-control me-2 answer-input" 
                                                                value="{{ $answer }}" 
                                                                placeholder="{{ __('general.answer_option') }}" 
                                                                oninput="updateCorrectOptions(this)" required>
                                                            <button type="button" class="btn btn-outline-danger btn-sm remove-answer">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <button type="button" class="btn btn-outline-success btn-sm add-answer mb-3">
                                                <i class="fa fa-plus"></i> {{ __('general.addAnswer') }}
                                            </button>

                                            <label class="fw-bold text-dark">{{ __('general.correct_answer') }}:</label>
                                            <select name="questions[{{ $qIndex }}][correct]" class="form-select correct-select" required>
                                                <option value="">{{ __('general.select_correct_answer') }}</option>
                                                @if (!empty($question['answers']) && is_array($question['answers']))
                                                    @foreach ($question['answers'] as $answer)
                                                        <option value="{{ $answer }}" {{ ($question['correct'] ?? '') == $answer ? 'selected' : '' }}>
                                                            {{ $answer }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    @endforeach
                                </div>


                                <button type="button" id="add-question" class="btn btn-primary btn-sm mb-4">
                                    <i class="fa fa-plus"></i> {{ __('general.addQuestion') }}
                                </button>
                            </div>

                            <div class="card-submit-button">
                                <button class="btn btn-animation ms-auto" type="submit">{{__('general.update')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>

@endsection

@push('scripts')
<script>
    let qIndex = {{ $qCount ?? 0 }};

    document.getElementById('add-question').addEventListener('click', function() {
        let wrapper = document.getElementById('questions-wrapper');
        let html = `
        <div class="question-item bg-light border rounded-3 p-3 mb-3 position-relative">
            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-question">
                <i class="fa fa-trash"></i>
            </button>

            <h6 class="fw-bold mb-3 text-dark">
                <i class="fa-solid fa-circle-question me-2"></i>
                {{ __('general.question') }}
            </h6>

            <input type="text" name="questions[${qIndex}][question]"
                class="form-control mb-3" placeholder="{{ __('general.enter_question') }}" required>

            <div class="answers-wrapper">
                <div class="answer-item d-flex mb-2">
                    <input type="text" name="questions[${qIndex}][answers][]" 
                        class="form-control me-2 answer-input" 
                        placeholder="{{ __('general.answer_option') }}" 
                        oninput="updateCorrectOptions(this)" required>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-answer">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <button type="button" class="btn btn-outline-success btn-sm add-answer mb-3">
                <i class="fa fa-plus"></i> {{ __('general.addAnswer') }}
            </button>

            <label class="fw-bold text-dark">{{ __('general.correct_answer') }}:</label>
            <select name="questions[${qIndex}][correct]" class="form-select correct-select" required>
                <option value="">{{ __('general.select_correct_answer') }}</option>
            </select>
        </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        qIndex++;
    });

    // إضافة/إزالة إجابة أو سؤال
    document.addEventListener('click', function(e) {
        if(e.target.closest('.add-answer')) {
            let parent = e.target.closest('.question-item');
            let idx = [...parent.parentNode.children].indexOf(parent);
            let wrapper = parent.querySelector('.answers-wrapper');
            wrapper.insertAdjacentHTML('beforeend', `
                <div class="answer-item d-flex mb-2">
                    <input type="text" name="questions[${idx}][answers][]" 
                        class="form-control me-2 answer-input" 
                        placeholder="{{ __('general.answer_option') }}" 
                        oninput="updateCorrectOptions(this)" required>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-answer">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            `);
            refreshCorrectOptions(parent);
        }

        if(e.target.closest('.remove-answer')) {
            let parent = e.target.closest('.question-item');
            e.target.closest('.answer-item').remove();
            refreshCorrectOptions(parent);
        }

        if(e.target.closest('.remove-question')) {
            e.target.closest('.question-item').remove();
        }
    });

    function updateCorrectOptions(input) {
        let parent = input.closest('.question-item');
        refreshCorrectOptions(parent);
    }

    function refreshCorrectOptions(questionDiv) {
        let answers = questionDiv.querySelectorAll('.answer-input');
        let select = questionDiv.querySelector('.correct-select');
        let current = select.value;

        select.innerHTML = `<option value="">${@json(__('general.select_correct_answer'))}</option>`;

        answers.forEach(ans => {
            if(ans.value.trim() !== "") {
                let opt = document.createElement('option');
                opt.value = ans.value;
                opt.textContent = ans.value;
                if(ans.value === current) opt.selected = true;
                select.appendChild(opt);
            }
        });
    }
</script>
@endpush
