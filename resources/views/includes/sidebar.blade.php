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
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px notification-main-icon"
            data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-start">
            <div class="notification">
               <i class="fonticon-alarm fs-2">
               </i>
               <span class="badge">{{getNotificationCount()}}</span>

           </div>

        </div>
        <!--begin::Menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px notification-icon " data-kt-menu="true">
            <!--begin::Heading-->
            <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10"
            style="background-image:url('{{asset('assets/media/misc/menu-header-bg.jpg')}}')">

                <!--begin::Title-->
                <h3 class="text-white fw-semibold mb-3">Notifications</h3>
                <!--end::Title-->
                <!--begin::Status-->
                <span class="badge bg-primary py-2 px-3">{{getNotificationCount()}} pending</span>
                <!--end::Status-->
            </div>
            <!--end::Heading-->
            <!--begin:Nav-->
            <div class="row g-0">
               <div class="card-body pt-0">
                   @foreach(getNotifications() as $notification)
                   <!--begin::Item-->
                   <div class="d-flex flex-stack">
                       <!--begin::Flag-->
                       <img src="assets/media/flags/united-states" class="me-4 w-25px" style="border-radius: 4px" alt="">
                       <!--end::Flag-->
                       <!--begin::Section-->
                       <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                           <!--begin::Content-->
                           <div class="me-5">
                               <!--begin::Title-->
                               <a href="{{notificationWhereToGo($notification->notification_type)}}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{$notification->name}}</a>
                               <!--end::Title-->
                               <!--begin::Desc-->
                               <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">{{$notification->message}}</span>
                               <!--end::Desc-->
                           </div>
                           <!--end::Content-->

                       </div>
                       <!--end::Section-->
                   </div>
                   <!--end::Item-->
                   <!--begin::Separator-->
                   <div class="separator separator-dashed my-3"></div>
                   <!--end::Separator-->
                   @endforeach

               </div>
            </div>
            <!--end:Nav-->
            <!--begin::View more-->
            <div class="py-2 text-center border-top">
                <a href="#"
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
