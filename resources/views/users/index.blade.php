@extends('layouts.app')

@section('title', 'Users List')

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
                                <h5 class="card-title mb-0">User List</h5>
                                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                                    <i data-feather="plus"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <!-- Page Heading -->
                    <div class="card">
                        <div class="card-body">
                            <form method="post" id="form" action="{{ route('users.index') }}">
                                @csrf
                                <div class="row  align-items-center">
                                    <div class="col-md-3 mb-2">
                                        <div class="d-flex align-items-center">
                                            <input
                                                placeholder="Company Name / Mobile"
                                                type="text"
                                                class="form-control"
                                                name="searchText"
                                                autocomplete="off"
                                                value="{{ $searchText ?? '' }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3  mb-2">
                                        <div class="input-group d-flex justify-content-right">
                                            <input type="submit" id="search" class="btn btn-primary mx-2" name="search"
                                                title="Search" value="Search">
                                            <a class="btn btn-primary" href="{{ route('users.index') }}">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group" style="justify-content: right;">
                                            <button style="border: none;"  type="button" onclick="exportExcel();">
                                                <i class="fa-solid fa-file-csv fa-bounce fa-2xl"></i>
                                            </button>
                                            
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
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Contact Person</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Stall No.</th>
                                            <th scope="col">Stall Size</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $i + $users->perPage() * ($users->currentPage() - 1) }}</td>
                                                <td>{{ $user->strCompany }}</td>
                                                <td>{{ $user->strContactPerson ?? '-' }}</td>
                                                <td>{{ $user->Mobile }}</td>
                                                <td>{{ $user->strEmail ?? '-' }}</td>
                                                <td>{{ $user->strCity ?? '-' }}</td>
                                                <td>{{ $user->strStallNo }}</td>
                                                <td>{{ $user->strStallSize ?? '-' }}</td>
                                                <td>
                                                    @if ($user->iStatus == 0)
                                                        <span class="badge badge-gradient-danger">Inactive</span>
                                                    @elseif ($user->iStatus == 1)
                                                        <span class="badge badge-gradient-primary">Active</span>
                                                    @endif
                                                </td>
                                                <td style="display: flex">
                                                    
                                                    @if ($user->iStatus == 0)
                                                        <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"
                                                            title="InActive" class="mx-1">
                                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                                        </a>
                                                    @elseif ($user->iStatus == 1)
                                                        <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"
                                                            title="Active" class="mx-1">
                                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                                        </a>
                                                    @endif

                                                    <a class="mx-1" title="Edit"
                                                        href="{{ route('users.edit', $user->id) }}">
                                                        <i class="far fa-edit"></i>

                                                    </a>
                                                    <a class="mx-1" href="#" data-bs-toggle="modal" title="Delete"
                                                        data-bs-target="#deleteRecordModal"
                                                        onclick="deleteData(<?= $user->id ?>);">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="mx-1" href="#" data-bs-toggle="modal"
                                                        title="Change Password" data-bs-target="#changepassword"
                                                        onclick="editpassword(<?= $user->id ?>);">
                                                        <i class="fa fa-key" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="mx-1" href="{{ route('users.sendmail', $user->id) }}"
                                                        title="Send" onclick="return confirm('Are you sure to Resend?');">
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $users->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form method="post" action="{{ route('users.passwordupdate') }}" autocomplete="off">
                    @csrf
                    @method('post')

                    <input type="hidden" name="id" id="GetId" value="">

                    <div class="modal-body">
                        <div class="mb-3" id="modal-id" style="display: none;">
                            <label for="id-field" class="form-label">ID</label>
                            <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="newpassword" class="form-label">New Password</label>
                            <input type="password" name="newpassword" id="newpassword" class="form-control"
                                placeholder="Enter New Password" required />
                            <div class="invalid-feedback">Please enter a customer name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control"
                                placeholder="Enter Confirm Password" required />
                            <div class="invalid-feedback">Please enter an email.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Delete Modal -->
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
                            action="{{ route('users.destroy', $user->id ?? '') }}">
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
        function editpassword(id) {
            $("#GetId").val(id);
        }

        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>
    
        <script>
        function exportExcel() {
            var strCompany = $("#strCompany").val();
            var StrStatus = $("#StrStatus").val();
            var strURL = "{{ route('users.exportToexcel') }}";
            strURL += "?strCompany=" + strCompany + "&StrStatus=" + StrStatus;
            window.location.href = strURL;
        }
    </script>
@endsection
