@extends('admin.components.form')
@section('form_action', route('exams.store'))
@section('form_type', 'POST')
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
                                        {{ __('general.create') }} {{ __('general.exams') }}
                                    </h5>
                                </div>

                                {{-- Locales --}}
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

                                            <div class="mb-4 row align-items-center">
                                                <label
                                                    class="form-label-title col-sm-3 mb-0">{{ __('general.title') }} -
                                                    @lang('general.' . $locale)<span
                                                        class="text-danger"> * </span></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        name="{{ $locale . '[title]' }}"
                                                        placeholder="{{ __('general.title') }}"
                                                        class="form-control @error('title') invalid @enderror @error($locale . '.title') is-invalid @enderror"
                                                        value="{{ old($locale . '.title') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="questions-wrapper">
                                    <div class="question-item bg-light border rounded-3 p-3 mb-3 position-relative">
                                        <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-question">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                
                                        <h6 class="fw-bold mb-3 text-dark">
                                            <i class="fa-solid fa-circle-question me-2"></i>
                                            Question
                                        </h6>
                                
                                        <input type="text" name="questions[0][question]"
                                            class="form-control mb-3"
                                            placeholder="Enter your question">
                                
                                        <div class="answers-wrapper">
                                            <div class="answer-item d-flex mb-2">
                                                <input type="text" name="questions[0][answers][]"
                                                    class="form-control me-2 answer-input" placeholder="Answer option"
                                                    oninput="updateCorrectOptions(this)">
                                                <button type="button"
                                                    class="btn btn-outline-danger btn-sm remove-answer">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                
                                        <button type="button"
                                            class="btn btn-outline-success btn-sm add-answer mb-3">
                                            <i class="fa fa-plus"></i> Add Answer
                                        </button>
                                
                                        <label class="fw-bold text-dark">Correct Answer:</label>
                                        <select name="questions[0][correct]" class="form-select correct-select">
                                            <option value="">-- Select Correct Answer --</option>
                                        </select>
                                    </div>
                                </div>                                

                                <button type="button" id="add-question"
                                    class="btn btn-primary btn-sm mb-4">
                                    <i class="fa fa-plus"></i> Add Question
                                </button>

                                {{-- Video --}}
                                <div class="col-md-6">
                                    @include('admin.components.video', [
                                        'label' => __('general.video'),
                                        'value' => old('video'),
                                        'name' => 'video',
                                        'id' => 'kt_video_1',
                                        'accept' => 'video/*',
                                        'required' => true,
                                    ])
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
</div>

@endsection

@push('scripts')
<script>
    let qIndex = 1;

    // Add Question
    document.getElementById('add-question').addEventListener('click', function() {
        let wrapper = document.getElementById('questions-wrapper');
        let html = `
        <div class="question-item bg-light border rounded-3 p-3 mb-3 position-relative">
            <button type="button"
                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-question">
                <i class="fa fa-trash"></i>
            </button>

            <h6 class="fw-bold mb-3 text-dark">
                <i class="fa-solid fa-circle-question me-2"></i>
                Question
            </h6>

            <input type="text" name="questions[${qIndex}][question]"
                class="form-control mb-3" placeholder="Enter your question">

            <div class="answers-wrapper">
                <div class="answer-item d-flex mb-2">
                    <input type="text" name="questions[${qIndex}][answers][]"
                        class="form-control me-2 answer-input" 
                        placeholder="Answer option" oninput="updateCorrectOptions(this)">
                    <button type="button"
                        class="btn btn-outline-danger btn-sm remove-answer">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <button type="button"
                class="btn btn-outline-success btn-sm add-answer mb-3">
                <i class="fa fa-plus"></i> Add Answer
            </button>

            <label class="fw-bold text-dark">Correct Answer:</label>
            <select name="questions[${qIndex}][correct]" class="form-select correct-select">
                <option value="">-- Select Correct Answer --</option>
            </select>
        </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        qIndex++;
    });

    // Delegate buttons
    document.addEventListener('click', function(e) {
        // Add Answer
        if(e.target.closest('.add-answer')) {
            let parent = e.target.closest('.question-item');
            let idx = [...parent.parentNode.children].indexOf(parent);
            let wrapper = parent.querySelector('.answers-wrapper');
            wrapper.insertAdjacentHTML('beforeend', `
                <div class="answer-item d-flex mb-2">
                    <input type="text" name="questions[${idx}][answers][]" 
                        class="form-control me-2 answer-input" 
                        placeholder="Answer option" oninput="updateCorrectOptions(this)">
                    <button type="button"
                        class="btn btn-outline-danger btn-sm remove-answer">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            `);
            refreshCorrectOptions(parent);
        }

        // Remove Answer
        if(e.target.closest('.remove-answer')) {
            let parent = e.target.closest('.question-item');
            e.target.closest('.answer-item').remove();
            refreshCorrectOptions(parent);
        }

        // Remove Question
        if(e.target.closest('.remove-question')) {
            e.target.closest('.question-item').remove();
        }
    });

    // تحديث الـ correct select بناءً على الإجابات
    function updateCorrectOptions(input) {
        let parent = input.closest('.question-item');
        refreshCorrectOptions(parent);
    }

    function refreshCorrectOptions(questionDiv) {
        let answers = questionDiv.querySelectorAll('.answer-input');
        let select = questionDiv.querySelector('.correct-select');
        let current = select.value;

        // مسح القديم
        select.innerHTML = '<option value="">-- Select Correct Answer --</option>';

        // إعادة بناء الـ options
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
