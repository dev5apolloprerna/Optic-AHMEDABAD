@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit User</h4>
                            <div class="page-title-right">
                                <a href="{{ route('users.index') }}"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="live-preview">
                                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gy-4">
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Company Name
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Company Name" name="strCompany"
                                                        autocomplete="off" value="{{ $user->strCompany }}" required
                                                        maxlength="255">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>Contact Person
                                                    <input type="text" class="form-control" name="strContactPerson"
                                                        autocomplete="off" value="{{ $user->strContactPerson }}"
                                                        placeholder="Enter Contact Person" maxlength="255">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Mobile
                                                    <input type="text" class="form-control"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        id="mobile" onblur="chkMobile();" autocomplete="off"
                                                        name="Mobile" value="{{ $user->Mobile }}" minlength="10"
                                                        maxlength="10" placeholder="Enter Mobile" required>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>Email
                                                    <input type="email" class="form-control" placeholder="Enter Email"
                                                        autocomplete="off" name="strEmail" value="{{ $user->strEmail }}"
                                                        maxlength="50">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>City
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="Enter City" name="strCity" maxlength="25"
                                                        autocomplete="off" value="{{ $user->strCity }}">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Stall No.
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="Enter Stall No." name="strStallNo" maxlength="25"
                                                        autocomplete="off" value="{{ $user->strStallNo }}" required>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>Stall Size
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="Enter Stall Size" name="strStallSize" maxlength="25"
                                                        autocomplete="off" value="{{ $user->strStallSize }}">
                                                </div>
                                            </div>
                                            <!--end col-->

                                        </div>
                                        <div class="card-footer mt-5" style="float: right;">
                                            <button type="submit"
                                                class="btn btn-success btn-user float-right mb-3">Update</button>
                                            <a class="btn btn-primary float-right mr-3 mb-3"
                                                href="{{ route('users.index') }}">Cancel</a>
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function chkMobile() {
            //alert(id);
            var mobile = $('#mobile').val();
            var url = "{{ route('users.editmobilecheck') }}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    mobile,
                    mobile
                },
                success: function(data) {
                    console.log(data);
                    var obj = JSON.parse(data);
                    if (data == 1) {

                        alert('Mobile No Already Exist');
                        $('#mobile').val('');
                        $('#mobile').focus();

                        return false;
                    }
                }
            });

        }
    </script>
@endsection
