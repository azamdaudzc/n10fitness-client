@extends('layouts.main-layout')

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div style="display: flex">
                    <a href="{{$back_url}}"><i class="fa fa-arrow-left fs-1" style="margin-right:5px"></i></a>
                    <h2>Week : {{ $program_week->week_no }}</h2>

                </div>
                <p><strong>Assigned Calories :</strong> {{ $program_week->assigned_calories }}</p>
                <p><strong>Assigned Proteins :</strong> {{ $program_week->assigned_proteins }}</p>




                @php
                    $period = new DatePeriod(new DateTime($start_date), new DateInterval('P1D'), new DateTime($end_date));
                @endphp


                <div class="row">

                    @foreach ($period as $key => $value)
                        <div class="col-md-4 mt-5 ">

                            <div class="card h-200px">
                                <div class="card-body">
                                    @php
                                        $found = 0;
                                    @endphp
                                    @foreach ($week_days as $wd)
                                        @if ($wd->day_title == strtolower($value->format('l')))
                                            @php
                                                $found = 1;
                                                $day_no = $wd->day_no;
                                                $day_id = $wd->id;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if ($found == 1)
                                        <h2>Day {{ $day_no }}</h2>
                                        {{ $value->format('Y-M-d') }} <br>
                                        {{ $value->format('l') }} <br>
                                        @if (date('Y-m-d') == $value->format('Y-m-d'))
                                            @isset($ans_exists[$day_id])
                                                <span class="badge badge-lg badge-light-success fw-bold my-2">Done</span>
                                                <a class="btn btn-instagram w-100 mt-3"
                                                    href="{{ route('assigned.programs.view-day-prepare') }}?id={{ $day_id }}&date={{ $value->format('Y-m-d') }}&last_id={{ $last_id }}">
                                                    View </a>
                                            @else
                                                <a class="btn btn-instagram w-100 mt-15"
                                                    href="{{ route('assigned.programs.view-day-prepare') }}?id={{ $day_id }}&date={{ $value->format('Y-m-d') }}&last_id={{ $last_id }}">
                                                    Start </a>
                                            @endisset
                                        @elseif (date('Y-m-d') >= $value->format('Y-m-d'))
                                            <span class="badge badge-lg badge-light-danger fw-bold my-2">Closed</span>
                                            <a class="btn btn-instagram w-100 mt-3"
                                                href="{{ route('assigned.programs.view-day-prepare') }}?id={{ $day_id }}&date={{ $value->format('Y-m-d') }}&last_id={{ $last_id }}">
                                                View </a>
                                        @endif
                                    @else
                                        <h2>Rest Day</h2>
                                        {{ $value->format('Y-M-d') }} <br>
                                        {{ $value->format('l') }}
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

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
