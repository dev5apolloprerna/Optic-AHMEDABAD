@if (Session::has('success'))
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Success! </strong> {{ session('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Error! </strong> {{ session('error') }}
    </div>
@endif

