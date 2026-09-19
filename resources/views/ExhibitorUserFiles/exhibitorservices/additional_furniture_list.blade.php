@extends('layouts.user')

@section('title', 'Exhibitor Services List')

@section('content')


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-xxl-12">
                        <h5 class="mb-3"></h5>
                        <div class="card">
                            <div class="card-body">

                                @include('ExhibitorUserFiles.exhibitorservices.exhibitorTab')

                                <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" href="{{ route('User.AdditionalFurnitureList') }}"
                                            role="tab">
                                            Additional Furniture <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link " href="{{ route('User.AdditionalFurniture') }}" role="tab">
                                            Furniture Selected <span class="badge bg-danger rounded-circle"></span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="PendingOrder" role="tabpanel">
                                        <div class="row">
                                            @if ($count > 0)
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <form method="POST"
                                                                    action="{{ route('User.AdditionalFurnitureListStore') }}">
                                                                    @csrf
                                                                    <table id="scroll-horizontal"
                                                                        class="table nowrap align-middle"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="2%">Sr.No</th>
                                                                                <th width="5%">Furniture Image</th>
                                                                                <th width="10%">Furniture</th>
                                                                                <th width="5%">Rate</th>
                                                                                <th width="5%">Qty</th>
                                                                                <th width="5%">Amount</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $i = 1;
                                                                            $TotalAmount = 0;
                                                                            ?>
                                                                            @foreach ($Furniture as $furniture)
                                                                                <?php
                                                                                $session = Session::get('ExhibitorUserId');
                                                                                $strFilterQty = App\Models\AdditionalFurniture::where(['iStatus' => 1, 'isDelete' => 0, 'iCompayId' => $session, 'iFurnitureId' => $furniture->iFurnitureId])->first();
                                                                                ?>
                                                                                <tr>
                                                                                    <td>{{ $i }}</td>
                                                                                    <td style="text-align: center">
                                                                                        <img src="{{ asset('Furniture/thumb') . '/' . $furniture->strPhoto }}"
                                                                                            style="width: 50px;">
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $furniture->strFurnitureName }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $furniture->iRate }}
                                                                                        <input type="hidden"
                                                                                            class="form-control"
                                                                                            name="iRate_<?= $furniture->iFurnitureId ?>"
                                                                                            value="{{ $furniture->iRate }}">
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $furniture->iQty }}
                                                                                        <input type="hidden"
                                                                                            class="form-control"
                                                                                            name="iFurnitureId[]"
                                                                                            value="<?= $furniture->iFurnitureId ?>">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="iQty_<?= $furniture->iFurnitureId ?>"
                                                                                            id="iQty_<?= $furniture->iFurnitureId ?>"
                                                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                                            value="<?= isset($strFilterQty) && $strFilterQty->iQty != '' ? $strFilterQty->iQty : '' ?>"
                                                                                            onkeyup="calAmount(<?php echo $furniture->iRate; ?>,<?= $furniture->iFurnitureId ?>);">
                                                                                    </td>
                                                                                    <td>

                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="iAmount_<?= $furniture->iFurnitureId ?>"
                                                                                            id="iAmount_<?= $furniture->iFurnitureId ?>"
                                                                                            value="<?= isset($strFilterQty) && $strFilterQty->iAmount != '' ? $strFilterQty->iAmount : '' ?>"
                                                                                            readonly>
                                                                                    </td>

                                                                                </tr>
                                                                                <?php $i++; ?>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    <input class="btn btn-primary"
                                                                        style="float: right;margin-top: 3px;" type="submit"
                                                                        id="Btnmybtn" value="Submit" name="submit" />
                                                                    <div class="d-flex justify-content-center mt-3">
                                                                        {{ $Furniture->links() }}
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div
                                                        class="col-lg-12 col-md-12  col-xs-12 col-sm-12 padding-5 bottom-border-verydark">
                                                        <div
                                                            class="alert alert-info clearfix profile-information padding-all-10 margin-all-0 backgroundDark">
                                                            <h1 class="font-white text-center"> No Data Found ! </h1>
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

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function calAmount(rate, iFurnitureId) {
            var iQty = $("#iQty_" + iFurnitureId).val();
            var Amount = (iQty * 1) * (rate * 1);
            $("#iAmount_" + iFurnitureId).val(Amount);
        }
    </script>
@endsection
