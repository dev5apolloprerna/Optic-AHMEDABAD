@extends('layouts.app')

@section('title', 'Add Visitor Registration')

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
                            <div class="card-header" style="display: flex;justify-content: space-between;">
                                <h5 class="card-title mb-0">Add Visitor Registration</h5>
                                <div class="page-title-right">
                                    <a href="{{ route('employees_module.index') }}"
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
                                    <form onsubmit="return formsubmit()" method="POST" action="{{ route('employees_module.store') }}" >
                                        @csrf
                                        <div class="row gy-4">
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Name
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Name" name="name"
                                                        autocomplete="off" value="{{ old('name') }}" required autofocus>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;"></span>Email
                                                    <input type="text" class="form-control" name="email"
                                                        autocomplete="off" value="{{ old('email') }}"
                                                        placeholder="Enter Email" required>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Mobile
                                                    <input type="text" class="form-control"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                                        id="mobile" onblur="chkMobile();" autocomplete="off"
                                                        name="mobile" value="{{ old('mobile') }}" minlength="10"
                                                        maxlength="10" placeholder="Enter Mobile" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Company Name
                                                    <input type="text" class="form-control" name="companyName"
                                                        autocomplete="off" value="{{ old('companyName') }}"
                                                        placeholder="Enter Company Name" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>State
                                                    
                                                    <select class="form-control" name="state" id="state" onchange="getCityName()" required>
                                                        <option value="">Select State</option>
                                                        
                                                        @foreach ($states as $state)
                                                        <option value="{{ $state->stateId }}">
                                                        {{ $state->stateName }}
                                                        </option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    
                                                <!--    <select onchange="getCityName();" class="form-control" name="state" id="state" required>-->
                                                <!--    <option selected value="">Select State</option>-->
                                                <!--    @foreach ($states as $state)-->
                                                <!--        <option value="{{ $state->stateName }}" {{ old('state') == $state->stateName ? 'selected' : '' }}>{{ $state->stateName }}-->
                                                <!--        </option>-->
                                                <!--    @endforeach-->
                                                <!--</select>-->
                                                </div>
                                                
                                                <input type="text" class="form-control" name="otherstate" id="otherstate" autocomplete="off"
                                                    style="display: none;" placeholder="State*"  autocomplete="off"
                                                    value="{{ old('otherstate') }}">
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>City
                                                    <select class="form-control" name="city" id="city" required>
                        <option value="">Select City</option>
                    </select>
                                                    <!--<input type="text" class="form-control" name="city" id="city" -->
                                                    <!--     placeholder="City*"  autocomplete="off"-->
                                                    <!--    value="{{ old('city') }}" required>-->
                                                    <!--<select class="form-control" name="city" id="city" required>-->
                                                    <!--    <option selected  value="">Select City</option>-->
                                                        
                                                    <!--</select>-->
                                                </div>
                                                
                                                <input type="text" class="form-control" name="othercity" id="othercity" 
                                                    style="display: none;" placeholder="City*"  autocomplete="off"
                                                    value="{{ old('othercity') }}"> 
                                            </div>
                                            <!--end col-->
                                            
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <input style="width:16px" type="checkbox" name="visitDate" id="visitDate1"
                                                    value="{{ config('app.visitor_date1') }}" {{ old('visitDate') == config('app.visitor_date1') ? 'checked' : '' }}>
                                                    {{ config('app.visitor_date1') }}
                                                    
                                                </div>
                                               
                                            </div>
                                            <!--end col-->
                                            
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <input style="width:16px" type="checkbox" name="visitDate" id="visitDate2"
                                                    value="{{ config('app.visitor_date2') }}" {{ old('visitDate') == config('app.visitor_date2') ? 'checked' : '' }}>
                                                    {{ config('app.visitor_date2') }}
                                                    
                                                </div>
                                               
                                            </div>
                                            <!--end col-->
                                            
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <input style="width:16px" type="checkbox" name="visitDate" id="visitDate3"
                                                    value="{{ config('app.visitor_date3') }}" {{ old('visitDate') == config('app.visitor_date3')  ? 'checked' : '' }}>
                                                    {{ config('app.visitor_date3') }}
                                                    
                                                </div>
                                               
                                            </div>
                                            <!--end col-->
                                            
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>I am interested in
                                                    <select class="form-control" name="interested" id="interested" class="w-100" required> 
                                                        <option value="Eyewear Frames">Eyewear Frames</option>
                                                        <option value="Sunglasses">Sunglasses</option>
                                                        <option value="Contact Lenses">Contact Lenses</option>
                                                        <option value="Spectacle lenses">Spectacle lenses</option>
                                                        <option value="Eye Testing Equipments">Eye Testing Equipments</option>
                                                        <option value="Optical Instruments">Optical Instruments</option>
                                                        <option value="Spectacle Cases">Spectacle Cases</option>
                                                        <option value="Eyewear Packaging">Eyewear Packaging</option>
                                                        <option value="Optical Accessories & Consumables">Optical Accessories & Consumables
                                                        </option>
                                                        <option value="Cleaning Products">Cleaning Products</option>
                                                        <option value="Optical Shop Fitting & Fixtures">Optical Shop Fitting & Fixtures
                                                        </option>
                                                        <option value="Optical Spare Parts">Optical Spare Parts</option>
                                                        <option value="Eyewear Related Softwares & Tech Companies">Eyewear Related
                                                            Softwares & Tech Companies</option>
        
                                                    </select>
                                                </div>
                                            </div>

                                           

                                        </div>
                                        <div class="card-footer mt-5" style="float: right;">
                                            <button type="submit"
                                                class="btn btn-success btn-user float-right mb-3">Save</button>
                                            <a class="btn btn-primary float-right mr-3 mb-3"
                                                href="{{ route('employees_module.index') }}">Cancel</a>
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
function getCityName()
{
    var state = $('#state').val();

    $.ajax({
        url: "{{ route('mappingcity') }}",
        type: "POST",
        data: {
            state: state,
            _token: "{{ csrf_token() }}"
        },
        success: function(result){
            $("#city").html(result);
        }
    });
}
</script>

    <script>
        $("#visitDate1").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate2").prop('checked', false);
                $("#visitDate3").prop('checked', false);
            } 
        });

        $("#visitDate2").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate1").prop('checked', false);
                $("#visitDate3").prop('checked', false);
            }
        });

        $("#visitDate3").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate1").prop('checked', false);
                $("#visitDate2").prop('checked', false);
            }
        });
        
    </script>

    <script>
        function formsubmit() {
            if ($("#visitDate1").is(':checked') || $("#visitDate2").is(':checked') || $("#visitDate3").is(':checked')) {
                return true;
            } else {
                alert('Select visit date');
                return false;
            }
        }
    </script>
    
    <script>
