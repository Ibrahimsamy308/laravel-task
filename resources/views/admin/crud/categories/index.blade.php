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
                                <h5>{{'general.categories'}}</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-solid" href="{{route('categories.create')}}">{{__('general.create')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-category" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th>{{__('general.image')}}</th>
                                                <th>{{__('general.title')}}</th>
                                                
                                                <th>@lang('general.controls')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="table-image">
                                                            <img src="{{ $category->image }}" class="img-fluid"
                                                                alt="">
                                                        </div>
                                                    </td>
                                                    
                                                    <td>{{ $category->title }}</td>
                                                    
                                                    <td>
                                                        @include('admin.components.controls', [
                                                            'route' => 'categories',
                                                            'role' => 'category',
                                                            'module' => $category,
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
