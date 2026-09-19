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

                                @include('ExhibitorUserFiles.exhibitorservices.exhibitorTab')

                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="PendingOrder" role="tabpanel">
                                        <div class="row">


                                            @if ($count > 0)

                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table id="scroll-horizontal"
                                                                    class="table nowrap align-middle" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="2%">No</th>
                                                                            <th width="25%">Company Name</th>
                                                                            <th width="25%">Contact Person
                                                                                Name</th>
                                                                            <th width="10%">Mobile</th>
                                                                            <th width="15%">Service</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $i = 1; ?>
                                                                        @foreach ($data as $datas)
                                                                            <tr>
                                                                                <td>{{ $i + $data->perPage() * ($data->currentPage() - 1) }}
                                                                                </td>
                                                                                <td>{{ $datas->strCompanyName }}</td>
                                                                                <td>{{ $datas->strContactPersonName }}
                                                                                </td>
                                                                                <td>{{ $datas->iContactNo }}</td>
                                                                                <td>{{ $datas->strService }}</td>
                                                                            </tr>
                                                                            <?php $i++; ?>
                                                                        @endforeach
                                                                    </tbody>

                                                                </table>
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    {{ $data->links() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div
                                                        class="col-lg-12 col-md-12  col-xs-12 col-sm-12 padding-5 bottom-border-verydark">
                                                        <div
                                                            class="alert alert-info clearfix profile-information padding-all-10 margin-all-0 backgroundDark">
                                                            <h1 class="font-white text-center"> No Data Found ! </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

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

@endsection
