@extends('layouts.app')

@section('title', 'Exhibitor Services List')

@section('content')

    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xxl-12">
                        <h5 class="mb-3"></h5>
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active"
                                            href="{{ route('exhibitor_services.exhibitor_details') }}" role="tab">
                                            Exhibitor Details <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" href="{{ route('exhibitor_services.exhibitor_lanyard') }}"
                                            role="tab">
                                            Exhibitors Lanyard <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" href="{{ route('exhibitor_services.additional_furniture') }}"
                                            role="tab">
                                            Additional Furniture <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" href="{{ route('exhibitor_services.exhibitorvendor') }}"
                                            role="tab">
                                            Exhibition Vendor <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>

                                </ul>

                                <div class=" mb-4 mt-5">
                                    <!-- Page Heading -->
                                    <div class="card mb-0 mt-0">
                                        <div class="card-body">
                                            <form method="post" id="form"
                                                action="{{ route('exhibitor_services.exhibitor_details') }}">
                                                @csrf
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-md-4">
                                                        <div class="d-flex align-items-center">
                                                            <input placeholder="Company Name" type="text"
                                                                class="form-control" name="companyname" autocomplete="off"
                                                                value="<?= isset($CompanyName) ? $CompanyName : '' ?>">

                                                            <input type="submit" id="search"
                                                                class="btn btn-primary mx-2" name="search" title="Search"
                                                                value="Search">

                                                            <a class="btn btn-primary"
                                                                href="{{ route('exhibitor_services.exhibitor_details') }}">
                                                                Cancel
                                                            </a>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="input-group" style="justify-content: right;">
                                                            <a
                                                                href="{{ route('exhibitor_services.exhibitor_details_Excel', $CompanyName ?? 0) }}">
                                                                <i class="fa-solid fa-file-csv fa-bounce fa-2xl"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="PendingOrder" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">

                                                            <table id="scroll-horizontal" class="table nowrap align-middle"
                                                                style="width:200%">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th width="8%">Company Name</th>
                                                                        <th width="8%">Contact Person </th>
                                                                        <th scope="col">Mobile</th>
                                                                        <th scope="col">Email</th>
                                                                        <th scope="col">City</th>
                                                                        <th width="5%">Stall No </th>
                                                                        <th width="15%">Name Facia
                                                                            On Stall</th>
                                                                        <th width="15%">Name On Participant Certificate
                                                                        </th>
                                                                        <th scope="col">My GST No. </th>
                                                                        <th width="15%">Invitation Card Require </th>
                                                                        <th width="15%">Company Name On Lanyard</th>
                                                                        <th scope="col">Action</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>
                                                                    @foreach ($Exhibitor as $Exhibitors)
                                                                        <tr>
                                                                            <td>{{ $i + $Exhibitor->perPage() * ($Exhibitor->currentPage() - 1) }}
                                                                            </td>
                                                                            <td>{{ $Exhibitors->strCompany }}</td>
                                                                            <td>{{ $Exhibitors->strContactPerson }}</td>
                                                                            <td>{{ $Exhibitors->Mobile }}</td>
                                                                            <td>{{ $Exhibitors->strEmail }}</td>
                                                                            <td>{{ $Exhibitors->strCity }}</td>
                                                                            <td>{{ $Exhibitors->strStallNo }}</td>
                                                                            <td>{{ $Exhibitors->strFasciaName }}</td>
                                                                            <td>{{ $Exhibitors->strParticipantCertificateName }}
                                                                            </td>
                                                                            <td>{{ $Exhibitors->txtGSTIN }}</td>
                                                                            <td>{{ $Exhibitors->iInviteesRequired }}</td>
                                                                            <td>{{ $Exhibitors->strCompany }}</td>
                                                                            <td>
                                                                                <?php //if($_SESSION['isSuperAdmin'] == 1){
                                                								    if ($Exhibitors->isPaymentReceived == 0) { ?>
                                                                                <a class="mx-1"
                                                                                    onClick="javascript: return isPaymentReceived('PaymentReceived','<?php echo $Exhibitors->id; ?>');"
                                                                                    title="Payment Received">
                                                                                    <i class="fa-solid fa-check"></i>
                                                                                </a>
                                                                                <?php } else { ?>
                                                                                <a class="mx-1"
                                                                                    onClick="javascript: return isPaymentReceived('PaymentRecalled','<?php echo $Exhibitors->id; ?>');"
                                                                                    title="Cancelled Payment">
                                                                                    <i class="fa-solid fa-times"
                                                                                        aria-hidden="true"></i>
                                                                                </a>
                                                                                <?php }
                                                								//} ?>

                                                                                <a class="mx-1" target="_blank"
                                                                                    href="{{ route('exhibitor_services.Participation_LetterPDF', $Exhibitors->id) }}"
                                                                                    title="Participation Letter">
                                                                                    <i
                                                                                        class="fa-solid fa-address-card fa-lg"></i>
                                                                                </a>
                                                                                <a class="mx-1" target="_blank"
                                                                                    href="{{ route('exhibitor_services.Transportation_LetterPDF', $Exhibitors->id) }}"
                                                                                    title="Transportation Letter">
                                                                                    <i class="fa-solid fa-truck fa-lg"></i>
                                                                                </a>
                                                                                <?php if ($Exhibitors->isPaymentReceived == 1) { ?>
                                                                                <a class="mx-1" target="_blank"
                                                                                    href="{{ route('exhibitor_services.noDue_LetterPDF', $Exhibitors->id) }}"
                                                                                    title="No Due Letter">
                                                                                    <i class="fa-solid fa-inr"
                                                                                        aria-hidden="true"></i>
                                                                                </a>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $i++; ?>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
                                                            <div class="d-flex justify-content-center mt-3">
                                                                {{ $Exhibitor->appends(request()->except('page'))->links() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div>
                    </div>
                    <!--end col-->
                </div>

            </div>
        </div>
    </div>

    <script>
        function isPaymentReceived(action, id) {
            var msg = "";
            if (action == "PaymentReceived") {
                msg = "Are you sure for payment received?";
            } else {
                msg = "Are you sure for cancelled payment?"
            }
            if (confirm(msg)) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('exhibitor_services.isPaymentReceived') }}",
                    data: {
                        action: action,
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href = '';
                        return false;
                    }
                });
            }
        }
    </script>
@endsection
