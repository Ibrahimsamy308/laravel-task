@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>{{ __('general.courses') }}</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-solid" href="{{ route('courses.create') }}">
                                                {{ __('general.create') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-course" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('general.title') }}</th>
                                                <th>{{ __('general.price') }}</th>
                                                <th>{{ __('general.discount') }}</th>
                                                <th>{{ __('general.level') }}</th>
                                                <th>@lang('general.controls')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $course->translate(app()->getLocale())->title ?? '-' }}</td>
                                                    <td>{{ $course->price }}</td>
                                                    <td>{{ $course->discount ?? '-' }}</td>
                                                    <td>{{ ucfirst($course->level) }}</td>
                                                    <td>
                                                        @include('admin.components.controls', [
                                                            'route' => 'courses',
                                                            'role' => 'course',
                                                            'module' => $course,
                                                        ])
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid Ends-->

        <div class="container-fluid">
            <!-- footer start-->
            <footer class="footer">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">{{ settings()->copyright }}</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
