@extends('layouts.user')
@section('title', 'SMSData List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="mb-sm-0"
                            style="border-bottom: 1px solid var(--vz-border-color);
    box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px !important;
    border-radius: 6px !important;
    background: #1b4e9b;
    align-items: center;
    text-align: center;
    padding: 15px;
    color: white;
    font-size: 17px;">
                            Add New campaign </h4>
                        <div class="card mt-90">
                            <div class="card-body">
                                <div class="live-preview">
                                    <form onsubmit="return validateFile()" action="{{ route('User.UploadedSMSStore') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row gy-4" style="align-items: end;">
                                            <div>
                                                <span style="color:red;">*</span>Whatsapp Message
                                                <textarea class="form-control" name="strMessage" cols="30" rows="3" required></textarea>
                                            </div>
                                            <div>
                                                <span style="color:red;">*</span>Excel
                                                <input type="file" class="form-control" name="strFileName"
                                                    id="fileChooser" autocomplete="off" required accept=".xlsx , .xls">
                                            </div>
                                            <div>
                                                <span style="color:red;"></span>Photo
                                                <input type="file" class="form-control" name="strPhoto" id="strPhoto"
                                                    autocomplete="off"
                                                    accept="image/jpg, image/jpeg , image/png, image/webp">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-success btn-user float-right">Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">List of Whatsapp Einvites</h5>
                            </div>
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="33%">Message</th>
                                            <th width="2%">Photo</th>
                                            <th width="5%">Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($Data as $data)
                                            <tr>
                                                <td style="text-align: center;">{{ $i }}</td>
                                                <td>{{ $data->strMessage }}</td>
                                                <td>
                                                    @if ($data->strPhoto)
                                                        <img src="{{ asset('WhatsappPhoto') . '/' . $data->strPhoto }}"
                                                            style="width: 50px;height: 50px;">
                                                    @else
                                                        <img src="{{ asset('assets/images/noimage.png') }}"
                                                            style="width: 50px;height: 50px;">
                                                    @endif

                                                </td>
                                                <td style="text-align: center;">
                                                    <a class="mx-1" href="{{ asset('/Upload/' . $data->strFileName) }}"
                                                        title="Download">
                                                        <i class="fa-solid fa-download fa-bounce fa-lg"></i>
                                                    </a>
                                                </td>

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
@endsection

@section('scripts')
    <script>
        function validateFile() {
            var allowedExtension = ['xlsx', 'xls'];
            var photoExtension = ['jpeg', 'jpg', 'png', 'webp', ''];
            var fileExtension = document.getElementById('fileChooser').value.split('.').pop().toLowerCase();
            var photoExtension = document.getElementById('strPhoto').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var photoisValidFile = false;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }

            for (var index in photoExtension) {

                if (photoExtension === photoExtension[index]) {
                    photoisValidFile = true;
                    break;
                }
            }

            if (!isValidFile) {
                alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
            }

            if (!photoisValidFile) {
                alert('Allowed Extensions are : *.' + photoExtension.join(', *.'));
            }

            return isValidFile, photoisValidFile;
        }
    </script>
@endsection
