@extends('layouts.main-layout')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->

                <div class="card mb-5 mb-xl-8">
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <!--begin:::Tab item-->

                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->

                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->

                        <!--end:::Tab item-->

                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Profile</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5" id="profile_form">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive table-wth-minh">

                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->



                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->

        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('page_scripts')
    <script>
        $(function() {
            loadForm();
            loadInfo();
            $('.select-2-setup').select2();
        });



        function loadForm() {
            let id = "{{ $user->id }}";
            let form_body = $('#profile_form');

            $.post('{{ route('user.client.details') }}', {
                _token: '{{ csrf_token() }}',
                id
            }, function(d) {
                form_body.html(d);
            });
        }





        function closeModal() {
            $('#kt_modal_add_client').modal('hide');
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
                    if (d.success == true) {
                        toastr.success(d.msg);
                        loadForm();


                        closeModal();

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
@endsection
