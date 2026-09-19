@extends('layouts.app')

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
                                        <a class="nav-link" href="{{ route('exhibitor_services.exhibitor_lanyard') }}"
                                            role="tab">
                                            Exhibitors Lanyard <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link " href="{{ route('exhibitor_services.additional_furniture') }}"
                                            role="tab">
                                            Additional Furniture <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" href="{{ route('exhibitor_services.exhibitorvendor') }}"
                                            role="tab">
                                            Exhibition Vendor <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>

                                </ul>

                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="PendingOrder" role="tabpanel">
                                        <div class="row">

                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <h4 class="mb-sm-0">Add Exhibition Vendor
                                                    </h4>
                                                    <div class="card-body">
                                                        <div class="live-preview">
                                                            <form method="POST"
                                                                action="{{ route('exhibitor_services.exhibitorvendorstore') }}">
                                                                @csrf
                                                                <div class="row gy-4">
                                                                    <div>
                                                                        <span style="color:red;">*</span>Company Name
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter Company Name"
                                                                            name="strCompanyName" autocomplete="off"
                                                                            value="{{ old('strCompanyName') }}" required>
                                                                    </div>
                                                                    <div>
                                                                        <span style="color:red;">*</span>Contact Person
                                                                        Name
                                                                        <input type="text" class="form-control"
                                                                            name="strContactPersonName" autocomplete="off"
                                                                            value="{{ old('strContactPersonName') }}"
                                                                            placeholder="Enter Contact Person" required>
                                                                    </div>
                                                                    <div>
                                                                        <span style="color:red;">*</span>Mobile
                                                                        <input type="text" class="form-control"
                                                                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                                            id="mobile" onblur="chkMobile();"
                                                                            autocomplete="off" name="iContactNo"
                                                                            value="{{ old('iContactNo') }}" minlength="10"
                                                                            maxlength="10" placeholder="Enter Mobile"
                                                                            required>
                                                                    </div>
                                                                    <div>
                                                                        <span style="color:red;">*</span>Service
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter Service" autocomplete="off"
                                                                            name="strService"
                                                                            value="{{ old('strService') }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer mt-5" style="float: right;">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-user float-right mb-3">Save
                                                                    </button>
                                                                    <a class="btn btn-primary float-right mr-3 mb-3"
                                                                        href="{{ route('exhibitor_services.exhibitorvendor') }}">Cancel</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($Count > 0)
                                                <div class="col-lg-8">
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
                                                                            <th width="5%">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $i = 1; ?>
                                                                        @foreach ($Exhibitor as $Exhibitors)
                                                                            <tr>
                                                                                <td>{{ $i + $Exhibitor->perPage() * ($Exhibitor->currentPage() - 1) }}
                                                                                </td>
                                                                                <td>{{ $Exhibitors->strCompanyName }}</td>
                                                                                <td>{{ $Exhibitors->strContactPersonName }}
                                                                                </td>
                                                                                <td>{{ $Exhibitors->iContactNo }}</td>
                                                                                <td>{{ $Exhibitors->strService }}</td>
                                                                                <td>
                                                                                    <a class="mx-1" title="Edit"
                                                                                        href="#"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#editModal"
                                                                                        onclick="editData(<?= $Exhibitors->iExhibitionVendor ?>);">
                                                                                        <i class="far fa-edit"></i>

                                                                                    </a>
                                                                                    <a class="mx-1" href="#"
                                                                                        data-bs-toggle="modal"
                                                                                        title="Delete"
                                                                                        data-bs-target="#deleteRecordModal"
                                                                                        onclick="deleteData(<?= $Exhibitors->iExhibitionVendor ?>);">
                                                                                        <i class="fa fa-trash"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
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
                                            @else
                                                <div class="col-lg-8">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div
                                                                class="col-lg-12 col-md-12  col-xs-12 col-sm-12 padding-5 bottom-border-verydark">
                                                                <div
                                                                    class="alert alert-info clearfix profile-information padding-all-10 margin-all-0 backgroundDark">
                                                                    <h1 class="font-white text-center"> No Data Found !
                                                                    </h1>
                                                                </div>
                                                            </div>
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

                <!-- Edit Modal -->
                <div id="editModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Exhibition Vendor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="{{ route('exhibitor_services.exhibitorvendorupdate') }}"
                                class="tablelist-form" autocomplete="off">
                                @csrf
                                <input type="hidden" name="iExhibitionVendor" id="iExhibitionVendor" value="">

                                <div class="modal-body">
                                    <div class="mb-3" id="modal-id" style="display: none;">
                                        <label for="id-field" class="form-label">ID</label>
                                        <input type="text" id="id-field" class="form-control" placeholder="ID"
                                            readonly />
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Company Name
                                        <input type="text" class="form-control" name="strCompanyName"
                                            id="EditstrCompanyName" maxlength="100" placeholder="Enter Ticket Name"
                                            autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Contact Person Name
                                        <input type="text" class="form-control" name="strContactPersonName"
                                            id="EditstrContactPersonName" maxlength="100"
                                            placeholder="Enter Contact Person Name" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Mobile
                                        <input type="text" class="form-control" name="iContactNo"
                                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                            id="EditiContactNo" onblur="EditchkMobile();" minlength="10" maxlength="10"
                                            placeholder="Enter Mobile Number" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Service
                                        <input type="text" class="form-control" name="strService" id="EditstrService"
                                            maxlength="100" placeholder="Enter Service" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Update</button>
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Edit Modal -->

            </div>
        </div>
    </div>

    <!-- Delete Modal -->
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
                            action="{{ route('exhibitor_services.exhibitorvendordelete', $Exhibitors->iExhibitionVendor ?? '') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="deleteid" value="">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Delete Modal -->
@endsection

@section('scripts')
    <script>
        function editData(id) {
            //alert(id);
            var url = "{{ route('exhibitor_services.exhibitorvendoredit', ':id') }}";
            url = url.replace(":id", id);
            if (id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id,
                        id
                    },
                    success: function(data) {
                        console.log(data);
                        var obj = JSON.parse(data);
                        $("#EditstrCompanyName").val(obj.strCompanyName);
                        $("#EditstrContactPersonName").val(obj.strContactPersonName);
                        $("#EditiContactNo").val(obj.iContactNo);
                        $("#EditstrService").val(obj.strService);
                        $('#iExhibitionVendor').val(id);
                    }
                });
            }
        }

        function deleteData(id) {
            $("#iExhibitionVendor").val(id);
        }
    </script>

    <script>
        function chkMobile() {
            //alert(id);
            var mobile = $('#mobile').val();

            var url = "{{ route('exhibitor_services.exhibitorvendormobilecheck') }}";
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
        function EditchkMobile() {
            //alert(id);
            var mobile = $('#EditiContactNo').val();

            var url = "{{ route('exhibitor_services.exhibitorvendormobilecheckEdit') }}";
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
                        $('#EditiContactNo').val('');
                        $('#EditiContactNo').focus();

                        return false;
                    }
                }
            });

        }
    </script>
@endsection
