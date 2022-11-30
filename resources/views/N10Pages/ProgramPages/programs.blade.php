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
                                <div class="card" style="width: 18rem;">
                                    <img src="{{asset('assets/media/sample/bodybuilding.png')}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <h5 class="card-title"> {{ $program->program->title }}</h5>
                                      <p class="card-text">{{ $program->program->weeks }} Weeks | {{ $program->program->days }} Days
                                    <br>
                                Coach : {{ $program->program->coach->first_name }}
                                {{ $program->program->coach->last_name }}</p>
                                      <a href="{{ route('assigned.programs.view', $program->id) }}" class="btn btn-light-twitter w-100">View Program</a>
                                    </div>
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
