@extends('layouts.user')

@section('title', 'Exhibitor Services List')

@section('content')

    <style>
        @media (max-width: 425px) {
            .sm-sc input {
                width: 100% !important;
                padding: 5px;
            }

            .sm-sc select {
                width: 100% !important;
                padding: 5px;
            }

            .jc-sm {
                justify-content: center;
            }
        }
    </style>

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

                                            <div class="col-lg-4 mt-3">
                                                <div class="card">
                                                    <h4 class="mb-sm-0">Add Exhibitors Lanyard</h4>
                                                    <div class="card-body">
                                                        <div class="live-preview">
                                                            <form method="POST" id="myForm"
                                                                action="{{ route('User.exhibitor_lanyard_store') }}">
                                                                @csrf
                                                                <div class="row gy-4">
                                                                    <div>
                                                                        <span style="color:red;">*</span>Company Name
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter Company Name"
                                                                            name="strCompanyName" autocomplete="off"
                                                                            value="{{ $sessiondata->strCompany }}" readonly
                                                                            required>
                                                                    </div>
                                                                    <div>
                                                                        <span style="color:red;">*</span>City
                                                                        <input type="text" class="form-control"
                                                                            name="strCity" autocomplete="off"
                                                                            value="{{ $sessiondata->strCity }}"
                                                                            placeholder="Enter City" required>
                                                                    </div>
                                                                    <div>
                                                                        <span style="color:red;">*</span>Company/Brand Name
                                                                        On Lanyard
                                                                        <input type="text" class="form-control"
                                                                            name="strCompanyBrandNameOnLanyard"
                                                                            autocomplete="off"
                                                                            value="{{ $sessiondata->strCompanyBrandNameOnLanyard }}"
                                                                            placeholder="Enter Company/Brand Name On Lanyard"
                                                                            required>
                                                                    </div>
                                                                    <div class="wrapper">
                                                                        <div class="mb-4">
                                                                            <span style="color:red;">*</span>Member Name
                                                                            <input type="text" class="form-control "
                                                                                placeholder="Enter Member Name"
                                                                                autocomplete="off" id="strMemberName"
                                                                                name="strMemberName[]" required>
                                                                        </div>
                                                                        <div>
                                                                            <span style="color:red;">*</span>Member Mobile
                                                                            <input type="text"
                                                                                class="form-control form-control-user @error('iMemberMobile') is-invalid @enderror moblievalidate"
                                                                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                                                id="mobile_0" autocomplete="off"
                                                                                name="iMemberMobile[]" minlength="10"
                                                                                onblur="mobilevalidate();" maxlength="10"
                                                                                placeholder="Enter Member Mobile" required>
                                                                            @error('iMemberMobile')
                                                                                <span class="text-danger">{{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-4" id="editHideBtn">
                                                                            <div class="form-group change">
                                                                                <label for="">&nbsp;</label><br />
                                                                                <a class="btn btn-success add-more">+ Add
                                                                                    More</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="card-footer mt-3" style="float: right;">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-user float-right mb-3">Save
                                                                    </button>
                                                                    <a class="btn btn-primary float-right mr-3 mb-3"
                                                                        href="{{ route('User.exhibitor_lanyard') }}">Cancel</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($count > 0)
                                                <div class="col-lg-8 mt-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table id="scroll-horizontal"
                                                                    class="table nowrap align-middle" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="all">Sr.No</th>
                                                                            <th class="all">Company/Brand Name On Lanyard
                                                                            </th>
                                                                            <th class="all">Member Name</th>
                                                                            <th class="all">Member Mobile</th>
                                                                            <th class="all">City</th>
                                                                            <th class="all">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $i = 1; ?>
                                                                        @foreach ($datas as $data)
                                                                            <tr>
                                                                                <td>{{ $i }}
                                                                                </td>
                                                                                <td>{{ $data->strCompanyBrandNameOnLanyard ?? '-' }}
                                                                                </td>
                                                                                <td>{{ $data->strMemberName }}</td>
                                                                                <td>{{ $data->iMemberMobile }}</td>
                                                                                <td>{{ $data->strCity }}</td>
                                                                                <td>
                                                                                    <a class="mx-1" href="#"
                                                                                        data-bs-toggle="modal"
                                                                                        title="Delete"
                                                                                        data-bs-target="#deleteRecordModal"
                                                                                        onclick="deleteData(<?= $data->iExhibitBatchId ?>);">
                                                                                        <i class="fa fa-trash"
                                                                                            aria-hidden="true">
                                                                                        </i>
                                                                                    </a>
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
                                            @else
                                                <div class="col-lg-8 mt-3">
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
                                        action="{{ route('User.exhibitor_lanyard_delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="iExhibitBatchId" id="deleteid" value="">

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
        $(document).ready(function() {
            var wrapper = $(".wrapper");
            var maxField = 25; //Input fields increment limitation
            var x = 1;
            $("body").on("click", ".add-more", function() {


                if (x < maxField) {
                    var fieldHTML =
                        `<div class='after-add-more mb-5 mt-3'>
                    <div class='mb-2'>
                        <span style='color:red;''>*</span>Member Name
                        <input type='text' class='form-control'
                            placeholder='Enter Member Name'
                            autocomplete='off' id='strMemberName'
                            name='strMemberName[]' required>
                    </div>
                    <div>
                        <span style='color:red;''>*</span>Member Mobile
                        <input type='text'
                            class='form-control form-control-user @error('iMemberMobile') is-invalid @enderror moblievalidate'
                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, '')"
                            id='mobile_` + x + `'
                            autocomplete='off' name='iMemberMobile[]'
                            minlength='10' maxlength='10'
                            placeholder='Enter Member Mobile' required>
                    </div>

                    <div class="col-md-4" id="editHideBtn">
                        <div class="form-group change"><label for="">&nbsp;</label><br><a class="btn btn-danger remove">- Remove</a></div>
                    </div>
                </div>`;
                    x++;
                    $(wrapper).append(fieldHTML);
                    $(fieldHTML).find(".change").html(
                        "<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>"
                    );
                    //$(".wrapper").last().after(fieldHTML);
                }

                var addbutton = $('#mobile_').val();
            });
            $("body").on("click", ".remove", function() {
                $(this).parents(".after-add-more").remove();
            });
        });
    </script>

    <script>
        $('#myForm input[name^="iMemberMobile"]').on('change', function() {

            //Create array of input values
            var ar = $('#myForm input[name^="iMemberMobile"]').map(function() {
                if ($(this).val() != '') return $(this).val()
            }).get();

            //Create array of duplicates if there are any
            var unique = ar.filter(function(item, pos) {
                return ar.indexOf(item) != pos;
            });

            //show/hide error msg
            (unique.length != 0) ? $('.error').text('duplicate'): $('.error').text('');
        })
    </script>
    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>


@endsection
