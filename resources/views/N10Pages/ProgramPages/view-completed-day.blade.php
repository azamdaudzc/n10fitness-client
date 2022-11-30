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
                                    <h3 class="card-title" >W {{$week}} - Day {{ $program_day->day_no }}</h3>
                                    <div class="card-toolbar">

                                    </div>
                                </div>
                                <div class="card-body">

                                    <Strong>Warmups :</Strong> <br>
                                    <ul class="mb-10">
                                        @foreach ($warmups as $w)
                                            <li>{{ $w->warmupBuilder->name }}</li>
                                        @endforeach
                                    </ul>
                                    <div class="form-group">
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($exercises as $exercise)
                                            <div class="mt-10">
                                                <hr class="solid">
                                                <div class="mt-5 mb-5 ">
                                                    <strong>Exercise :</strong> {{ $exercise->exerciseLibrary->name }}
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
                                                                <td class="w-100px">Reps
                                                                </td>
                                                                <td>RPE</td>
                                                                <td>Previous
                                                                </td>
                                                                <td>Max Exerted</td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 1; $i <= $exercise_sets[$exercise->id]->set_no; $i++)
                                                                <tr>

                                                                    <td class="w-55px">SET {{ $i }}</td>
                                                                    <td>{{$answeres[$exercise->id][$i]->weight}}</td>
                                                                    <td>{{$answeres[$exercise->id][$i]->reps}}</td>
                                                                    <td>{{$answeres[$exercise->id][$i]->rpe}}</td>
                                                                    @if($last_exercise_sets!=null && isset($last_exercise_sets[$exercise->exercise_library_id]->weight))
                                                                    <td class="w-55px">{{ $last_exercise_sets[$exercise->exercise_library_id]->weight}}X{{ $last_exercise_sets[$exercise->exercise_library_id]->reps}} R {{ $last_exercise_sets[$exercise->exercise_library_id]->rpe}}</td>
                                                                    @else
                                                                    <td class="w-55px">N/A</td>
                                                                    @endif
                                                                    <td>{{$answeres[$exercise->id][$i]->peak_exterted_max}}</td>


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
    @endsection

    @section('page-scripts')
        <!--begin::Vendors Javascript(used for this page only)-->
        <script>
            function calculateMaxExerted(exercise_id, set_no, rpe) {
                let weight = $('#w_e_' + exercise_id + "_s_" + set_no).val();
                let reps = $('#r_e_' + exercise_id + "_s_" + set_no).val();
                reps = parseInt(reps);
                weight = parseInt(weight);
                rpe = parseInt(rpe);
                let max_exerted = Math.round((((10 - rpe) + reps) * weight * 0.0333 + weight));

                $('#ma_e_' + exercise_id + "_s_" + set_no).html(max_exerted);
                $('#mai_e_' + exercise_id + "_s_" + set_no).val(max_exerted);
            }



            $(function() {




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
