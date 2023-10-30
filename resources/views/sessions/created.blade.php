@if ($success)
<div class="toast toast-center">
  <div class="alert alert-info">
    <span>Sesi&oacute;n creada satisfactoriamente.</span>
  </div>
</div>
@else
<div class="toast">
  <div class="alert alert-info">
    <span>{{ $message }}</span>
  </div>
</div>
@endif