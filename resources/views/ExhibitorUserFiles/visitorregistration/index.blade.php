@extends('layouts.user')
@section('title', 'Visitor Registration List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row mt-90">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Registration </h4>
                            <button type="button" class="btn btn-success btn-user" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="fa-solid fa-plus fa-beat fa-lg"></i> New
                                Registration</button>
                        </div>
                    </div>
                </div>

                <div id="exampleModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel"
                    style="display: none;" aria-hidden="true">

                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add User Visitor Registration</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form onsubmit="return formsubmit()" action="{{ route('User.visitorregistrationstore') }}"
                                method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div>
                                                <span style="color:red;">*</span>Name
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Name" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div>
                                                <span style="color:red;">*</span>Company Name
                                                <input type="text" class="form-control" name="companyName"
                                                    autocomplete="off" placeholder="Enter Company Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div>
                                                <span style="color:red;">*</span>Email
                                                <input type="email" class="form-control" name="email" autocomplete="off"
                                                    placeholder="Enter Email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div>
                                                <span style="color:red;">*</span>Mobile
                                                <input type="text" class="form-control" name="mobile" autocomplete="off"
                                                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                    onchange="chkMobile();" id="mobile" placeholder="Enter Mobile"
                                                    maxlength="10" minlength="10" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
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
                                                <!--<select onchange="getCityName();" class="form-control" name="state"-->
                                                <!--    id="state" required>-->
                                                <!--    <option selected disabled value="">Select State</option>-->
                                                <!--    @foreach ($states as $state)-->
                                                <!--        <option value="{{ $state->stateName }}">{{ $state->stateName }}-->
                                                <!--        </option>-->
                                                <!--    @endforeach-->
                                                <!--</select>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div>
                                                <span style="color:red;">*</span>City
                                                <select class="form-control" name="city" id="city" required>
                        <option value="">Select City</option>
                    </select>
                                                <!--<select class="form-control" name="city" id="city" required>-->
                                                <!--    <option selected value="">Select City</option>-->

                                                <!--</select>-->
                                                <!--<input type="text" class="form-control" name="city" autocomplete="off"-->
                                                <!--    placeholder="Enter City" required>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div>
                                                <span style="color:red;">*</span>Select Visit Date
                                                <div class="contact_form_inp_2_checkbox thirty-sep mt-3">
                                                    <input type="checkbox" name="visitDate" id="visitDate1"
                                                        value="{{ config('app.visitor_date1') }}"> {{ config('app.visitor_date1') }}
                                                </div><br>
                                                <div class="contact_form_inp_2_checkbox first-oct">
                                                    <input type="checkbox" name="visitDate" id="visitDate2"
                                                        value="{{ config('app.visitor_date2') }}"> {{ config('app.visitor_date2') }}
                                                </div><br>
                                                <div class="contact_form_inp_2_checkbox second-oct">
                                                    <input type="checkbox" name="visitDate" id="visitDate3"
                                                        value="{{ config('app.visitor_date3') }}"> {{ config('app.visitor_date3') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-3" style="margin-top: 18px">
                                            <div>
                                                <span style="color:red;">*</span>I Am Interested In
                                                <select class="form-select" name="interested" id="interested" required>
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

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-success btn-user float-right">Save</button>
                                            <a class="btn btn-primary float-right mr-3"
                                                href="{{ route('User.visitorregistration') }}">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">List Of User Registration</h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="scroll-horizontal table-responsive" class="table nowrap align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="all">Sr.No</th>
                                            <th class="all">Visit Id</th>
                                            <th class="all">Name</th>
                                            <th class="all">CompanyName</th>
                                            <th class="all">Email</th>
                                            <th class="all">Mobile </th>
                                            <th class="all">State</th>
                                            <th class="all">City</th>
                                            <th class="all">VisitDate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($Data as $data)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $data->earthconId }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->companyName }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->mobile }}</td>
                                                <td>{{ $data->state }}</td>
                                                <td>{{ $data->city }}</td>
                                                <td>{{ $data->visitDate }}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $Data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $("#visitDate1").on('click', function() {
            if ($(this).is(':checked')) {

                $("#timeSlot1").attr('disabled', false);
                $("#timeSlot2").attr('disabled', true);

                $("#visitDate2").prop('checked', false);
                $("#visitDate3").prop('checked', false);

                $("#timeSlot3").attr('disabled', true);
            } else {
                $("#timeSlot1").attr('disabled', true);
                $("#timeSlot2").attr('disabled', true);
                $("#timeSlot3").attr('disabled', true);
            }
        });

        $("#visitDate2").on('click', function() {
            if ($(this).is(':checked')) {
                $("#timeSlot1").attr('disabled', true);
                $("#timeSlot2").attr('disabled', false);
                $("#visitDate1").prop('checked', false);
                $("#visitDate3").prop('checked', false);
                $("#timeSlot3").attr('disabled', true);
            } else {
                $("#timeSlot1").attr('disabled', true);
                $("#timeSlot2").attr('disabled', true);
                $("#timeSlot3").attr('disabled', true);
            }
        });

        $("#visitDate3").on('click', function() {
            if ($(this).is(':checked')) {
                $("#timeSlot1").attr('disabled', true);
                $("#timeSlot2").attr('disabled', true);
                $("#visitDate1").prop('checked', false);
                $("#visitDate2").prop('checked', false);
                $("#timeSlot3").attr('disabled', false);
            } else {
                $("#timeSlot1").attr('disabled', true);
                $("#timeSlot2").attr('disabled', true);
                $("#timeSlot3").attr('disabled', true);
            }
        });
        $("#timeSlot1").on("change", function() {
            var timeSlot1 = $(this).val();
            if (timeSlot1 == "04.00 Onwards No registration") {
                $("#submit").hide();
            } else {
                $("#submit").show();
            }
        });

        $("#timeSlot2").on("change", function() {
            var timeSlot2 = $(this).val();
            if (timeSlot2 == "04.00 Onwards No registration") {
                $("#submit").hide();
            } else {
                $("#submit").show();
            }
        });

        $("#timeSlot3").on("change", function() {
            var timeSlot3 = $(this).val();
            if (timeSlot3 == "04.00 Onwards No registration") {
                $("#submit").hide();
            } else {
                $("#submit").show();
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

    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('User.refresh_captcha') }}",
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

    <script>
        function chkMobile() {
            var mobile = $('#mobile').val();
            var url = "{{ route('User.visitorregistrationcheckmobile') }}";
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

    <script>
        function getCityName() {
            var state = $("#state").val();
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
                }
            });
        }
    </script>
@endsection
