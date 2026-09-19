@extends('layouts.app')
@section('title', 'Furniture List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Add Furniture</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="live-preview">
                                    <form onsubmit="return validateFile()" action="{{ route('furnituremaster.store') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row gy-4" style="align-items: end;">
                                            <div class="col-lg-3 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Furniture Name
                                                    <input type="text" class="form-control" name="strFurnitureName"
                                                        placeholder="Enter Furniture Name" maxlength="100"
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <!--<div class="col-lg-3 col-md-6">-->
                                            <!--    <div>-->
                                            <!--        <span style="color:red;">*</span>Size-->
                                            <!--        <input type="text" class="form-control" name="strSize"-->
                                            <!--            placeholder="Enter Size" maxlength="100" autocomplete="off"-->
                                            <!--            required>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="col-lg-3 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Rate
                                                    <input type="text" class="form-control" name="iRate"
                                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                        placeholder="Enter Rate" maxlength="100" autocomplete="off"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Photo
                                                    <input type="file" class="form-control" name="strPhoto"
                                                        id="strPhoto" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div id="viewimg">

                                                    </div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success btn-user float-right">Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">List of Furniture</h5>

                                <form method="post" id="form" action="{{ route('furnituremaster.index') }}">
                                    @csrf
                                    <div class="row  align-items-center">
                                        <div class="d-flex align-items-center">
                                            <input placeholder="Enter Furniture Name" type="text"
                                                class="form-control mx-2" name="strFurnitureName" autocomplete="off"
                                                value="<?= isset($FurnitureName) ? $FurnitureName : '' ?>">
                                            <input type="submit" id="search" class="btn btn-primary mx-2" name="search"
                                                title="Search" value="Search">
                                            <a class="btn btn-primary" href="{{ route('furnituremaster.index') }}">
                                                Cancel
                                            </a>

                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                            <tr>
                                                <th>
                                                    <input type="checkbox" onclick="javascript:CheckAll();"
                                                        id="check_listall" class="md-check" value="">
                                                    <label for="check_listall">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                    </label>
                                                </th>
                                                <th scope="col">No</th>
                                                <th scope="col">Furniture Name</th>
                                                <!--<th scope="col">Size</th>-->
                                                <th scope="col">Rate</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($Furniture as $furniture)
                                                <tr>
                                                    <td data-label="id">
                                                        <input type="checkbox" name="check_list[]"
                                                            id="check_list<?php echo $i; ?>" class="md-check"
                                                            value="<?php echo $furniture->iFurnitureId; ?>">
                                                        <label for="check_list<?php echo $i; ?>">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span></label>

                                                    </td>
                                                    <td>{{ $i + $Furniture->perPage() * ($Furniture->currentPage() - 1) }}
                                                    </td>
                                                    <td>{{ $furniture->strFurnitureName }}</td>
                                                    <!--<td>{{ $furniture->strSize }}</td>-->
                                                    <td>{{ $furniture->iRate }}</td>
                                                    <td>
                                                        <?php if($furniture->strPhoto){ ?>
                                                        <img src="{{ asset('Furniture/thumb') . '/' . $furniture->strPhoto }}"
                                                            style="width: 50px;">
                                                        <?php }else{ ?>
                                                        <img src="{{ asset('assets/images/noimage.png') }}"
                                                            style="width: 50px;height: 50px;">
                                                        <?php } ?>


                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a class="mx-1" title="Edit" href="#"
                                                                onclick="getEditData(<?= $furniture->iFurnitureId ?>)"
                                                                data-bs-toggle="modal" data-bs-target="#showModal">
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                            {{--  <button class="btn btn-xs btn-danger" title="Delete"
                                                                onclick="return deletephoto(<?= $data->mediaId ?>);">
                                                                <i class="fa fa-trash"></i></button>  --}}

                                                            <a class="mx-1" href="#" data-bs-toggle="modal"
                                                                title="Delete" data-bs-target="#deleteRecordModal"
                                                                onclick="deleteData(<?= $furniture->iFurnitureId ?>);">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $Furniture->appends(request()->except('page'))->links() }}
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Furniture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form onsubmit="return EditvalidateFile()" method="POST"
                                action="{{ route('furnituremaster.update') }}" class="tablelist-form" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="iFurnitureId" id="iFurnitureId" value="">

                                <div class="modal-body">
                                    <div class="mb-3" id="modal-id" style="display: none;">
                                        <label for="id-field" class="form-label">ID</label>
                                        <input type="text" id="id-field" class="form-control" placeholder="ID"
                                            readonly />
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Furniture Name
                                        <input type="text" class="form-control" name="strFurnitureName"
                                            id="EditstrFurnitureName" placeholder="Enter Furniture Name" maxlength="100"
                                            autocomplete="off" required>
                                    </div>
                                    <!--<div class="mb-3">-->
                                    <!--    <span style="color:red;">*</span>Size-->
                                    <!--    <input type="text" class="form-control" name="strSize" id="EditstrSize"-->
                                    <!--        placeholder="Enter Size" maxlength="100" autocomplete="off" required>-->
                                    <!--</div>-->
                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Rate
                                        <input type="text" class="form-control" name="iRate" id="EditiRate"
                                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                            placeholder="Enter Rate" maxlength="100" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Photo
                                        <input type="file" name="strPhoto" class="form-control" id="Editphoto">
                                        <input type="hidden" name="hiddenPhoto" class="form-control" id="hiddenPhoto">
                                        <div id="PHOTOID">

                                        </div>
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
                                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                                    </lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Are you Sure ?</h4>
                                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record
                                            ?</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <a class="btn btn-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                                        Yes,
                                        Delete It!
                                    </a>
                                    <form id="user-delete-form" method="POST"
                                        action="{{ route('furnituremaster.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="iFurnitureId" id="deleteid" value="">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal -->

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function getEditData(id) {
            //alert(id);
            var url = "{{ route('furnituremaster.edit', ':id') }}";
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
                        //console.log(data);
                        var obj = JSON.parse(data);
                        $("#EditstrFurnitureName").val(obj.strFurnitureName);
                        $("#EditstrSize").val(obj.strSize);
                        $("#EditiRate").val(obj.iRate);
                        $('#hiddenPhoto').val(obj.strPhoto);
                        var html = "";
                        if (obj.strPhoto) {
                            html =
                                '<img src="/Furniture/thumb/' + obj.strPhoto +
                                '" id="hiddenPhoto" width="50px" height = "50px" > ';
                        }
                        $('#PHOTOID').html(html);
                        $('#iFurnitureId').val(id);
                    }
                });
            }
        }
    </script>

    {{-- Edit photo View --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hello').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#Editphoto").change(function() {
            html =
                '<img src="' + readURL(this) +
                '"   id="hello" width="70px" height = "70px" > ';
            $('#PHOTOID').html(html);
        });
    </script>

    {{-- Add Photo View --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hello').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#strPhoto").change(function() {
            html =
                '<img src="' + readURL(this) +
                '"   id="hello" width="70px" height = "70px" > ';
            $('#viewimg').html(html);
        });
    </script>

    {{-- photo extenion check --}}
    <script>
        function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp', ""];
            var fileExtension = document.getElementById('strPhoto').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            for (var index in allowedExtension) {
                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (!isValidFile) {
                alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
            }
            return isValidFile;
        }
    </script>

    {{-- photo extenion check --}}
    <script>
        function EditvalidateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp', ""];
            var fileExtension = document.getElementById('Editphoto').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('Editphoto').value;
            for (var index in allowedExtension) {
                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                }
                return isValidFile;
            }
            return true;
        }
    </script>

    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
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
                    url: "{{ route('furnituremaster.deleteselected') }}",
                    data: $('#frmparameter').serialize(),
                    success: function(response) {
                        //alert(response);
                        if (response == 1) {
                            $('#loading').css("display", "none");
                            $("#Btnmybtn").attr('disabled', 'disabled');
                            alert('Furniture Deleted Sucessfully.');
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
