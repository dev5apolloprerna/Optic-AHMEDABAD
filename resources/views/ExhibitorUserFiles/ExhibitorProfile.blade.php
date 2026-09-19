@extends('layouts.user')

@section('title', 'Profile')

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="page-content">
            <div class="container-fluid">
                <div class="profile-foreground position-relative mx-n4 mt-n4">
                    <div class="profile-wid-bg">
                        <img src="{{ asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
                    </div>
                </div>
                <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                    <div class="row g-4">
                        <div class="col-auto">
                            <div class="avatar-lg">
                                <img src="{{ asset('assets/images/users/undraw_profile.webp') }}" alt="user-img"
                                    class="img-thumbnail rounded-circle" />
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col">
                            <div class="p-2">
                                <h3 class="text-white mb-1">{{ $ExhibitorUser->strContactPerson }}</h3>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="d-flex">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab"
                                            role="tab">
                                            <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                                class="d-none d-md-inline-block">Overview</span>
                                        </a>
                                    </li>

                                </ul>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('User.EditProfile') }}" class="btn btn-success"><i
                                            class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                                </div>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content pt-4 text-muted">
                                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xxl-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">Info</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Name :</th>
                                                                    <td class="text-muted">
                                                                        {{ $ExhibitorUser->strContactPerson }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Mobile :</th>
                                                                    <td class="text-muted">
                                                                        {{ $ExhibitorUser->Mobile }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Email :</th>
                                                                    <td class="text-muted">
                                                                        {{ $ExhibitorUser->strEmail }}
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->




                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>

                            </div>
                            <!--end tab-content-->
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div><!-- container-fluid -->
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
    </div><!-- end main content-->
@endsection
