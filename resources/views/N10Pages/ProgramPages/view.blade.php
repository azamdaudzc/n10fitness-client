@extends('layouts.main-layout')

@section('content')
<style>
    .bg-image {
  background-image: url("{{asset('assets/media/sample/gym_banner.png')}}");
  /* filter: blur(1px); */
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.bg-text ,.bg-text h4{
    color: white;
}

</style>
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">

                    <h2>Program Title : {{ $user_program->program->title }}</h2>
                    @php
                        $last_week_id=null;
                    @endphp
                    @foreach ($program_weeks as $pw)
                        <div class="card mt-5">
                            <div class="card-body bg-image">




                                <div style="display: flex; justify-content:space-between" class="bg-text">
                                <div>
                                    <h4>Week : {{$pw->week_no}}</h4>
                                    @IF($user_program->start_date != NULL)
                                    {{date('Y-m-d', strtotime($user_program->start_date. ' + '.(($pw->week_no-1) * 7).' days'))}} - {{date('Y-m-d', strtotime($user_program->start_date. ' + '.($pw->week_no * 7).' days'))}}
                                    @endif
                                </div>
                                @if($user_program->start_date==null && $pw->week_no==1)
                                    <a href="{{route('assigned.programs.view-week',$pw->id)}}" class="btn btn-primary">Start Week</a>
                                @endif
                                @if($user_program->start_date!=null)
                                @if(date("Y-m-d H:i:s") >= date('Y-m-d', strtotime($user_program->start_date. ' + '.(($pw->week_no-1) * 7).' days')))
                                    <a href="{{route('assigned.programs.view-week',[$pw->id,$last_week_id])}}" class="btn btn-primary">Open Week</a>
                                @endif
                                @endif
                                </div>

                            </div>
                        </div>
                        @php
                            $last_week_id=$pw->id;
                        @endphp
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
