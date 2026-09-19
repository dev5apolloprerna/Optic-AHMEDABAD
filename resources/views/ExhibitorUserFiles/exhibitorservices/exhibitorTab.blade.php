<?php
$session = Session::get('ExhibitorUserId');
$data = App\Models\ExhibitorUser::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $session])->first();

?>

<ul class="nav nav-pills animation-nav nav-justified mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if (request()->routeIs('User.exhibitor_details')) {{ 'active' }} @endif"
            href="{{ route('User.exhibitor_details') }}" role="tab">
            Exhibitor Details <span class="badge bg-danger rounded-circle"></span>
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if (request()->routeIs('User.exhibitor_lanyard')) {{ 'active' }} @endif"
            href="{{ route('User.exhibitor_lanyard') }}" role="tab">
            Exhibitors Lanyard <span class="badge bg-danger rounded-circle"></span>
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link  @if (request()->routeIs('User.AdditionalFurniture')) {{ 'active' }} @endif || @if (request()->routeIs('User.AdditionalFurnitureList')) {{ 'active' }} @endif"
            href="{{ route('User.AdditionalFurniture') }}" role="tab">
            Additional Furniture <span class="badge bg-danger rounded-circle"></span>
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if (request()->routeIs('User.Participation_Letter')) {{ 'active' }} @endif" target="_blank"
            href="{{ route('User.Participation_Letter') }}" role="tab">
            Participation Letter <span class="badge bg-danger rounded-circle"></span>
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if (request()->routeIs('User.Transportation_Letter')) {{ 'active' }} @endif" target="_blank"
            href="{{ route('User.Transportation_Letter') }}" role="tab">
            Transportation Letter<span class="badge bg-danger rounded-circle"></span>
        </a>
    </li>

    @if (isset($data->isPaymentReceived) && $data->isPaymentReceived == 1)
        <li class="nav-item waves-effect waves-light">
            <a target="_blank" class="nav-link @if (request()->routeIs('User.NoDueLetterPDF')) {{ 'active' }} @endif"
                href="{{ route('User.NoDueLetterPDF') }}" role="tab">
                No Due Letter <span class="badge bg-danger rounded-circle"></span>
            </a>
        </li>
    @else
        <li class="nav-item waves-effect waves-light">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link" href="#" role="tab">
                No Due Letter <span class="badge bg-danger rounded-circle"></span>
            </a>
        </li>
    @endif
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if (request()->routeIs('User.ExhibitionVendor')) {{ 'active' }} @endif"
            href="{{ route('User.ExhibitionVendor') }}" role="tab">
            Exhibition Vendor <span class="badge bg-danger rounded-circle"></span>
        </a>
    </li>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal">
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Oops,Pending</h2>
                    <p>Please Contact Furniture Expo Team.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</ul>
