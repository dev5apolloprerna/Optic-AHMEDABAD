@extends('layouts.user')

@section('title', 'Exhibitor Services List')

@section('content')


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-xxl-12">
                        <h5 class="mb-3"></h5>
                        <div class="card">
                            <div class="card-body mt-90">
                                <!-- Nav tabs -->

                                @include('ExhibitorUserFiles.exhibitorservices.exhibitorTab')

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="live-preview">
                                                    <form onsubmit="return formsubmit()"
                                                        action="{{ route('User.exhibitor_details_store') }}" method="post">
                                                        @csrf
                                                        <div class="row gy-4" style="align-items: end;">
                                                            <div class="col-lg-4 col-md-6">
                                                                <?php //dd(Session::get('strContactPerson'));
                                                                ?>
                                                                <div>
                                                                    <span style="color:red;">*</span>Company Name
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $Data->strCompany ?? '' }}" readonly
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>City
                                                                    <input type="text" class="form-control"
                                                                        name="strCity" value="{{ $Data->strCity ?? '' }}"
                                                                        readonly required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>Mobile
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $Data->Mobile ?? '' }}" name="Mobile"
                                                                        readonly required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>Email
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $Data->strEmail ?? '' }}" name="strEmail"
                                                                        readonly required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>Stall No
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $Data->strStallNo ?? '' }}"
                                                                        name="strStallNo" readonly required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>Name Facia On Stall
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $Data->strFasciaName ?? '' }}"
                                                                        name="strFasciaName" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>Name On Participant
                                                                    Certificate
                                                                    <input type="text" class="form-control"
                                                                        name="strParticipantCertificateName"
                                                                        value="{{ $Data->strParticipantCertificateName ?? '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>My GST No.
                                                                    <input type="text" class="form-control"
                                                                        name="txtGSTIN" id="txtGSTIN" minlength="15"
                                                                        maxlength="15" value="{{ $Data->txtGSTIN ?? '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div>
                                                                    <span style="color:red;">*</span>Invitation Card Require
                                                                    <input type="text" class="form-control"
                                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        name="iInviteesRequired"
                                                                        value="{{ $Data->iInviteesRequired ?? '' }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                                                <button type="submit"
                                                                    class="btn btn-success btn-user float-right">Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        function formsubmit() {
            var gstNumber = $("#txtGSTIN").val();
            gstNumber = gstNumber.toUpperCase();
            var expr = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;

            if (!expr.test(gstNumber)) {
                alert("Invalid GST Number.");
                return false;
            } else {
                return true;
            }
        }
    </script>
@endsection
