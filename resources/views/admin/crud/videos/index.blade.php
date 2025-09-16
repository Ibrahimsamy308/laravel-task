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
                                <h5>{{'general.videos'}}</h5>
                                <div class="right-options">
                                    <ul>
                                     
                                        <li>
                                            <a class="btn btn-solid" href="{{route('videos.create')}}">{{__('general.create')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-video" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('general.title')}}</th>
                                                <th>{{__('general.lesson')}}</th>
                                                <th>{{__('general.duration')}}</th>
                                                <th>@lang('general.controls')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($videos as $video)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $video->title }}</td>
                                                    <td>{{ $video->lesson->title }}</td>
                                                    <td>{{ $video->duration }}</td>
                                                    {{-- <td>{{ Str::limit(strip_tags($video->description), 50, '...') }}</td> --}}

                                                    
                                                    <td>
                                                        @include('admin.components.controls', [
                                                            'route' => 'videos',
                                                            'role' => 'video',
                                                            'module' => $video,
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
