 <!--begin::Header-->
 <div id="kt_app_header" class="" data-kt-sticky="true" data-kt-sticky-activate-="true"
     data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
     <!--begin::Header container-->
     <div class="app-container container-xxl d-flex align-items-stretch justify-content-between"
         id="kt_app_header_container">
         <!--begin::Header wrapper-->
         <div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between"
             id="kt_app_header_wrapper">

             <!--begin::Logo wrapper-->
             <div class="d-flex align-items-center">
                 <!--begin::Logo wrapper-->
                 <div class="btn btn-icon btn-color-gray-600 btn-active-color-primary ms-n3 me-2 d-flex d-lg-none"
                     id="kt_app_sidebar_toggle">
                     <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                     <span class="svg-icon svg-icon-2">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <path
                                 d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                 fill="currentColor" />
                             <path opacity="0.3"
                                 d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                 fill="currentColor" />
                         </svg>
                     </span>
                     <!--end::Svg Icon-->
                 </div>
                 <!--end::Logo wrapper-->
                 <!--begin::Logo image-->
                 <a href="{{ route('dashboard') }}" class="d-flex d-lg-none">
                     <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}"
                         class="h-20px theme-light-show" />
                     <img alt="Logo" src="{{ asset('assets/media/logos/logo-white.png') }}"
                         class="h-20px theme-dark-show" />
                 </a>
                 <!--end::Logo image-->
             </div>
             <!--end::Logo wrapper-->

         </div>
         <!--end::Header wrapper-->
     </div>
     <!--end::Header container-->
 </div>
 <!--end::Header-->
 <!--begin::Sidebar-->
 <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
     <!--begin::Logo-->
     <div class="d-flex flex-stack px-4 px-lg-6 py-3 py-lg-8" id="kt_app_sidebar_logo">
         <!--begin::Logo image-->
         <a href="{{ route('dashboard') }}">
             <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}"
                 class="h-20px h-lg-25px theme-light-show" />
             <img alt="Logo" src="{{ asset('assets/media/logos/logo-white.png') }}"
                 class="h-20px h-lg-25px theme-dark-show" />
         </a>
         <!--end::Logo image-->
         <!--begin::User menu-->
         <div class="ms-3">
             <!--begin::Menu wrapper-->
             <div class="cursor-pointer position-relative symbol symbol-circle symbol-40px"
                 data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                 data-kt-menu-placement="bottom-end">
                 @if (Auth::user()->avatar != null)
                     <img alt="Logo" src="{{ Auth::user()->avatar }}" style=" object-fit: cover;" />
                 @else
                     <img alt="Logo" src="{{ asset('assets/media/avatars/300-2.jpg') }}" />
                 @endif
                 <div class="position-absolute rounded-circle bg-success start-100 top-100 h-8px w-8px ms-n3 mt-n3">
                 </div>
             </div>
             <!--begin::User account menu-->
             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                 data-kt-menu="true">
                 <!--begin::Menu item-->
                 <div class="menu-item px-3">
                     <div class="menu-content d-flex align-items-center px-3">
                         <!--begin::Avatar-->
                         <div class="symbol symbol-50px me-5">
                             @if (Auth::user()->avatar != null)
                                 <img alt="Logo" src="{{ Auth::user()->avatar }}" style=" object-fit: cover;" />
                             @else
                                 <img alt="Logo" src="{{ asset('assets/media/avatars/300-2.jpg') }}" />
                             @endif

                         </div>
                         <!--end::Avatar-->
                         <!--begin::Username-->
                         <div class="d-flex flex-column">
                             <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                                 <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                             </div>
                             <a href="#"
                                 class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                         </div>
                         <!--end::Username-->
                     </div>
                 </div>
                 <!--end::Menu item-->
                 <!--begin::Menu separator-->
                 <div class="separator my-2"></div>
                 <!--end::Menu separator-->
                 <!--begin::Menu item-->
                 <div class="menu-item px-5">
                     <a href="{{ route('user.client.profile') }}" class="menu-link px-5">My Profile</a>
                 </div>
                 <!--end::Menu item-->

                 <!--begin::Menu item-->
                 <div class="menu-item px-5">
                     <a href="{{ url('/logout') }}" class="menu-link px-5">Sign Out</a>
                 </div>
                 <!--end::Menu item-->

             </div>
             <!--end::User account menu-->
             <!--end::Menu wrapper-->
         </div>
         <!--end::User menu-->
     </div>
     <!--end::Logo-->
     <!--begin::Sidebar nav-->
     <div class="flex-column-fluid px-4 px-lg-8 py-4" id="kt_app_sidebar_nav">
         <!--begin::Nav wrapper-->
         <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column hover-scroll-y pe-4 me-n4" data-kt-scroll="true"
             data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_nav" data-kt-scroll-offset="5px">
             <!--begin::Progress-->
             <div class="d-flex align-items-center flex-column w-100 mb-3 mb-lg-6">
                <div class="d-flex justify-content-between fw-bolder fs-6 text-gray-800 w-100 mt-auto mb-3">
                    <span>Your Goal</span>
                </div>
                <div class="w-100 bg-light-primary rounded mb-2" style="height: 24px">
                    <div class="bg-primary rounded" role="progressbar" style="height: 24px; width: 37%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="fw-semibold fs-7 text-primary w-100 mt-auto">
                    <span>reached 37% of your target</span>
                </div>
            </div>
             <!--end::Progress-->
             <!--begin::Stats-->
             {{-- <div class="d-flex mb-3 mb-lg-6">
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Budget</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-success">$14,350</div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->
                <!--begin::Stat-->
                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4">
                    <!--begin::Date-->
                    <span class="fs-6 text-gray-500 fw-bold">Spent</span>
                    <!--end::Date-->
                    <!--begin::Label-->
                    <div class="fs-2 fw-bold text-danger">$8,029</div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->
            </div> --}}
             <!--end::Stats-->
             <!--begin::Links-->
             <div class="mb-6">
                 <!--begin::Title-->
                 <h3 class="text-gray-800 fw-bold mb-8">Services</h3>
                 <!--end::Title-->
                 <!--begin::Row-->
                 <div class="row row-cols-2 row-cols-lg-3" data-kt-buttons="true"
                     data-kt-buttons-target="[data-kt-button]">
                     <!--begin::Col-->
                     <div class="col mb-4">
                         <!--begin::Link-->
                         <a href="{{ route('assigned.coach.index') }}"
                             class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-90px h-90px border-gray-200 menu-link"
                             data-kt-button="true">
                             <!--begin::Icon-->
                             <span class="mb-2">
                                 <i class="fa-solid fa-fire fs-2"></i>
                             </span>
                             <!--end::Icon-->
                             <!--begin::Label-->
                             <span class="fs-7 fw-bold">Assigned Coach</span>
                             <!--end::Label-->
                         </a>
                         <!--end::Link-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col mb-4">
                         <!--begin::Link-->
                         <a href="{{ route('assigned.programs.index') }}"
                             class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-90px h-90px border-gray-200 menu-link"
                             data-kt-button="true">
                             <!--begin::Icon-->
                             <span class="mb-2">
                                 <i class="fa-solid fa-fire fs-2"></i>
                             </span>
                             <!--end::Icon-->
                             <!--begin::Label-->
                             <span class="fs-7 fw-bold">Assigned Programs</span>
                             <!--end::Label-->
                         </a>
                         <!--end::Link-->
                     </div>
                     <!--end::Col-->
                 </div>
                 <!--end::Row-->
             </div>
             <!--end::Links-->
         </div>
         <!--end::Nav wrapper-->
     </div>
     <!--end::Sidebar nav-->
     <!--begin::Footer-->
     <div class="flex-column-auto d-flex flex-center px-4 px-lg-8 py-3 py-lg-8" id="kt_app_sidebar_footer">
        <button class="btn btn-primary" id="open-checkin-button" @if(!checkinQuestionAvailability()) disabled @endif onclick="openCheckInModal()">Check In</button>
         <!--begin::Quick links-->
         <div class="app-footer-item me-6">
             <!--begin::Menu- wrapper-->
             <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                 data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                 data-kt-menu-placement="bottom-start">
                 <i class="fonticon-alarm fs-2"></i>
             </div>
             <!--begin::Menu-->
             <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                 <!--begin::Heading-->
                 <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10"
                     style="background-image:url('assets/media/misc/menu-header-bg.jpg')">
                     <!--begin::Title-->
                     <h3 class="text-white fw-semibold mb-3">Quick Links</h3>
                     <!--end::Title-->
                     <!--begin::Status-->
                     <span class="badge bg-primary py-2 px-3">25 pending tasks</span>
                     <!--end::Status-->
                 </div>
                 <!--end::Heading-->
                 <!--begin:Nav-->
                 <div class="row g-0">
                     <!--begin:Item-->
                     <div class="col-6">
                         <a href="../../demo23/dist/apps/projects/budget.html"
                             class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                             <!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
                             <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path opacity="0.3"
                                         d="M15.8 11.4H6C5.4 11.4 5 11 5 10.4C5 9.80002 5.4 9.40002 6 9.40002H15.8C16.4 9.40002 16.8 9.80002 16.8 10.4C16.8 11 16.3 11.4 15.8 11.4ZM15.7 13.7999C15.7 13.1999 15.3 12.7999 14.7 12.7999H6C5.4 12.7999 5 13.1999 5 13.7999C5 14.3999 5.4 14.7999 6 14.7999H14.8C15.3 14.7999 15.7 14.2999 15.7 13.7999Z"
                                         fill="currentColor" />
                                     <path
                                         d="M18.8 15.5C18.9 15.7 19 15.9 19.1 16.1C19.2 16.7 18.7 17.2 18.4 17.6C17.9 18.1 17.3 18.4999 16.6 18.7999C15.9 19.0999 15 19.2999 14.1 19.2999C13.4 19.2999 12.7 19.2 12.1 19.1C11.5 19 11 18.7 10.5 18.5C10 18.2 9.60001 17.7999 9.20001 17.2999C8.80001 16.8999 8.49999 16.3999 8.29999 15.7999C8.09999 15.1999 7.80001 14.7 7.70001 14.1C7.60001 13.5 7.5 12.8 7.5 12.2C7.5 11.1 7.7 10.1 8 9.19995C8.3 8.29995 8.79999 7.60002 9.39999 6.90002C9.99999 6.30002 10.7 5.8 11.5 5.5C12.3 5.2 13.2 5 14.1 5C15.2 5 16.2 5.19995 17.1 5.69995C17.8 6.09995 18.7 6.6 18.8 7.5C18.8 7.9 18.6 8.29998 18.3 8.59998C18.2 8.69998 18.1 8.69993 18 8.79993C17.7 8.89993 17.4 8.79995 17.2 8.69995C16.7 8.49995 16.5 7.99995 16 7.69995C15.5 7.39995 14.9 7.19995 14.2 7.19995C13.1 7.19995 12.1 7.6 11.5 8.5C10.9 9.4 10.5 10.6 10.5 12.2C10.5 13.3 10.7 14.2 11 14.9C11.3 15.6 11.7 16.1 12.3 16.5C12.9 16.9 13.5 17 14.2 17C15 17 15.7 16.8 16.2 16.4C16.8 16 17.2 15.2 17.9 15.1C18 15 18.5 15.2 18.8 15.5Z"
                                         fill="currentColor" />
                                 </svg>
                             </span>
                             <!--end::Svg Icon-->
                             <span class="fs-5 fw-semibold text-gray-800 mb-0">Accounting</span>
                             <span class="fs-7 text-gray-400">eCommerce</span>
                         </a>
                     </div>
                     <!--end:Item-->
                     <!--begin:Item-->
                     <div class="col-6">
                         <a href="../../demo23/dist/apps/projects/settings.html"
                             class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
                             <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                             <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z"
                                         fill="currentColor" />
                                     <path opacity="0.3"
                                         d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
                                         fill="currentColor" />
                                 </svg>
                             </span>
                             <!--end::Svg Icon-->
                             <span class="fs-5 fw-semibold text-gray-800 mb-0">Administration</span>
                             <span class="fs-7 text-gray-400">Console</span>
                         </a>
                     </div>
                     <!--end:Item-->
                     <!--begin:Item-->
                     <div class="col-6">
                         <a href="../../demo23/dist/apps/projects/list.html"
                             class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">
                             <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                             <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                         fill="currentColor" />
                                     <path opacity="0.3"
                                         d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                         fill="currentColor" />
                                 </svg>
                             </span>
                             <!--end::Svg Icon-->
                             <span class="fs-5 fw-semibold text-gray-800 mb-0">Projects</span>
                             <span class="fs-7 text-gray-400">Pending Tasks</span>
                         </a>
                     </div>
                     <!--end:Item-->
                     <!--begin:Item-->
                     <div class="col-6">
                         <a href="../../demo23/dist/apps/projects/users.html"
                             class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
                             <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                             <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path opacity="0.3"
                                         d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                         fill="currentColor" />
                                     <path
                                         d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                         fill="currentColor" />
                                 </svg>
                             </span>
                             <!--end::Svg Icon-->
                             <span class="fs-5 fw-semibold text-gray-800 mb-0">Customers</span>
                             <span class="fs-7 text-gray-400">Latest cases</span>
                         </a>
                     </div>
                     <!--end:Item-->
                 </div>
                 <!--end:Nav-->
                 <!--begin::View more-->
                 <div class="py-2 text-center border-top">
                     <a href="../../demo23/dist/pages/user-profile/activity.html"
                         class="btn btn-color-gray-600 btn-active-color-primary">View All
                         <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                         <span class="svg-icon svg-icon-5">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <rect opacity="0.5" x="18" y="13" width="13" height="2"
                                     rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                 <path
                                     d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                     fill="currentColor" />
                             </svg>
                         </span>
                         <!--end::Svg Icon-->
                     </a>
                 </div>
                 <!--end::View more-->
             </div>
             <!--end::Menu-->
             <!--end::Menu wrapper-->
         </div>
         <!--end::Quick links-->

     </div>
     <!--end::Footer-->
 </div>
 <!--end::Sidebar-->
