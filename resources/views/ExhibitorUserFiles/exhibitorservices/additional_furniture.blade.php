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
                            <div class="card-body  mt-90">

                                @include('ExhibitorUserFiles.exhibitorservices.exhibitorTab')

                                <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" href="{{ route('User.AdditionalFurnitureList') }}"
                                            role="tab">
                                            Additional Furniture <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" href="{{ route('User.AdditionalFurniture') }}"
                                            role="tab">
                                            Furniture Selected <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                </ul>

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
                                                                            <th class="all">Sr.No</th>
                                                                            <th class="all">Furniture</th>
                                                                            <th class="all">Qty</th>
                                                                            <th class="all">Rate</th>
                                                                            <th class="all">Amount</th>
                                                                            <th class="all">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $i = 1;
                                                                        $TotalAmount = 0;
                                                                        ?>
                                                                        @foreach ($datas as $data)
                                                                            <tr>
                                                                                <td style="text-align: center">
                                                                                    {{ $i }}</td>
                                                                                <td>{{ $data->strFurnitureName }}</td>
                                                                                <td style="text-align: center">
                                                                                    {{ $data->iQty }}</td>
                                                                                <td style="text-align: center">
                                                                                    {{ $data->iRate }}</td>
                                                                                <td style="text-align: center">
                                                                                    {{ $data->iAmount }}
                                                                                    <?php
                                                                                    $TotalAmount += $data->iAmount;
                                                                                    ?>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <a class="mx-1" href="#"
                                                                                        data-bs-toggle="modal"
                                                                                        title="Delete"
                                                                                        data-bs-target="#deleteRecordModal"
                                                                                        onclick="deleteData(<?= $data->iAdditionalFurnitureId ?>);">
                                                                                        <i class="fa fa-trash"
                                                                                            aria-hidden="true">
                                                                                        </i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $i++; ?>
                                                                        @endforeach

                                                                        <thead class="tbg">
                                                                            <tr>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th>Total</th>
                                                                                <th>{{ $TotalAmount }}</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                    </tbody>

                                                                </table>
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    {{ $datas->links() }}
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
                            </div><!-- end card-body -->
                        </div>
                    </div>
                    <!--end col-->
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record
                                ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                            Yes,
                            Delete It!
                        </a>
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <form id="user-delete-form" method="POST"
                            action="{{ route('User.AdditionalFurnituredelete', $data->iAdditionalFurnitureId ?? '') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="iAdditionalFurnitureId" id="deleteid" value="">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
@endsection


@section('scripts')
    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>
@endsection
