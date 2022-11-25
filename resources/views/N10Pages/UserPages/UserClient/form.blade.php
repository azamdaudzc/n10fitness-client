<div class="card ">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
    </div>
    <div class="card-body py-5">
        <form method="POST" id="crud-form" action="{{ route('user.client.store') }}" role="form"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if ($user)
                <input type="hidden" name="id" value="{{ $user->id }}">
            @endif
            <div class="fv-row mb-7">
                <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                <style>
                    .image-input-placeholder {
                        background-image: url('assets/media/svg/files/blank-image.svg');
                    }

                    [data-theme="dark"] .image-input-placeholder {
                        background-image: url('assets/media/svg/files/blank-image-dark.svg');
                    }
                </style>
                <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                    <div class="image-input-wrapper w-125px h-125px"
                        @if ($user->avatar != null) style="background-image: url('{{ $user->avatar }}');"@else style="background-image: url('{{ asset('assets/media/svg/files/blank-image-dark.svg') }}')" @endif>
                    </div>
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <input type="file" id="imgInp" name="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" id="avatar_removed" />
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <span
                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow remove-avatar-button"
                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                </div>
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>

            </div>

            <div class="mb-10">
                <label for="first_name" class="form-label">First Name</label>
                <input class="form-control" placeholder="First Name" name="first_name" type="text" id="first_name"
                    value="{{ @$user->first_name }}">
            </div>

            <div class="mb-10">
                <label for="last_name" class="form-label">Last Name</label>
                <input class="form-control" placeholder="Last Name" name="last_name" type="text" id="last_name"
                    value="{{ $user->last_name }}">
            </div>

            <div class="mb-10">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" placeholder="Email" name="email" type="text" id="email"
                    value="{{ $user->email }}">
            </div>

            <div class="mb-10">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" placeholder="password" name="password" type="password" value=""
                    id="password" autocomplete="new-password">
            </div>

            <div class="mb-10">
                <label for="age" class="form-label">Age</label>
                <input class="form-control" placeholder="age" name="age" type="number" value="{{ $user->age }}"
                    id="age">
            </div>

            <div class="mb-10">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select select-2-setup" data-control="select2"
                    data-placeholder="Select A Gender">
                    <option></option>
                    <option value="male" @if ($user->gender == 'male') selected @endif>Male</option>
                    <option value="female" @if ($user->gender == 'female') selected @endif>Female</option>
                    <option value="other" @if ($user->gender == 'other') selected @endif>Other</option>
                </select>
            </div>


            <div class="mb-10">
                <label for="height" class="form-label">Height</label>
                <input class="form-control" placeholder="height" name="height" type="number"
                    value="{{ $user->height }}" id="height">
            </div>

            <div class="mb-10">
                <label for="athletic_type" class="form-label">Athletic Type</label>
                <select name="athletic_type" id="athletic_type" class="form-select select-2-setup"
                    data-control="select2" data-placeholder="Select An Athletic Type">
                    <option></option>
                    @foreach ($athletic_types as $at)
                        <option value="{{ $at->id }}" @if ($user->athletic_type == $at->id) selected @endif>
                            {{ $at->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-10">
                <label for="phone" class="form-label">Phone</label>
                <input class="form-control" placeholder="Phone" name="phone" type="number" id="phone"
                    value="{{ $user->phone }}">
            </div>

            <input type="hidden" name="is_active" value="1">







            <div class="error-area"></div>
            <div class="box-footer mt20">
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
@section('sub_page_scripts')
    <script type="text/javascript">
        $(function() {
            $('body').on('click', '.remove-avatar-button', function() {
                $('#imgInp').val('');
                $('#avatar_removed').val(1)
                $('.image-input-wrapper').css('background-image',
                    "url('{{ asset('assets/media/svg/files/blank-image-dark.svg') }}')");
            });

            $('body').on('change', '#imgInp', function() {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.image-input-wrapper').css('background-image', "url(" + e.target.result +
                            ")");
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

        });
    </script>
