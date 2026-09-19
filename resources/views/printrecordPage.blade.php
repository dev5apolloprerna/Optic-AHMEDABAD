@extends('layouts.front')
@section('content')
    <style>
        table td {
            border: 1px solid #ff8a00;
            font-size 16px;
            color: black;
            padding-left: 8px;
        }

        .tq-head {
            padding: 15px 0px;
            color: orangered;
            background: orange;
            color: white;
            text-transform: uppercase;
            font-size: 30px;
            margin-bottom: 40px;
            text-align: center;
        }

        .lff {
            align-items: baseline;
            background: #ff8d00;
            padding: 20px;
            border-radius: 6px;
        }

        .new-b {
            background: -webkit-linear-gradient(-90deg, #540F00 0 100%);
            color: white;
            padding: 6px 15px;
            border-radius: 6px;
            border-radius: 42px;
            text-transform: uppercase;
            border: none
        }

        table td {
            border: 1px solid #540f00;
            color: black;
            padding-left: 8px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            border: 1px solid #540f00;
        }
    </style>



    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="container">
        <div class="row mt-5 lff align-items-center">
            <div class="col-lg-12">
                <form method="post" id="form" action="{{ route('printrecord') }}">
                    @csrf

                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <input placeholder="Enter Mobile" type="text"
                                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                    maxlength="10" minlength="10" class="form-control" id="mobile" name="mobile"
                                    autocomplete="off" value="<?= isset($MobileNo) ? $MobileNo : '' ?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group d-flex justify-content-right">
                                <button type="submit" id="search" class="new-b mx-2" name="search"
                                    title="Search">Search </button>
                                <a class="new-b text-white" href="{{ route('printrecord') }}" title="Reset">Reset</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="card-body">

                        <?php if(!empty($data)){ ?>
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr style="background: #ff8d00;
                                color: white;" class="text-center">

                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($data as $datas)
                                    <tr class="text-center">
                                        <td>{{ $i }}
                                        </td>
                                        <td>{{ ucwords(strtolower($datas->name)) }}</td>
                                        <td>{{ $datas->mobile }}</td>
                                        <td>{{ $datas->city }}</td>
                                        <td>
                                            {{--  <form action="{{ route('printrecordsubmit') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="name" value="{{ $datas->name }}">
                                                        <input type="hidden" name="mobile" value="{{ $datas->mobile }}">
                                                        <input type="hidden" name="state" value="{{ $datas->state }}">
                                                        <input type="hidden" name="city" value="{{ $datas->city }}">
                                                        <button type="submit">  --}}
                                            <a class="mx-1" target="_blank"
                                                onclick="printArea('{{ $datas->name }}', '{{ $datas->mobile }}', '{{ $datas->state }}', '{{ $datas->city }}');"
                                                href="#" title="Print">
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                            </a>
                                            {{--  </button>
                                                    </form>  --}}
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        <?php }else{ ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <h1
                                        class="text-center alert alert-info clearfix profile-information padding-all-10 margin-all-0 backgroundDark">
                                        No Data Found !</h1>
                                </tr>
                            </thead>
                        </table>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function printArea(name, mobile, state, city) {
            var printableContent = `
        <table>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        <tr>
            <td style="font-size: 30px;"><strong>${name}</strong></td>
        </tr>
        <tr>
            <td style="font-size: 30px;"><strong>${mobile}</strong></td>
        </tr>
        <tr>
            <td style="font-size: 30px;"><strong>${state}</strong></td>
        </tr>
        <tr>
            <td style="font-size: 30px;"><strong>${city}</strong></td>
        </tr>
        </table>
    `;

            var printWindow = window.open('', '_blank');
            printWindow.document.write(printableContent);
            printWindow.print();
            printWindow.close();
        }
    </script>
@endsection
