@extends('layouts.main-layout')

@section('content')

        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">

                    <h2>Week : {{ $program_week->week_no }}</h2>
                    <h2>Assigned Calories : {{ $program_week->assigned_calories }}</h2>
                    <h2>Assigned Proteins : {{ $program_week->assigned_proteins }}</h2>


                    {{$start_date}}
                    {{$end_date}}



                <div class="row">

                    @foreach ($week_days as $wd)

                    <div class="col-md-4 mt-5 ">

                        <div class="card h-200px">
                            <div class="card-body">
                               @for ($i=0;$i<7;$i++)
                                   @php
                                       $current_date=date('Y-m-d', strtotime($start_date. ' + '.$i.' days'));
                                   @endphp
                                    @if(strtolower(date('l', strtotime($current_date))) == $wd->day_title )
                                        {{$current_date}}
                                        @php
                                            $saved_current_date=$current_date;
                                        @endphp
                                    @endif
                               @endfor
                                <h1>{{$wd->day_title}}</h1>

                                @if(date("Y-m-d ") >= $saved_current_date)
                                <a class="btn btn-primary" href="{{route('assigned.programs.view-day',$wd->id)}}"> Open </a>

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
