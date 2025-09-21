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
                                <h5>{{__('general.admins')}}</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-solid"
                                                href="{{ route('admins.create') }}">{{ __('general.create') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-admin" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('general.image')</th>
                                                <th>{{ __('general.name') }}</th>

                                                <th>{{ __('general.email') }}</th>
                                                <th>{{ __('general.role') }}</th>

                                                <th>{{ __('general.phone') }}</th>

                                                <th>@lang('general.controls')</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $admin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="table-image">
                                                            <img src="{{ $admin->image }}" class="img-fluid"
                                                                alt="">
                                                        </div>
                                                    </td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $admin->roles->first()?->name ?? '-'  }}</span>
                                                    </td>
                                                    <td>{{ $admin->phone }}</td>

                                                                                                                                           <td>
                                                        @include('admin.components.controls', [
                                                            'route' => 'admins',
                                                            'role' => 'admin',
                                                            'module' => $admin,
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
