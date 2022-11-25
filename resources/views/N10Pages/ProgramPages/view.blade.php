@extends('layouts.main-layout')

@section('content')

        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">

                    <h2>Program Title : {{ $user_program->program->title }}</h2>

                    @foreach ($program_weeks as $pw)
                        <div class="card mt-5">
                            <div class="card-body">
                                <div style="display: flex; justify-content:space-between">
                                <div>
                                    <h4>Week : {{$pw->week_no}}</h4>
                                    {{date('Y-m-d', strtotime($user_program->start_date. ' + '.(($pw->week_no-1) * 7).' days'))}} - {{date('Y-m-d', strtotime($user_program->start_date. ' + '.($pw->week_no * 7).' days'))}}
                                </div>
                                @if($user_program->start_date==null && $pw->week_no==1)
                                    <a href="{{route('assigned.programs.view-week',$pw->id)}}" class="btn btn-primary">Start Week</a>
                                @endif
                                @if($user_program->start_date!=null)
                                @if(date("Y-m-d H:i:s") >= date('Y-m-d', strtotime($user_program->start_date. ' + '.(($pw->week_no-1) * 7).' days')))
                                    <a href="{{route('assigned.programs.view-week',$pw->id)}}" class="btn btn-primary">Open Week</a>
                                @endif
                                @endif
                                </div>
                            </div>
                        </div>
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
