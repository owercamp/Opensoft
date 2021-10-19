@if(session('Success'))
<div class="alert alert-success w-100 text-center" role="alert">
  <div>{{session('Success')}}</div>
</div>
@endif
@if(session("Error"))
<div class="alert alert-danger w-100 text-center" role="alert">
  <div>{{session('Error')}}</div>
</div>
@endif