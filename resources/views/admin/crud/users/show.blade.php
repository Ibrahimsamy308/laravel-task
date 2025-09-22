@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <!-- New user Add Start -->
        <div class="container-fluid">
            <div class="row theme-form ">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">

                                    <div class="title-header option-title">
                                        <h5>{{ __('general.show') }} {{ __('general.users') }}</h5>
                                    </div>

                                    <div class="row">
                                        <!-- normal input -->
                                        <div class="col-sm-6"> 
                                            <div class="mb-4 align-items-center">
                                                <label class="form-label-title mb-0">{{ __('general.name') }}</label>
                                                <p class="bg-show p-2 mt-2">{{ $user->fullname }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-5 bg-light p-3 rounded h-100">
                                                <div class="card-title fw-bold">
                                                    <h5 class="font-weight-bolder text-dark">{{ __('general.email') }}: </h5> 
                                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- normal input -->
                                        <div class="col-sm-6">
                                            <div class="mb-4  align-items-center">
                                                <label class="form-label-title mb-0">{{ __('general.phone') }}</label>
                                                <p class="bg-show p-2 mt-2">{{ $user->phone }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- normal input -->
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-6"> 
                                            <label class="form-label-title mb-0">{{ __('general.image') }}</label> 
                                            <img class="bg-show p-2 mt-2" width="300" height="300"
                                                 src="{{ $user->image }}" alt=""> 
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="title-header option-title">
                            <h5>{{ __('general.userExams') }}</h5>
                        </div>

                        {{-- User exams --}}
                        <div class="table-responsive">
                            <table class="table all-package theme-table table-user" id="table_id">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('general.course')</th>
                                        <th>{{__('general.lesson')}}</th>
                                        <th>{{__('general.score')}}</th>
                                        <th>@lang('general.controls')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->exams as $userExam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $userExam->course->title }}</td>
                                            <td>{{ $userExam->lesson->title }}</td>
                                            <td>{{ $userExam->pivot->score }}</td>
                                            <td>
                                                @can('userExam-list')
                                                    <a href="{{ route('userExams.show', $userExam->pivot->id) }}" class="btn btn-sm " title="{{ __('general.view') }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="title-header option-title">
                            <h5>{{ __('general.userCourses') }}</h5>
                        </div>

                        <div class="accordion" id="coursesAccordion">
                            @foreach ($user->courses as $course)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $course->id }}">
                                        <button class="accordion-button collapsed" type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#course-{{ $course->id }}" 
                                                aria-expanded="false" 
                                                aria-controls="course-{{ $course->id }}">
                                            {{ $course->title }} ({{ $course->level }})
                                        </button>
                                    </h2>
                                    <div id="course-{{ $course->id }}" class="accordion-collapse collapse" 
                                         aria-labelledby="heading-{{ $course->id }}" 
                                         data-bs-parent="#coursesAccordion">
                                        <div class="accordion-body">
                                            <p><strong>{{ __('general.start_date') }}:</strong> {{ \Carbon\Carbon::parse($course->start_date)->locale(app()->getLocale())->translatedFormat('j F Y') }}</p>
                                            <p><strong>{{ __('general.end_date') }}:</strong> {{ \Carbon\Carbon::parse($course->end_date)->locale(app()->getLocale())->translatedFormat('j F Y') }}</p>

                                            {{-- Lessons --}}
                                            <div class="accordion mt-3" id="lessonsAccordion-{{ $course->id }}">
                                                @foreach ($course->lessons as $lesson)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading-lesson-{{ $lesson->id }}">
                                                            <button class="accordion-button collapsed" type="button" 
                                                                    data-bs-toggle="collapse" 
                                                                    data-bs-target="#lesson-{{ $lesson->id }}" 
                                                                    aria-expanded="false" 
                                                                    aria-controls="lesson-{{ $lesson->id }}">
                                                                {{ $lesson->title }}
                                                            </button>
                                                        </h2>
                                                        <div id="lesson-{{ $lesson->id }}" class="accordion-collapse collapse" 
                                                             aria-labelledby="heading-lesson-{{ $lesson->id }}" 
                                                             data-bs-parent="#lessonsAccordion-{{ $course->id }}">
                                                            <div class="accordion-body">
                                                                {{-- Videos --}}
                                                                <table class="table table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>{{ __('general.video_title') }}</th>
                                                                            <th>{{ __('general.status') }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($lesson->videos as $video)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $video->title }}</td>
                                                                                <td>
                                                                                    @php
                                                                                        $watched = $video->users()
                                                                                            ->where('user_id', $user->id)
                                                                                            ->first();
                                                                                    @endphp
                                                                                    @if ($watched && $watched->pivot->watched_at)
                                                                                        {{ \Carbon\Carbon::parse($watched->pivot->watched_at)->locale(app()->getLocale())->translatedFormat('j F Y H:i') }}
                                                                                    @else
                                                                                        <span class="badge bg-danger">{{ __('general.not_watched_yet') }}</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- New user Add End -->
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
