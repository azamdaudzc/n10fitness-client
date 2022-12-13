<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>N10 | Fitness</title>
    <meta charset="utf-8" />
    <meta name="description" content="N10 Fitness" />
    <meta name="keywords" content="N10 Fitness" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta property="og:title" content="N10 | Fitness" />
    <meta property="og:url" content="https://n10fitness.com" />
    <meta property="og:site_name" content="n10fitness |" />
    <link rel="canonical" href="https://preview.n10fitness.com" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .error-area ul {
            list-style: none
        }

        .setAllInfo {
            list-style: none
        }

        .error-area ul li {
            color: red
        }


        ul.setAllInfo li {
            padding: 10px;
            font-size: medium;
        }

        .dataTables_filter,
        .dataTables_length {
            display: none;
        }

        .dataTables_paginate a {
            padding: 10px;

        }

        .paginate_button.current {
            background-color: green;
            color: aliceblue;
            border-radius: 8px;
        }

        .thumbnail-image {
            width: 75px;
            height: 75px;
            border-radius: 21px;
        }



        .image-input-wrapper {
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }
    </style>


    <style>
        .warmupvideo-container {
            position: relative;

            /* width: 444px; */
            height: 200px;
        }

        .warmupvideo-image {
            opacity: 1;
            display: block;
            width: 100%;
            height: 200px;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .warmupvideo-overlay {
            position: absolute;
            top: 10px;
            left: 0;
            width: 100%;
            height: 200px;
            background: rgba(0, 0, 0, 0);
            transition: background 0.5s ease;
        }

        .warmupvideo-container:hover .warmupvideo-overlay {
            display: block;
            background: rgba(0, 0, 0, .3);
        }

        .warmupvideo-button {
            position: absolute;
            width: 100%;
            left: 0;
            top: 60px;
            text-align: center;
            opacity: 0;
            transition: opacity .35s ease;
        }

        .warmupvideo-button img {
            width: 180px;
            padding: 12px 48px;
            text-align: center;
            color: white;
            z-index: 1;
        }

        .warmupvideo-container:hover .warmupvideo-button {
            opacity: 1;
        }
        .center-vertical {
            margin: auto;
            width: 50%;
            padding: 10px;
        }

        .center {
            text-align: center;

        }

        .program-table thead{
            background-color: #767676;
            color: white;
        }

        .program-table tbody tr:nth-child(even){background-color: #f2f2f2;}

        .program-main-area {
            overflow-x: auto;
            display: flex;
        }

        .program-sub-area {
            padding: 10px;
            margin: 10px;
        }

        hr.solid {
            border-top: 3px solid #bbb;
        }
        .editable-program-table tr td input{
            width: 50px
        }

        .notification {
            color: white;
            text-decoration: none;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }


        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 2px 5px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }

        .exercise-link , .warmup-link {
            color: blue;
            text-decoration: underline;
            list-style: none;
            cursor: pointer;
        }

        .table-responsive,
        .dataTables_scrollBody {
            overflow: visible !important;
        }
    </style>

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            {{-- @include('includes.header') --}}
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate-="true"
                data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '100px', lg: '100px'}"
                style="height: 30px">
            </div>
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('includes.sidebar')

                 <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                @yield('content')

                   <!--begin::Footer-->
        <div id="kt_app_footer" class="app-footer">
            <!--begin::Footer container-->
            <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                <!--begin::Copyright-->
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted fw-semibold me-1">2022&copy;</span>
                    <a href="https://n10fitness.com" target="_blank" class="text-gray-800 text-hover-primary">N10Fitness</a>
                </div>
                <!--end::Copyright-->
                <!--begin::Menu-->

                <!--end::Menu-->
            </div>
            <!--end::Footer container-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end:::Main-->
            </div>

        </div>

    </div>


    <div class="modal fade" tabindex="-1" id="check_questions_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal_name">Checkin Question</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </div>
                </div>
                <form id="checkin_question_form" method="post" action="{{route('checkin.questions.store')}}">
                    @csrf
                    <div class="modal-body checkin-questions-area">

                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="submitCheckinForm()"  class="btn btn-primary me-10" id="question-form-submit-button">
                        <span class="indicator-label">
                            Save Changes
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

    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    @yield('page_scripts')
    @yield('sub_page_scripts')
    <!--end::Vendors Javascript-->
    <!--end::Javascript-->
    @yield('scripts')

    <script>
        $(function() {
            var current = location.pathname;
            if (current != '/') {
                $('.menu-link').removeClass('active');
                $('.menu-link').parent().parent().parent().removeClass('here');
            } else {
                $('#main_dashboard_menu').addClass('here');
                $('#main_dashboard_menu_item').addClass('active');
            }
            $('.menu-link').each(function() {
                var $this = $(this);
                if (current != '/') {

                    if ($this.attr('href')) {
                        var splitted = current.split("/");
                        current = '/' + splitted[1] + '/' + splitted[2];
                        if ($this.attr('href').indexOf(current) !== -1) {
                            $this.addClass('active');
                            $this.parent().parent().parent().addClass('here');
                        }
                    }

                }
            })
        })

        function closemodal() {

            $("#kt_modal_add_user").modal('hide');
        }
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

        });

        $('#kt_modal_add_user').on('shown.bs.modal', function(e) {
            // do something...
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $('input[name=_token]').val("{{ csrf_token() }}");
        });

        function openCheckInModal(){

            $.post( "{{route('checkin.questions.list')}}", {
                _token: '{{ csrf_token() }}',
                } ,function( data ) {
                        $('.checkin-questions-area').html(data);
                        $('.js-example-basic-multiple').select2();

                        $('#check_questions_modal').modal("toggle");

            });
        }


        $(".notification-main-icon").click(function(){

            $.get('{{route('mark.notification.done')}}', function (){
            });
        });

        function submitCheckinForm(){

            $('#question-form-submit-button').attr("data-kt-indicator", "on");

            $.ajax({
                url: $('#checkin_question_form').attr("action"),
                type: $('#checkin_question_form').attr("method"),

                data: new FormData($('#checkin_question_form')[0]),
                processData: false,
                contentType: false,
                success: function(d, status) {
                    console.log(d);
                    $('#check_questions_modal').modal("toggle");
                    if(d.new_data=='available'){
                    openCheckInModal();
                    }
                    else{
                        toastr.success('Checkin Completed');
                        $('#open-checkin-button').attr('disabled','disabled');
                    }
                    $('#question-form-submit-button').attr("data-kt-indicator", "off");

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
                    $('#question-form-submit-button').attr("data-kt-indicator", "off");

                }
            });
}
    </script>
@yield('page-scripts')
</body>
<!--end::Body-->

</html>
