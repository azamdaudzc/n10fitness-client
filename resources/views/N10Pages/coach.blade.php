@extends('layouts.main-layout')

@section('content')

        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    @foreach ($coaches as $coach)
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10">

                            <!--begin::Col-->
                            <div class="col-xl-4 mb-5 mb-xl-10">
                                <!--begin::Engage widget 12-->
                                <div class="card card-custom bg-body border-0 h-md-100">
                                    <!--begin::Body-->
                                    <div class="card-body d-flex justify-content-center flex-wrap ps-xl-15 pe-0">
                                        <!--begin::Wrapper-->
                                        <div class="flex-grow-1 mt-2 me-9 me-md-0">
                                            <!--begin::Title-->
                                            <div class="position-relative text-gray-800 fs-3 z-index-2 fw-bold mb-5">
                                                Assigned Coach
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Text-->
                                            @if ($coach)
                                                <div style="display:flex;justify-content:space-between;margin-right:20px" >
                                                    <span class="text-gray-600 fw-semibold fs-3 mb-6 d-block"><strong>Name : </strong>{{ $coach->coach->first_name }} {{ $coach->coach->last_name }}</span>

                                                    <div class="image-input-wrapper w-125px h-125px"
                                                    @if ($coach->coach->avatar != null) style="background-image: url('{{ $coach->coach->avatar }}');     border: solid 1px;
                                                    border-radius: 10px;"@else style="background-image: url('{{ asset('assets/media/svg/files/young-fitness-man-studio.jpg') }}') ;    border: solid 1px;
                                                    border-radius: 10px;" @endif>
                                                    </div>
                                                    @else
                                                    Coach Not Assigned Yet
                                                </div>
                                            @endif
                                            <!--end::Text-->
                                            <!--begin::Action-->

                                            <!--begin::Action-->
                                        </div>
                                        <!--begin::Wrapper-->
                                        <!--begin::Illustration-->
                                        <img src="assets/media/illustrations/misc/credit-card.png" class="h-175px me-15"
                                            alt="" />
                                        <!--end::Illustration-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Engage widget 12-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    @endforeach

                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

@endsection

@section('page-scripts')

@endsection
