@extends('layouts.main-layout')

@section('content')




     <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">


                    <form action="{{ route('assigned.programs.store-day') }}" method="post">

                        @csrf
                        <input type="hidden" name="day_id" id="" value="{{$day_id}}">
                        <div class="program-sub-area col-md-12">
                            <div class="card shadow-sm ">
                                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                                    data-bs-target="#kt_docs_card_collapsible">

                                    <div style="display: flex;align-items:center">
                                        <a href="{{$back_url}}"><i class="fa fa-arrow-left fs-1" style="margin-right:5px"></i></a>
                                        <h3 class="card-title" >W {{$week}} - Day {{ $program_day->day_no }}</h3>
                                    </div>
                                    <div class="card-toolbar">

                                    </div>
                                </div>
                                <div class="card-body">

                                    <Strong>Warmups :</Strong> <br>
                                    <ul class="mb-10" style="list-style: none">
                                        @foreach ($warmups as $w)

                                        <li>
                                            <div class="border d-flex mt-4 p-2 shadow w-26" style="border-radius: 10px">
                                                @if ($w->warmupBuilder->avatar != null)
                                                <img src="{{  $w->warmupBuilder->avatar }}" alt="image" style="height: 100px;width:100px"/>
                                            @else
                                                <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image" style="height: 100px;width:100px"/>
                                            @endif

                                            <div style="padding-left: 10px">
                                                <label for="" class="text-danger"><strong>{{ $w->warmupBuilder->name }}</strong></label> <br>
                                                {{ $w->warmupBuilder->description }}<br>
                                                <label for="" class="warmup-link" data-id="{{$w->warmup_builder_id}}" class="text-danger">Learn More -></label>
                                            </div>
                                        </div>

                                    </li>
                                        @endforeach
                                    </ul>
                                    <div class="form-group">
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($exercises as $exercise)
                                            <div class="mt-10">
                                                <hr class="solid">
                                                <div class="mt-5 mb-5  ">
                                                    <strong>Exercise :</strong>
                                                    <div class="border d-flex mt-4 p-2 shadow w-26" style="border-radius: 10px">
                                                        @if ($exercise->exerciseLibrary->avatar != null)
                                                        <img src="{{  $exercise->exerciseLibrary->avatar }}" alt="image" style="height: 100px;width:100px"/>
                                                    @else
                                                        <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image" style="height: 100px;width:100px"/>
                                                    @endif

                                                    <div style="padding-left: 10px">
                                                        <label for="" class="text-danger"><strong>{{ $exercise->exerciseLibrary->name }}</strong></label> <br>
                                                        {{ $exercise->exerciseLibrary->description }}<br>
                                                        <label for="" class="exercise-link" data-id="{{$exercise->exerciseLibrary->id}}" class="text-danger">Learn More -></label>
                                                    </div>
                                                </div>
                                                </div>
                                                @if($exercise_sets[$exercise->id]->notes != null)
                                                <div class="mt-5 mb-5 h-50px">
                                                    <label for=""><strong>Note:</strong></label>
                                                    {{ $exercise_sets[$exercise->id]->notes }}

                                                </div>
                                                @endif
                                                <div class="table-responsive ">
                                                    <table class="table-bordered program-table editable-program-table w-100">
                                                        <thead>
                                                            <tr style="text-align:center;">

                                                                <td >Sets
                                                                </td>
                                                                <td class="w-100px">Weight
                                                                </td>
                                                                <td class="w-100px">Reps {{ $exercise_sets[$exercise->id]->rep_min_no }}-{{ $exercise_sets[$exercise->id]->rep_max_no }}
                                                                </td>
                                                                <td>RPE</td>
                                                                <td>Previous
                                                                </td>
                                                                <td>Max Exerted</td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <div>
                                                                <strong >Peak Exerted Max:</strong>
                                                                <label id="peak_exerted_max_{{$exercise->id}}">0</label>

                                                            </div>
                                                            @for ($i = 1; $i <= $exercise_sets[$exercise->id]->set_no; $i++)
                                                                <tr>
                                                                    <td class="w-55px">SET {{ $i }}</td>
                                                                    <td><input class="w-100 weight-inputs" type="number"
                                                                            name="w_e_{{ $exercise->id }}_s_{{ $i }}"
                                                                            id="w_e_{{ $exercise->id }}_s_{{ $i }}"
                                                                            onkeyup="calculateMaxExerted('{{ $exercise->id }}','{{ $i }}','{{ $exercise_sets[$exercise->id]->rpe_no }}')">
                                                                    </td>
                                                                    <td><input class="w-100 reps-inputs" type="number"
                                                                            name="r_e_{{ $exercise->id }}_s_{{ $i }}"
                                                                            id="r_e_{{ $exercise->id }}_s_{{ $i }}"
                                                                            onkeyup="calculateMaxExerted('{{ $exercise->id }}','{{ $i }}','{{ $exercise_sets[$exercise->id]->rpe_no }}')"
                                                                            min="{{ $exercise_sets[$exercise->id]->rep_min_no }}"
                                                                            max="{{ $exercise_sets[$exercise->id]->rep_max_no }}">
                                                                    </td>
                                                                    <td class="w-55px">{{ $exercise_sets[$exercise->id]->rpe_no }}</td>
                                                                    @if($last_exercise_sets!=null && isset($last_exercise_sets[$exercise->exercise_library_id]->weight))
                                                                    <td class="w-55px">{{ $last_exercise_sets[$exercise->exercise_library_id]->weight}}X{{ $last_exercise_sets[$exercise->exercise_library_id]->reps}} R {{ $last_exercise_sets[$exercise->exercise_library_id]->rpe}}</td>
                                                                    @else
                                                                    <td class="w-55px">N/A</td>
                                                                    @endif
                                                                    <td class="w-55px"
                                                                        id="ma_e_{{ $exercise->id }}_s_{{ $i }}">
                                                                        N/A

                                                                    </td>
                                                                    <input type="hidden"
                                                                    name="mai_e_{{ $exercise->id }}_s_{{ $i }}"
                                                                    id="mai_e_{{ $exercise->id }}_s_{{ $i }}" value="0">
                                                                </tr>
                                                            @endfor


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    </div>

                                    <div class="box-footer mt-20">
                                        <button type="submit" class="btn btn-primary me-10" id="crud-form-submit-button" style="float: right">
                                            <span class="indicator-label">
                                                Submit
                                            </span>
                                            <span class="indicator-progress">
                                                Please wait... <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

        <div class="modal fade" tabindex="-1" id="info_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Warmup Info</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body" id="info_modal_body">
                        <p>Modal body text goes here.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('page-scripts')
        <!--begin::Vendors Javascript(used for this page only)-->
        <script>
            function calculateMaxExerted(exercise_id, set_no, rpe) {
                //weight-inputs
                //reps-inputs
                let peak = 0;
                let weight = $('#w_e_' + exercise_id + "_s_" + set_no).val();
                let reps = $('#r_e_' + exercise_id + "_s_" + set_no).val();
                let max_exerted=getMaxExerted(weight,reps,rpe);
                $('#ma_e_' + exercise_id + "_s_" + set_no).html(max_exerted);
                $('#mai_e_' + exercise_id + "_s_" + set_no).val(max_exerted);

                var weight_inputs = $(".weight-inputs");
                var reps_inputs = $(".reps-inputs");
                for(var i = 0; i < weight_inputs.length; i++){
                    weight =$(weight_inputs[i]).val();
                    reps = $(reps_inputs[i]).val();
                    max_exerted=getMaxExerted(weight,reps,rpe);

                    if(peak<max_exerted){
                        peak=max_exerted;

                    }
                }
                $('#peak_exerted_max_'+exercise_id).html(peak);
            }

            function getMaxExerted(weight,reps,rpe){
                reps = parseInt(reps);
                weight = parseInt(weight);
                rpe = parseInt(rpe);
                return Math.round((((10 - rpe) + reps) * weight * 0.0333 + weight));
            }

            $(function() {

                $(document).on('click',".warmup-link",function(){
                    let id = $(this).attr('data-id');
                    $.post('{{route("program.info.warmup")}}',{
                        _token: '{{ csrf_token() }}',
                        id
                    },function(data){
                        $('#info_modal_body').html(data);
                        $('#info_modal').modal('toggle');

                    });
                });

                $(document).on('click',".exercise-link",function(){
                    let id = $(this).attr('data-id');
                    $.post('{{route("program.info.exercise")}}',{
                        _token: '{{ csrf_token() }}',
                        id
                    },function(data){
                        $('#info_modal_body').html(data);
                        $('#info_modal').modal('toggle');

                    });

                });



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
                            if (d.success == true) {
                                toastr.success(d.msg);
                                location.reload();

                            } else {
                                toastr.error(d.msg);
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
            });
        </script>
        <!--end::Custom Javascript-->
    @endsection