function chkMobile() {
    var Flag = true;
    var mobile = $('#mobile').val();
    var url = "{{ route('FrontVisitor_Registration_checkmobile') }}";
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
                Flag = false;

                return Flag;
            } else {
                Flag = true;
                return Flag;
            }
        }
    });
    return Flag;
}
</script> 
    
    // <script>
    //     function chkMobile() {
    //         //alert(id);
    //         var mobile = $('#mobile').val();

    //         var url = "{{ route('users.mobilecheck') }}";
    //         $.ajax({
    //             url: url,
    //             type: 'GET',
    //             data: {
    //                 mobile,
    //                 mobile
    //             },
    //             success: function(data) {
    //                 console.log(data);
    //                 var obj = JSON.parse(data);
    //                 if (data == 1) {

    //                     alert('Mobile No Already Exist');
    //                     $('#mobile').val('');
    //                     $('#mobile').focus();

    //                     return false;
    //                 }
    //             }
    //         });

    //     }
    // </script>

    <script>
        
        function getCityName() {
            var state = $("#state").val();

            if (state === "Other") {
                $("#state").hide();
                $("#state").attr('required', false);
                $("#city").hide();
                $("#city").attr('required', false);
                $("#otherstate").show();
                $("#otherstate").attr('required', true);
                $("#othercity").show();
                $("#othercity").attr('required', true);
            } else {
                var url = "{{ route('mappingcity', ':state') }}";
                url = url.replace(":state", state);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        state: state,
                    },
                    success: function(data) {
                        $("#city").html('');
                        $("#city").append(data);
                        $("#state").show();
                        $("#state").attr('required', true);
                        $("#city").show();
                        $("#city").attr('required', true);
                        $("#otherstate").hide();
                        $("#otherstate").attr('required', false);
                        $("#othercity").hide();
                        $("#othercity").attr('required', false);
                        // otherOption();
                    }
                });
            }
        }
    </script>
    
    <script>
    window.onload = function() {
        const oldCity = "{{ old('city') }}";
        if (oldCity) {
            const citySelect = document.getElementById('city');
            const option = document.createElement('option');
            option.value = oldCity;
            option.text = oldCity;
            option.selected = true;
            citySelect.appendChild(option);
        }
    }
</script>

    <script>
        function validateData() {
            var form_submit = formsubmit();
            //alert(form_submit);
            var chk_Mobile = chkMobile();

            if (form_submit == true && chk_Mobile == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
