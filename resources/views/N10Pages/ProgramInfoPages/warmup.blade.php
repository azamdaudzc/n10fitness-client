<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Warmup</h3>
        </div>
        @if($data->approved_by==0 && $data->rejected_by==0)
        <div><a class="btn btn-primary align-self-center approve_record" data-id="{{$data->id}}" href="javascript:void(0);">Approve</a>
        <a class="btn btn-danger align-self-center reject_record" data-id="{{$data->id}}" href="javascript:void(0);">Reject</a>
        </div>
        @elseif ($data->approved_by!=0)
        <div class="badge badge-light-success h-40px">Approved</div>
        @else
        <div class="badge badge-light-danger h-40px">Rejected</div>
        @endif

    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body p-9">
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-12 fw-semibold text-muted">Name</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-12">
                <span class="fw-bold fs-6 text-gray-800">{{ $data->name }}</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-12 fw-semibold text-muted">Instructions</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-12 fv-row">
                <span class="fw-semibold text-gray-800 fs-6">{{ $data->instruction }}</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-12 fw-semibold text-muted">Description</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-12 fv-row">
                <span class="fw-semibold text-gray-800 fs-6">{{ $data->description }}</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->






        <div class="d-flex flex-column">
            <h2 class="mb-1">Warmup Videos</h2>

            @foreach ($videos as $lm)

            <div class="warmupvideo-container">

                <img src="{{  $lm->thumbnail }}" class=" mt-3  w-100 h-80 warmupvideo-image" />

                <div class="warmupvideo-overlay"></div>
                <a href="{{ $lm->video_url }}" target="_blank">
                <div class="warmupvideo-button"><img src="{{asset('assets/media/sample/video-play-icon.png')}}" class="warmupvideo-text" alt="">
                </div></a>
              </div>
              @endforeach

        </div>
    </div>


</div>
<!--end::Card body-->
</div>
