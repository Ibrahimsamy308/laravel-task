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
                                <h5>{{'general.expenses'}}</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-solid" href="{{route('expenses.create')}}">{{__('general.create')}}</a>
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
                                                <th>{{__('general.description')}}</th>
                                                <th>{{__('general.category')}}</th>
                                                <th>{{__('general.createdBy')}}</th>
                                                
                                                <th>@lang('general.controls')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($expenses as $expense)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="table-image">
                                                            <img src="{{ $expense->image }}" class="img-fluid"
                                                                alt="">
                                                        </div>
                                                    </td>
                                                    
                                                    <td>{{ Str::limit($expense->description, 30, '...') }}</td>
                                                    <td>{{ $expense->category->title }}</td>
                                                    <td>{{ $expense->createdBy->name }}</td>
                                                    
                                                    <td>
                                                        @include('admin.components.controls', [
                                                            'route' => 'expenses',
                                                            'role' => 'expense',
                                                            'module' => $expense,
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
