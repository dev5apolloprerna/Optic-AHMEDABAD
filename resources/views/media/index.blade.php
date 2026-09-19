@extends('layouts.app')
@section('title', 'Media List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-5">

                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Add Media </h5>
                                        </div>

                                        <div class="live-preview">
                                            <form method="POST" action="{{ route('media.store') }}"
                                                onsubmit="return validateFile()" autocomplete="off"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="modal-body">

                                                    <div class="mb-3 mt-3">
                                                        <span style="color:red;">*</span>Photo
                                                        <input type="file" class="form-control" name="photo[]"
                                                            id="photovalidate" multiple required autofocus>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-primary mx-2"
                                                            id="add-btn">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Media List</h5>
                                        </div>

                                        <form role="form" method="POST" action="" name="frmparameter"
                                            id="frmparameter" enctype="multipart/form-data">
                                            @csrf
                                            @method('post')
                                            <div class="form-group row">
                                                <div class="col-md-1">
                                                    <input style="display: inline-block;margin-left: 17px;width: 141px;"
                                                        id="Btnmybtn" class="btn btn-xs btn-danger mt-2 "
                                                        onclick="multiDelete()" value="Delete Selected" name="submit" />
                                                </div>
                                            </div>
                                            <hr />

                                            <table id="scroll-horizontal" class="table nowrap align-middle mt-3"
                                                style="width:100%">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="1%">
                                                            <input type="checkbox" onclick="javascript:CheckAll();"
                                                                id="check_listall" class="md-check" value="">
                                                            <label for="check_listall">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>
                                                            </label>
                                                        </th>
                                                        <th width="1%">No</th>
                                                        <th width="2%">Photo</th>
                                                        <th width="1%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($Media as $media)
                                                        <tr class="text-center">
                                                            <td data-label="id">
                                                                <input type="checkbox" name="check_list[]"
                                                                    id="check_list<?php echo $i; ?>" class="md-check"
                                                                    value="<?php echo $media->mediaId; ?>">
                                                                <label for="check_list<?php echo $i; ?>">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span></label>
                                                            </td>
                                                            <td>{{ $i + $Media->perPage() * ($Media->currentPage() - 1) }}
                                                            </td>
                                                            <td>
                                                                <img src="{{ asset('Media/') . '/' . $media->photo }}"
                                                                    width="80" height="50">

                                                            </td>
                                                            <td>
                                                                <div class="gap-2">
                                                                    <a class="mx-1" href="#" data-bs-toggle="modal"
                                                                        title="Delete" data-bs-target="#deleteRecordModal"
                                                                        onclick="deleteData(<?= $media->mediaId ?>);">
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
                                                {{ $Media->links() }}
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>


                <!--Delete Modal Start -->
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
                                    <a class="btn btn-primary mx-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                                        Yes,
                                        Delete It!
                                    </a>
                                    <button type="button" class="btn w-sm btn-primary mx-2"
                                        data-bs-dismiss="modal">Close</button>
                                    <form id="user-delete-form" method="POST" action="{{ route('media.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="mediaId" id="deleteid" value="">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Delete modal End -->

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>

    <script>
        function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('photovalidate').value.split('.').pop().toLowerCase();
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
                    url: "{{ route('media.deleteselected') }}",
                    data: $('#frmparameter').serialize(),
                    success: function(response) {
                        //alert(response);
                        if (response == 1) {
                            $('#loading').css("display", "none");
                            $("#Btnmybtn").attr('disabled', 'disabled');
                            alert('Media Deleted Sucessfully.');
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
