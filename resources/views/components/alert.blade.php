@if ($errors->any())
    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
        @foreach ($errors->all() as $error)
            <div class='d-flex align-items-center' style="font-family: 'Inter' !important;">
                <i class="icon fas fa-exclamation-circle me-2 me-1"></i> &nbsp;
                <span style="font-family: 'Inter' !important;">{{ $error }}</span>
            </div>
        @endforeach
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible mb-2" role="alert">
        <div class='d-flex align-items-center' style="font-family: 'Inter' !important;">
            <i class="icon fas fa-exclamation-circle me-2"></i> &nbsp;
            <span style="font-family: 'Inter' !important;"> {{ Session::get('info') }}</span>
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
        <div class='d-flex align-items-center' style="font-family: 'Inter' !important;">
            <i class="icon fas fa-exclamation-circle me-2"></i> &nbsp;
            <span style="font-family: 'Inter' !important;"> {{ Session::get('warning') }}</span>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
        <div class='d-flex align-items-center' style="font-family: 'Inter' !important;">
            <i class="icon fas fa-exclamation-circle me-2"></i> &nbsp;
            <span style="font-family: 'Inter' !important;"> {{ Session::get('error') }}</span>
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible mb-2" role="alert">
        <div class='d-flex align-items-center' style="font-family: 'Inter' !important;">
            <i class="icon fas fa-exclamation-circle me-2"></i> &nbsp;
            <span style="font-family: 'Inter' !important;"> {{ Session::get('success') }}</span>
        </div>
    </div>
@endif
