@extends('layouts.user')

@section('title', 'Edit Profile')

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')


                <div class="position-relative mx-n4 mt-n4">
                    <div class="profile-wid-bg profile-setting-img">
                        <img src="{{ asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl-3">
                        <div class="card mt-n5">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <img src="{{ asset('assets/images/users/undraw_profile.webp') }}"
                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                            alt="user-profile-image">
                                    </div>
                                    <h5 class="mb-1">{{ $ExhibitorUser->strContactPerson }}</h5>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->

                    <div class="col-xxl-9">
                        <div class="card mt-xxl-n5">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                            role="tab">
                                            <i class="fas fa-home"></i> Personal Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                            <i class="far fa-user"></i> Change Password
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        <form action="{{ route('User.profileupdate') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">Name</label>
                                                        <input type="text"
                                                            class="form-control @error('strContactPerson') is-invalid @enderror"
                                                            name="strContactPerson" placeholder="Enter Name"
                                                            value="{{ $ExhibitorUser->strContactPerson }}"
                                                            autocomplete="off" required>

                                                        @error('strContactPerson')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="phonenumberInput" class="form-label">Mobile</label>
                                                        <input type="text"
                                                            class="form-control @error('Mobile') is-invalid @enderror"
                                                            placeholder="Enter Mobile" name="Mobile"
                                                            value="{{ $ExhibitorUser->Mobile }}" autocomplete="off"
                                                            required>

                                                        @error('Mobile')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Email</label>
                                                        <input type="email" name="strEmail"
                                                            class="form-control  @error('strEmail') is-invalid @enderror"
                                                            id="emailInput" placeholder="Enter your Email"
                                                            value="{{ $ExhibitorUser->strEmail }}" autocomplete="off"
                                                            required>

                                                        @error('strEmail')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-primary">Updates</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <form action="{{ route('User.changepassword') }}" method="POST">
                                            @csrf
                                            <div class="row g-2" style="align-items: end;">
                                                <div class="col-lg-3">
                                                    <div>
                                                        <label for="oldpasswordInput" class="form-label">Old
                                                            Password*</label>
                                                        <input type="password" name="current_password"
                                                            class="form-control @error('current_password') is-invalid @enderror"
                                                            id="oldpasswordInput" placeholder="Enter current password"
                                                            required>
                                                        @error('current_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div>
                                                        <label for="newpasswordInput" class="form-label">New
                                                            Password*</label>
                                                        <input type="password"
                                                            class="form-control @error('new_password') is-invalid @enderror"
                                                            required name="new_password"id="newpasswordInput"
                                                            placeholder="Enter new password">
                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div>
                                                        <label for="confirmpasswordInput" class="form-label">Confirm
                                                            Password*</label>
                                                        <input type="password"
                                                            class="form-control @error('new_confirm_password') is-invalid @enderror"
                                                            name="new_confirm_password" required id="confirmpasswordInput"
                                                            placeholder="Confirm password">
                                                        @error('new_confirm_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-success">Change
                                                            Password</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                    <!--end tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div><!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> {{ env('APP_NAME') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->
@endsection
