@extends('layouts.main-layout')

@section('content')
   
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    @foreach ($programs as $program)
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10">

                            <!--begin::Col-->
                            <div class="col-xl-8 mb-5 mb-xl-10">
                                <!--begin::Engage widget 12-->
                                <div class="card card-custom bg-body border-0 h-md-100">
                                    <!--begin::Body-->
                                    <div class="card-body d-flex justify-content-center flex-wrap ps-xl-15 pe-0">
                                        <!--begin::Wrapper-->
                                        <div class="flex-grow-1 mt-2 me-9 me-md-0">
                                            <!--begin::Title-->
                                            <div class="position-relative text-gray-800 fs-1 z-index-2 fw-bold mb-5">
                                                {{ $program->program->title }}
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Text-->
                                            <span class="text-gray-600 fw-semibold fs-6 mb-6 d-block">
                                                <strong>Coach Name :</strong>  {{ $program->program->coach->first_name }}
                                                {{ $program->program->coach->last_name }}  <br>
                                               <strong>No Of Weeks :</strong>  {{ $program->program->weeks }}  <br>
                                               <strong>No Of Days :</strong> {{ $program->program->days }}  <br>
                                            </span>
                                            <!--end::Text-->
                                            <!--begin::Action-->
                                            <a href="{{ route('assigned.programs.view', $program->id) }}">View</a>

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
    <!--begin::Vendors Javascript(used for this page only)-->

    <!--end::Custom Javascript-->
@endsection
