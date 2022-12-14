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
                                                $client_weight = $wd->client_weight;
                                                $client_waist = $wd->client_waist;
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
                                                <a class="btn btn-instagram w-100 mt-3" onclick="handelDayClick('{{ route('assigned.programs.view-day-prepare') }}?id={{ $day_id }}&date={{ $value->format('Y-m-d') }}&last_id={{ $last_id }}','{{$day_id}}','{{$client_weight}}')"
                                                    >
                                                    View </a>
                                            @else
                                                <a class="btn btn-instagram w-100 mt-15" onclick="handelDayClick('{{ route('assigned.programs.view-day-prepare') }}?id={{ $day_id }}&date={{ $value->format('Y-m-d') }}&last_id={{ $last_id }}','{{$day_id}}','{{$client_weight}}')"
                                                    >
                                                    Start </a>
                                            @endisset
                                        @elseif (date('Y-m-d') >= $value->format('Y-m-d'))
                                            <span class="badge badge-lg badge-light-danger fw-bold my-2">Closed</span>
                                            <a class="btn btn-instagram w-100 mt-3" onclick="handelDayClick('{{ route('assigned.programs.view-day-prepare') }}?id={{ $day_id }}&date={{ $value->format('Y-m-d') }}&last_id={{ $last_id }}','{{$day_id}}','{{$client_weight}}')"
                                                >
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



    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Enter</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{route('save.daily.weight.waist')}}" method="post">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" id="daily_inputs_day_id" name="day_id">
                    <input type="hidden" id="daily_inputs_day_url" name="url">
                        <div>
                            <label for="">Enter Weight In KG</label>
                            <input class="form-control" type="number" name="daily_weight" id="">
                        </div>

                        <div>
                            <label for="">Enter Waist</label>
                            <input class="form-control" type="text" name="daily_waist" id="">
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary me-10" id="crud-form-submit-button">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>

            </div>
        </div>
    </div>

@endsection

@section('page-scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script>
        function handelDayClick(url,day_id,weight){
            if(weight == 0  || weight == null){
                $('#daily_inputs_day_id').val(day_id);
                $('#daily_inputs_day_url').val(url);
                $('#kt_modal_1').modal('toggle');
            }
            else{
                window.location.href=url;
            }
        }

        $(document).on("submit", "form", function(event) {
                event.preventDefault();
                $('#crud-form-submit-button').attr("data-kt-indicator", "on");

                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),

                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(d, status) {
                        console.log(d);
                        if (d.success == true) {

                            window.location.href=d.url;
                        }
                        $('#crud-form-submit-button').attr("data-kt-indicator", "off");

                    },
                    error: function(data) {
                        var response = JSON.parse(data.responseText);
                        var errorString = '<ul>';
                        $.each(response.errors, function(key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul>';
                        $('.error-area').html('');
                        toastr.error(errorString);
                        $('#crud-form-submit-button').attr("data-kt-indicator", "off");

                    }
                });

            });
    </script>
    <!--end::Custom Javascript-->
@endsection
