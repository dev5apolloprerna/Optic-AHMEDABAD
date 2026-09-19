@extends('layouts.app')

@section('title', 'SMSData List')

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
                                <h5 class="card-title mb-0">SMS Data List</h5>
                            </div>
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
                                            <th width="1%">No</th>
                                            <th width="10%">Message</th>
                                            <th width="2%">SMS Count </th>
                                            <th width="5%">Company Name </th>
                                            <th width="2%">Photo</th>
                                            <th width="1%">Download</th>
                                            <th width="1%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($SMSData as $data)
                                            <tr>
                                                <th>{{ $i }}</th>
                                                <td>{{ $data->strMessage }}</td>
                                                <td style="text-align: center;">{{ $data->iSMSCount }}</td>
                                                <td>{{ $data->strCompany }}</td>
                                                <td>
                                                    @if($data->strPhoto)
                                                    <img src="{{ asset('WhatsappPhoto') . '/' . $data->strPhoto }}"
                                                            style="width: 50px;height: 50px;">
                                                    @else
                                                    <img src="{{ asset('assets/images/noimage.png')}}"
                                                            style="width: 50px;height: 50px;">
                                                    @endif        
                                                            
                                                </td>
                                                <td style="text-align: center;">
                                                    <a class="mx-1" href="{{ asset('Upload/' . $data->strFileName) }}"
                                                        title="Download">
                                                        <i class="fa-solid fa-download fa-bounce fa-lg"></i>
                                                    </a>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a class="mx-1" href="#" data-bs-toggle="modal" title="Delete"
                                                        data-bs-target="#deleteRecordModal"
                                                        onclick="deleteData(<?= $data->SMSId ?>);">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $SMSData->appends(request()->except('page'))->links() }}
                                </div>
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
                            action="{{ route('SMSData.delete', $data->SMSId ?? '') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="SMSId" id="deleteid" value="">

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
