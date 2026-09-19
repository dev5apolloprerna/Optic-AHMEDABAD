@extends('layouts.app')

@section('title', 'Visitor List')

@section('content')

    <style>
        .td-p td,
        th {
            padding: 0px !important;
            border: 1px solid #ddd;
        }
    </style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Visitor List</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="card">
                        <div class="card-body">
                            <form method="post" id="form" action="{{ route('visitor.index') }}">
                                @csrf
                                <div class="row  align-items-center">
                                    <div class="col-md-3  mb-2">
                                        <div class="d-flex align-items-center">
                                            <select class="form-control" name="strEntryDate">
                                                <option selected disabled value="">Select Date</option>
                                                <option value="{{ config('app.visitor_date1') }}"
                                                    {{ $EntryDate == config('app.visitor_date1') ? 'selected' : '' }}>
                                                    {{ config('app.visitor_date1') }}</option>
                                                <option value="{{ config('app.visitor_date2') }}"
                                                    {{ $EntryDate ==  config('app.visitor_date2') ? 'selected' : '' }}>
                                                    {{ config('app.visitor_date2') }}</option>
                                                <option value="{{ config('app.visitor_date3') }}"
                                                    {{ $EntryDate == config('app.visitor_date3') ? 'selected' : '' }}>
                                                    {{ config('app.visitor_date3') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3  mb-2">
                                        <div class="d-flex align-items-center">
                                            <input type="text" id="mobile" class="form-control" name="mobile"
                                                placeholder="Enter Mobile" value="<?= isset($Mobile) ? $Mobile : '' ?>"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3  mb-2">
                                        <div class="input-group d-flex justify-content-right">
                                            <input type="submit" id="search" class="btn btn-primary mx-2" name="search"
                                                title="Search" value="Search">
                                            <a class="btn btn-primary" href="{{ route('visitor.index') }}">
                                                Cancel
                                            </a>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group" style="justify-content: right;">
                                            <a href="{{ route('visitor.excel', [$Mobile ?? 0, $EntryDate ?? 0]) }}">
                                                <i class="fa-solid fa-file-csv fa-bounce fa-2xl"></i>
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

                                    <div class="table-responsive td-p">
                                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">
                                                        <input type="checkbox" onclick="javascript:CheckAll();"
                                                            id="check_listall" class="md-check" value="">
                                                        <label for="check_listall">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>
                                                        </label>

                                                    </th>
                                                    <th width="1%">No</th>
                                                    <th width="3%">Visit Id</th>
                                                    <th width="10%">Name</th>
                                                    <th width="10%">Company</th>
                                                    <th width="3%">Email</th>
                                                    <th width="1%">Mobile</th>
                                                    <th width="4%">State</th>
                                                    <th width="4%">City</th>
                                                    <th width="15%">Visit Date</th>
                                                    {{--  <th width="7%">Interested</th>  --}}
                                                    <th width="7%">Enter By</th>
                                                    <th width="1%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($Visiter as $Visiters)
                                                    <tr class="text-center">
                                                        <td data-label="id">
                                                            <input type="checkbox" name="check_list[]"
                                                                id="check_list<?php echo $i; ?>" class="md-check"
                                                                value="<?php echo $Visiters->visiterId; ?>">
                                                            <label for="check_list<?php echo $i; ?>">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span></label>
                                                        </td>
                                                        <td>{{ $i + $Visiter->perPage() * ($Visiter->currentPage() - 1) }}
                                                        </td>
                                                        <td>{{ $Visiters->earthconId }}</td>
                                                        <td>{{ ucwords(strtolower($Visiters->name)) }}</td>
                                                        <td>{{ ucwords(strtolower($Visiters->companyName)) }}</td>
                                                        <td>{{ $Visiters->email }}</td>
                                                        <td>{{ $Visiters->mobile }}</td>
                                                        <td>{{ ucwords(strtolower($Visiters->state)) }}</td>
                                                        <td>{{ ucwords(strtolower($Visiters->city)) }}</td>
                                                        <td>{{ $Visiters->visitDate }}</td>
                                                        {{--  <td>{{ $Visiters->interested }}</td>  --}}
                                                        <td>
                                                            {{ $Visiters->user->first_name ?? '' }} 
                                                            {{ $Visiters->user->last_name ?? '' }}
                                                        </td>
                                                        <td>
                                                            <a class="mx-1" href="#" data-bs-toggle="modal"
                                                                title="Delete" data-bs-target="#deleteRecordModal"
                                                                onclick="deleteData(<?= $Visiters->visiterId ?>);">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                            <a class="mx-1"
                                                               href="{{ route('visitor.preview', $Visiters->visiterId) }}"
                                                               target="_blank"
                                                               title="Preview">
                                                               <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a class="mx-1"
                                                                href="{{ route('visitor.sendmail', $Visiters->visiterId) }}"
                                                                title="Send"
                                                                onclick="return confirm('Are you sure to Resend?');">
                                                                <i class="fa-solid fa-envelope"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $Visiter->appends(request()->except('page'))->links() }}
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
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <form id="user-delete-form" method="POST"
                            action="{{ route('visitor.delete', $Visiters->visiterId ?? '') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="visiterId" id="deleteid" value="">

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
                    url: "{{ route('visitor.deleteselected') }}",
                    data: $('#frmparameter').serialize(),
                    success: function(response) {
                        //alert(response);
                        if (response == 1) {
                            $('#loading').css("display", "none");
                            $("#Btnmybtn").attr('disabled', 'disabled');
                            alert('Deleted Sucessfully.');
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
