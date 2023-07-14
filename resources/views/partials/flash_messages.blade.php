
@if(session('flash_error_message'))
<div class="alert mb-md-4 alert-danger">
    {{ session('flash_error_message') }}
</div>
@endif

@if(session('flash_success_message'))
<div class="alert mb-md-4 alert-success">
    {{ session('flash_success_message') }}
</div>
@endif

@if(session('flash_warning_message'))
<div class="alert mb-md-4 alert-warning">
    {{ session('flash_warning_message') }}
</div>
@endif
