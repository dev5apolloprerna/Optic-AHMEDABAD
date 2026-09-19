@extends('layouts.app')
@section('title', 'Visitor Registration List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row mt-90">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Visitor Registration </h4>
                            <button type="button" class="btn btn-success btn-user"><i class="fa-solid fa-plus fa-beat fa-lg"></i>
                                <a class="text-white" href="{{route('employees_module.create')  }}">New Registration</a>
                            </button>
                        </div>
                    </div>
                </div>

             
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">List Of Visitor Registration</h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="scroll-horizontal table-responsive" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="all">Sr.No</th>
                                            <th class="all">EarthconId</th>
                                            <th class="all">Name</th>
                                            <th class="all">CompanyName</th>
                                            <th class="all">Email</th>
                                            <th class="all">Mobile </th>
                                            <th class="all">State</th>
                                            <th class="all">City</th>
                                            <th class="all">VisitDate</th>
                                            <th class="all">Interested</th>
                                            <!--<th class="all">Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($Data as $data)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $data->earthconId }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->companyName }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->mobile }}</td>
                                                <td>{{ $data->state }}</td>
                                                <td>{{ $data->city }}</td>
                                                <td>{{ $data->visitDate }}</td>
                                                <td>{{ $data->interested }}</td>
                                                <!--<td style="display: flex">-->
                                                    
                                                <!--    <a class="mx-1" href="#" data-bs-toggle="modal" title="Delete"-->
                                                <!--        data-bs-target="#deleteRecordModal"-->
                                                <!--        onclick="deleteData(<?= $data->visiterId ?>);">-->
                                                <!--        <i class="fa fa-trash" aria-hidden="true"></i>-->
                                                <!--    </a>-->
                                                    
                                                <!--</td>-->
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $Data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            action="{{ route('employees_module.delete') }}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $("#visitDate1").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate2").prop('checked', false);
                $("#visitDate3").prop('checked', false);
            } 
        });

        $("#visitDate2").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate1").prop('checked', false);
                $("#visitDate3").prop('checked', false);
            } 
        });

        $("#visitDate3").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate1").prop('checked', false);
                $("#visitDate2").prop('checked', false);
            } 
        });
    </script>

    <script>
        function formsubmit() {
            if ($("#visitDate1").is(':checked') || $("#visitDate2").is(':checked') || $("#visitDate3").is(':checked')) {
                return true;
            } else {
                alert('Select visit date');
                return false;
            }
        }
        
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>

    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('User.refresh_captcha') }}",
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

    <script>
        function chkMobile() {
            var mobile = $('#mobile').val();
            var url = "{{ route('User.visitorregistrationcheckmobile') }}";
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
        {{--  function validateData() {
            var form_submit = formsubmit();
            var chk_Mobile = chkMobile();

            if (form_submit == true && chk_Mobile == true) {
                return true;
            } else {
                return false;
            }
        }  --}}
    </script>
    
    
    <script>
        function getCityName() {
            var state = $("#state").val();
            var url = "{{ route('mappingcity', ':state') }}";
            
            url = url.replace(":state", state);
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    state: state,
                },
                success: function(data) {
                    $("#city").html('');
                    $("#city").append(data);
                }
            });
        }
    </script>
@endsection
