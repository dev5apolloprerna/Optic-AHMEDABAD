@extends('layouts.app')

@section('title', 'Floor Plan List')

@section('content')


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"
                                style="display: flex;
                            justify-content: space-between;">
                                <h5 class="card-title mb-0">Floor Plan List</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="card">
                        <div class="card-body">
                            <form method="post" id="form" action="{{ route('floor_plan.index') }}">
                                @csrf
                                <div class="row  align-items-center">
                                    <div class="col-md-3  mb-2">
                                        <div class="d-flex align-items-center">
                                            <input placeholder="Enter From Date" type="text" class="form-control"
                                                id="startdatepicker" name="fromdate" autocomplete="off"
                                                value="<?= isset($FromDate) ? $FromDate : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3  mb-2">
                                        <div class="d-flex align-items-center">
                                            <input placeholder="Enter To Date" type="text" class="form-control"
                                                name="todate" autocomplete="off" id="enddatepicker"
                                                value="<?= isset($ToDate) ? $ToDate : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3  mb-2">
                                        <div class="input-group d-flex justify-content-right">
                                            <input type="submit" id="search" class="btn btn-primary mx-2" name="search"
                                                title="Search" value="Search">
                                            <a class="btn btn-primary" href="{{ route('floor_plan.index') }}">
                                                Cancel
                                            </a>
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
                            <div class="card-body">

                                <form role="form" method="POST" action="" name="frmparameter" id="frmparameter"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="form-group row">
                                        <div class="col-md-1">
                                            <input style="display: inline-block;margin-left: 17px;width: 141px;"
                                                id="Btnmybtn" class="btn btn-xs btn-danger mt-2 " onclick="multiDelete()"
                                                value="Delete Selected" name="submit" />
                                        </div>
                                    </div>
                                    <hr />

                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="3%">
                                                    <input type="checkbox" onclick="javascript:CheckAll();"
                                                        id="check_listall" class="md-check" value="">
                                                    <label for="check_listall">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                    </label>

                                                </th>
                                                <th width="1%">No</th>
                                                <th width="10%">Name</th>
                                                <th width="10%">Company</th>
                                                <th width="3%">Email</th>
                                                <th width="1%">Mobile</th>
                                                <th width="10%">Date</th>
                                                <th width="1%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($FloorPlan as $FloorPlans)
                                                <tr class="text-center">
                                                    <td data-label="id">
                                                        <input type="checkbox" name="check_list[]"
                                                            id="check_list<?php echo $i; ?>" class="md-check"
                                                            value="<?php echo $FloorPlans->id; ?>">
                                                        <label for="check_list<?php echo $i; ?>">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span></label>
                                                    </td>
                                                    <td>{{ $i + $FloorPlan->perPage() * ($FloorPlan->currentPage() - 1) }}
                                                    </td>
                                                    <td>{{ ucwords(strtolower($FloorPlans->name)) }}</td>
                                                    <td>{{ ucwords(strtolower($FloorPlans->companyName ?? '-')) }}</td>
                                                    <td>{{ strtolower($FloorPlans->email) }}</td>
                                                    <td>{{ $FloorPlans->mobile }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($FloorPlans->strEntryDate)) }}</td>
                                                    <td>
                                                        <a class="mx-1" href="#" data-bs-toggle="modal"
                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                            onclick="deleteData(<?= $FloorPlans->id ?>);">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $FloorPlan->appends(request()->except('page'))->links() }}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                        <button type="submit" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <form id="user-delete-form" method="POST"
                            action="{{ route('floor_plan.delete') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="deleteid" value="">

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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#startdatepicker").datepicker({
                dateFormat: 'd-m-yy',
                //minDate: 0
            });
        });

        $(function() {
            $("#enddatepicker").datepicker({
                dateFormat: 'd-m-yy',
                //minDate: 0
            });
        });
    </script>

    <script>
        function CheckAll() {
            if ($('#check_listall').is(":checked")) {
                $('input[type=checkbox]').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('input[type=checkbox]').each(function() {
                    $(this).prop('checked', false);
                });
            }
        }
    </script>

    <script>
        function multiDelete() {
            //alert('hello');
            if (confirm('Are You Sure You want to Delete?')) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('floor_plan.deleteselected') }}",
                    data: $('#frmparameter').serialize(),
                    success: function(response) {
                        //alert(response);
                        if (response == 1) {
                            $('#loading').css("display", "none");
                            $("#Btnmybtn").attr('disabled', 'disabled');
                            alert('Floor Plan Deleted Sucessfully.');
                            window.location.href = '';
                        } else {
                            $('#loading').css("display", "none");
                            $("#Btnmybtn").attr('disabled', 'disabled');
                            alert('Something want wrong,Please Try Again.');
                            window.location.href = '';
                        }
                        //return false;
                    }
                });
            }
            //});
            //return false;
        }
    </script>
@endsection
