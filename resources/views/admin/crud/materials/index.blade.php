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
                                <h5>{{'general.materials'}}</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-solid" href="{{route('materials.create')}}">{{__('general.create')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-material" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                
                                                <th>{{__('general.title')}}</th>
                                                
                                                <th>@lang('general.controls')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($materials as $material)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>                                                    
                                                    <td>{{ $material->title }}</td>
                                  
                                                    <td>
                                                        @include('admin.components.controls', [
                                                            'route' => 'materials',
                                                            'role' => 'material',
                                                            'module' => $material,
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
