@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">



        <div class="page-content">
            {{-- Alert Messages --}}
            @include('common.alert')
            <div class="container-fluid">


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
                                    <h5 class="mb-1">{{ auth()->user()->full_name }}</h5>
                                    <p class="text-muted mb-0">
                                        {{ auth()->user()->roles ? auth()->user()->roles->pluck('name')->first() : 'N/A' }}
                                    </p>
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
                                        <form action="{{ route('profile.update') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">First
                                                            Name</label>
                                                        <input type="text"
                                                            class="form-control @error('first_name') is-invalid @enderror"
                                                            name="first_name" id="firstnameInput"
                                                            placeholder="Enter your firstname"
                                                            value="{{ old('first_name') ? old('first_name') : auth()->user()->first_name }}"
                                                            autocomplete="off" required maxlength="25">

                                                        @error('first_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="lastnameInput" class="form-label">Last
                                                            Name</label>
                                                        <input type="text"
                                                            class="form-control @error('last_name') is-invalid @enderror"
                                                            id="lastnameInput" name="last_name"
                                                            placeholder="Enter your lastname"
                                                            value="{{ old('last_name') ? old('last_name') : auth()->user()->last_name }}"
                                                            autocomplete="off" required maxlength="25">

                                                        @error('last_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="phonenumberInput" class="form-label">Phone
                                                            Number</label>
                                                        <input type="text"
                                                            class="form-control @error('mobile_number') is-invalid @enderror"
                                                            id="phonenumberInput" placeholder="Enter your phone number"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                            maxlength="10" minlength="10" name="mobile_number"
                                                            value="{{ old('mobile_number') ? old('mobile_number') : auth()->user()->mobile_number }}"
                                                            autocomplete="off" required>

                                                        @error('mobile_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Email
                                                            Address</label>
                                                        <input type="email" name="email"
                                                            class="form-control  @error('email') is-invalid @enderror"
                                                            id="emailInput" placeholder="Enter your email"
                                                            value="{{ old('email') ? old('email') : auth()->user()->email }}"
                                                            autocomplete="off" required maxlength="50">

                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <form action="{{ route('profile.change-password') }}" method="POST">
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
                                                            placeholder="Enter new password" minlength="5"
                                                            maxlength="20">
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
                                                            minlength="5" maxlength="20" placeholder="Confirm password">
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
            <div class="container">
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
