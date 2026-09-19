@extends('layouts.app')

@section('title', 'Add Users')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <!-- start page title -->


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"
                                style="display: flex;
                                    justify-content: space-between;">
                                <h5 class="card-title mb-0">Add User</h5>
                                <div class="page-title-right">
                                    <a href="{{ route('users.index') }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                                    </a>
                                </div>
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
                                    <form method="POST" action="{{ route('users.store') }}">
                                        @csrf
                                        <div class="row gy-4">
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Company Name
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Company Name" name="strCompany"
                                                        autocomplete="off" value="{{ old('strCompany') }}" required
                                                        maxlength="255">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>Contact Person
                                                    <input type="text" class="form-control" name="strContactPerson"
                                                        autocomplete="off" value="{{ old('strContactPerson') }}"
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
                                                        name="Mobile" value="{{ old('Mobile') }}" minlength="10"
                                                        maxlength="10" placeholder="Enter Mobile" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>Email
                                                    <input type="email" class="form-control" placeholder="Enter Email"
                                                        autocomplete="off" name="strEmail" value="{{ old('strEmail') }}"
                                                        maxlength="50">
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>City
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="Enter City" name="strCity" maxlength="25"
                                                        autocomplete="off" value="{{ old('strCity') }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Stall No.
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="Enter Stall No." name="strStallNo" maxlength="25"
                                                        autocomplete="off" value="{{ old('strStallNo') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>Stall Size
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="Enter Stall Size" name="strStallSize" maxlength="25"
                                                        autocomplete="off" value="{{ old('strStallSize') }}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer mt-5" style="float: right;">
                                            <button type="submit"
                                                class="btn btn-success btn-user float-right mb-3">Save</button>
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

            var url = "{{ route('users.mobilecheck') }}";
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
