@extends('admin.layouts.master')

@section('content')
    <!-- Container-fluid starts-->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>{{'general.exams'}}</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">import</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Export</a>
                                        </li>
                                        <li>
                                            <a class="btn btn-solid" href="{{route('exams.create')}}">{{__('general.create')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-exam" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('general.icon')}}</th>

                                                
                                                <th>{{__('general.title')}}</th>
                                                
                                                <th>{{__('general.subtitle')}}</th>

                                                <th>@lang('general.controls')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($exams as $exam)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $exam->icon }}</td>

                                                    
                                                    <td>{{ $exam->title }}</td>
                                                    
                                                    <td>{{ $exam->subtitle }}</td>
                                                    

                                                    <td>
                                                        @include('admin.components.controls', [
                                                            'route' => 'exams',
                                                            'role' => 'exam',
                                                            'module' => $exam,
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
                        <p class="mb-0">{{settings()->copyright}}</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
