@extends('admin.layouts.master')
@section('content')
            <!-- index body start -->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- chart caard section start -->
                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                                <div class="custome-1-bg b-r-4 card-body">
                                    <div class="media align-items-center static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">{{ __('general.students') }}</span>
                                            <h4 class="mb-0 counter">{{ itemsCount('users') }}
                                                <span class="badge badge-light-primary grow">
                                                    <i data-feather="trending-up"></i>8.5%</span>
                                            </h4>
                                        </div>
                                        <div class="align-self-center text-center">
                                            <i class="ri-user-add-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                                <div class="custome-2-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">{{ __('general.instructors') }}</span>
                                            <h4 class="mb-0 counter">{{ itemsCount('instructors') }}
                                                <span class="badge badge-light-danger grow">
                                                    <i data-feather="trending-down"></i>8.5%</span>
                                            </h4>
                                        </div>
                                        <div class="align-self-center text-center">
                                            <i class="ri-user-add-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                                <div class="custome-3-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">{{ __('general.courses') }}</span>
                                            <h4 class="mb-0 counter">{{ itemsCount('courses') }}
                                                <a href="add-new-product.html" class="badge badge-light-secondary grow">
                                                    ADD NEW</a>
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i class="ri-chat-3-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                                <div class="custome-4-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">{{ __('general.videos') }}</span>
                                            <h4 class="mb-0 counter">{{ itemsCount('videos') }}
                                                <span class="badge badge-light-success grow">
                                                    <i data-feather="trending-down"></i>8.5%</span>
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i class="ri-database-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card o-hidden card-hover">
                                <div class="card-header border-0 pb-1">
                                    <div class="card-header-title p-0">
                                        <h4>{{ __('general.courses') }}</h4>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="category-slider no-arrow">

                                        @foreach (courses() as $course)
                                            <div>
                                                <div class="dashboard-category">
                                                    {{-- <a href="javascript:void(0)" class="category-image">
                                                        <img src="{{asset($course->image)}}" class="img-fluid no-filter"  alt="">
                                                    </a> --}}

                                                     <a href="javascript:void(0)" class="">
                                                        <img src="{{asset($course->image)}}" class="img-fluid no-filter"  alt="">
                                                    </a>
                                                    
                                                    <a href="javascript:void(0)" class="category-name">
                                                        <h6>{{ $course->title }}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chart card section End -->

                        <!-- Best Selling Courses Start -->

                        @php
                            $sortBy = request()->get('sort', 'price_desc');
                            $courses = getCoursesBySort($sortBy);
                        @endphp

                        <div class="col-xl-6 col-md-12">
                            <div class="card o-hidden card-hover">
                                <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                    <div class="card-header-title">
                                        <h4>{{ __('general.topCourses') }}</h4>
                                    </div>

                                    <div class="best-selling-box d-sm-flex d-none">
                                        <span>{{ __('general.sortBy') }}:</span>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                data-bs-auto-close="true">
                                                {{ ucfirst(str_replace('_', ' ', $sortBy)) }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="?sort=price_desc">{{ __('general.highestPrice') }}</a></li>
                                                <li><a class="dropdown-item" href="?sort=price_asc">{{ __('general.lowestPrice') }}</a></li>
                                                <li><a class="dropdown-item" href="?sort=most_lessons">{{ __('general.mostLessons') }}</a></li>
                                                <li><a class="dropdown-item" href="?sort=most_students">{{ __('general.mostStudents') }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="best-selling-table w-image table border-0">
                                            <tbody>
                                                @foreach($courses as $course)
                                                    <tr>
                                                        <td>
                                                            <div class="best-product-box">
                                                                <div class="product-image">
                                                                    <img src="{{ $course->image ? asset($course->image) : settings()->logo }}"
                                                                         class="img-fluid" alt="{{ $course->title }}"
                                                                         style="filter: none !important;">
                                                                </div>
                                                                
                                                                <div class="product-name">
                                                                    <h5>{{ $course->title }}</h5>
                                                                    <h6>{{ $course->created_at->format('d-m-Y') }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="product-detail-box">
                                                                <h6>{{ __('general.price') }}</h6>
                                                                <h5>${{ $course->price }}</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="product-detail-box">
                                                                <h6>{{ __('general.lessons') }}</h6>
                                                                <h5>{{ $course->lessons_count ?? $course->lessons()->count() }}</h5>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="product-detail-box">
                                                                <h6>{{ __('general.students') }}</h6>
                                                                <h5>{{ $course->students_count ?? $course->students()->count() }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                @if($courses->isEmpty())
                                                    <tr>
                                                        <td colspan="4" class="text-center">{{ __('general.no_courses_found') }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                 

                        <!-- Best Selling Courses End -->


                        <!-- Recent orders start-->

                        <div class="col-xl-6">
                            <div class="card o-hidden card-hover">
                                <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                    <div class="card-header-title">
                                        <h4>{{ __('general.recentExams') }}</h4>
                                    </div>

                                    <div class="best-selling-box d-sm-flex d-none">
                                        <span>{{ __('general.sortBy') }}:</span>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle" type="button"
                                                id="dropdownMenuExams" data-bs-toggle="dropdown"
                                                data-bs-auto-close="true">{{ __('general.newest') }}</button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuExams">
                                                <li><a class="dropdown-item exam-sort" data-sort="new" href="?sort=new">{{ __('general.newest') }}</a></li>
                                                <li><a class="dropdown-item exam-sort" data-sort="old" href="?sort=old">{{ __('general.oldest') }}</a></li>
                                                <li><a class="dropdown-item exam-sort" data-sort="most_students" href="?sort=most_students">{{ __('general.mostStudents') }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <div>
                                        <div class="table-responsive">
                                            <table class="best-selling-table table border-0">
                                                <tbody id="exam-table-body">
                                                    @foreach(getSortedExams() as $exam)
                                                        <tr>
                                                            <td>
                                                                <div class="best-product-box">
                                                                    <div class="product-name">
                                                                        <h5>{{ $exam->title }}</h5>
                                                                        <h6>#{{ $exam->id }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="product-detail-box">
                                                                    <h6>{{ __('general.date') }}</h6>
                                                                    <h5>{{ $exam->created_at->format('d-m-Y') }}</h5>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="product-detail-box">
                                                                    <h6>{{ __('general.students') }}</h6>
                                                                    <h5>{{ $exam->users_count }}</h5>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="product-detail-box">
                                                                    <h6>{{ __('general.avgScore') }}</h6>
                                                                    <h5>
                                                                        {{ round($exam->users->avg(fn($u) => $u->pivot->score), 2) ?? 0 }}
                                                                    </h5>
                                                                </div>
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

                <!-- footer start-->
                <div class="container-fluid">
                    <footer class="footer">
                        <div class="row">
                            <div class="col-md-12 footer-copyright text-center">
                                <p class="mb-0">{{settings()->copyright}}</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- footer End-->
            </div>
            <!-- index body end -->
@endsection
