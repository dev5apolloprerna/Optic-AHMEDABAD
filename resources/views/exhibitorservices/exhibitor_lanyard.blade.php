@extends('layouts.app')

@section('title', 'Exhibitor Services List')

@section('content')


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
                                        <a class="nav-link" href="{{ route('exhibitor_services.exhibitor_details') }}"
                                            role="tab">
                                            Exhibitor Details <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active"
                                            href="{{ route('exhibitor_services.exhibitor_lanyard') }}" role="tab">
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

                                <div class="container-fluid mb-0 mt-0">
                                    <!-- Page Heading -->
                                    <div class="card mb-0 mt-0">
                                        <div class="card-body">
                                            <form method="post" id="form"
                                                action="{{ route('exhibitor_services.exhibitor_lanyard') }}">
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
                                                                href="{{ route('exhibitor_services.exhibitor_lanyard') }}">
                                                                Cancel
                                                            </a>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="input-group" style="justify-content: right;">
                                                            <a
                                                                href="{{ route('exhibitor_services.exhibitor_lanyard_Excel', $CompanyName ?? 0) }}">
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
                                                                style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%">No</th>
                                                                        <th width="6%">Company Name</th>
                                                                        <th width="50%">Contact Person </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>
                                                                    @foreach ($Exhibitor as $Exhibitors)
                                                                        <tr>
                                                                            <td>{{ $i + $Exhibitor->perPage() * ($Exhibitor->currentPage() - 1) }}
                                                                            </td>
                                                                            <td>{{ $Exhibitors->strCompany }}</td>
                                                                            <td>
                                                                                <table
                                                                                    class="table table-striped table-bordered table-hover dt-responsive"
                                                                                    width="100%">
                                                                                    <thead class="tbg">
                                                                                        <tr>
                                                                                            <th width="20%"
                                                                                                class="all">Member Name
                                                                                            </th>
                                                                                            <th width="20%"
                                                                                                class="all">Member Mobile
                                                                                            </th>
                                                                                            <th width="20%"
                                                                                                class="all">Company Name On Lanyard
                                                                                            </th>
                                                                                            <th width="20%"
                                                                                                class="all">City</th>
                                                                                            <th width="20%"
                                                                                                class="all">Entry Date</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $ExhibitorBatch = App\Models\ExhibitBatch::orderBy('iExhibitBatchId', 'desc')
                                                                                            ->where(['iStatus' => 1, 'isDelete' => 0, 'iCompayId' => $Exhibitors->id])
                                                                                            ->get();

                                                                                        ?>
                                                                                        @foreach ($ExhibitorBatch as $rows)
                                                                                            <tr>
                                                                                               <th class="all">
                                                                                                    {{ $rows->strMemberName ? ucwords(strtolower($rows->strMemberName)) : '-' }}
                                                                                                </th>
                                                                                                <th class="all">
                                                                                                    {{ $rows->iMemberMobile ?? "-" }}
                                                                                                </th>
                                                                                                <th class="all">
                                                                                                    {{ $rows->strCompanyBrandNameOnLanyard ? ucwords(strtolower($rows->strCompanyBrandNameOnLanyard)) : '-' }}
                                                                                                </th>
                                                                                                <th class="all">
                                                                                                    {{ $rows->strCity ?? "-" }}
                                                                                                </th>
                                                                                                <th class="all">
                                                                                                    {{ $rows->strEntryDate ?? "-" }}
                                                                                                </th>
                                                                                            </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
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
@endsection
