@extends('layouts.app')
@section('title', 'Employees List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="d-flex justify-content-between card-header">
                                <h5 class="card-title mb-0"> Employees List</h5>
                                <a data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-sm btn-primary">
                                    <i data-feather="plus"></i> Add New
                                </a>
                            </div>
                            <div class="card-body">
                                <?php //echo date('ymd');
                                ?>
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th width="10%"> First Name </th>
                                            <th width="10%"> Last Name </th>
                                            <th width="10%"> Email </th>
                                             <th width="10%">Today Registration</th>
                                            <th width="10%">Total Registration</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($users as $user)
                                            <tr class="text-center">
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->today_count ?? 0 }}</td>
                                                <td>{{ $user->total_count ?? 0 }}</td>
                                                
                                                <td class="text-center">
                                                    <div class="gap-2">
                                                        
                                                        <a class="mx-1" title="Edit" href="#"
                                                            onclick="getEditData(<?= $user->id ?>)"
                                                            data-bs-toggle="modal" data-bs-target="#showModal">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        
                                                         {{-- Change Password --}}
                                                        <a class="mx-1"
                                                           href="#"
                                                           title="Change Password"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#changePasswordModal"
                                                           onclick="changePassword({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')">
                                                            <i class="fas fa-key"></i>
                                                        </a>

                                                        <a class="" href="#" data-bs-toggle="modal"
                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                            onclick="deleteData(<?= $user->id ?>);">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>
                </div>

                <!--Add Modal Start-->
                <div class="modal fade flip" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Add Employees</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="{{ route('employees.store') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>First Name
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name"
                                            maxlength="100" autocomplete="off" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Last Name
                                        <input type="text" class="form-control" name="last_name"
                                            placeholder="Enter Last Name" maxlength="100" autocomplete="off" required>
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Email
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Email" maxlength="100" autocomplete="off" required>
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Password
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter Password" maxlength="100" autocomplete="off" required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary mx-2"
                                            id="add-btn">Submit</button>
                                        <button type="button" class="btn btn-primary mx-2"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Add Modal End -->

                <!--Edit Modal Start-->
                <div class="modal fade flip" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Employees</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="{{ route('employees.update') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="user_id" value="">

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>First Name
                                        <input type="text" class="form-control" name="first_name" id="Editfirst_name"
                                            placeholder="Enter First Name" maxlength="100" autocomplete="off" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Last Name
                                        <input type="text" class="form-control" name="last_name"
                                            id="Editlast_name" placeholder="Enter Last Name" maxlength="100"
                                            autocomplete="off" required>
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Email
                                        <input type="text" class="form-control" name="email" id="Editemail"
                                            placeholder="Enter Email" maxlength="100" autocomplete="off" required>
                                    </div>
                                    

                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary mx-2"
                                            id="add-btn">Update</button>
                                        <button type="button" class="btn btn-primary mx-2"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Edit Modal End -->

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
                                    <form id="user-delete-form" method="POST"
                                        action="{{ route('employees.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" id="deleteid" value="">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Delete modal End -->
                
                
                <!-- Change Password Modal -->
                <div class="modal fade" id="changePasswordModal" tabindex="-1"
    aria-labelledby="changePasswordModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('employees.changePassword') }}"
                method="POST"
                id="changePasswordForm">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        Change Password
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    {{-- IMPORTANT: Keep user ID after validation error --}}
                    <input type="hidden"
                        name="user_id"
                        id="change_password_user_id"
                        value="{{ old('user_id') }}">

                    <div class="mb-3">
                        <label class="form-label">
                            Employee
                        </label>

                        <input type="text"
                            name="user_name"
                            class="form-control"
                            id="change_password_user_name"
                            value="{{ old('user_name') }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            New Password <span class="text-danger">*</span>
                        </label>

                        <input type="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter new password"
                            required>

                        @error('password')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Confirm Password <span class="text-danger">*</span>
                        </label>

                        <input type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm new password"
                            required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-primary">
                        Update Password
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

            </div>
        </div>
    </div>
    

@endsection

@section('scripts')

<script>
    function changePassword(userId, userName) {

        document.getElementById('change_password_user_id').value = userId;

        document.getElementById('change_password_user_name').value = userName;

        document.querySelector(
            '#changePasswordModal input[name="password"]'
        ).value = '';

        document.querySelector(
            '#changePasswordModal input[name="password_confirmation"]'
        ).value = '';
    }
</script>

{{-- Re-open Change Password modal after Laravel validation error --}}
@if ($errors->has('password'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            var modalElement = document.getElementById('changePasswordModal');

            if (modalElement) {
                var changePasswordModal =
                    new bootstrap.Modal(modalElement);

                changePasswordModal.show();
            }

        });
    </script>
@endif
    <script>
        function getEditData(id) {
            var url = "{{ route('employees.edit', ':id') }}";
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
                        var obj = JSON.parse(data);
                       
                        $('#user_id').val(id);
                        $("#Editfirst_name").val(obj.first_name);
                        $("#Editlast_name").val(obj.last_name);
                        $("#Editemail").val(obj.email);
                    }
                });
            }
        }

    </script>

    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>

@endsection
