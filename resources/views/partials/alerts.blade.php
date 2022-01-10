@if(session('Success'))
<div class="alert alert-success w-100 text-center" role="alert">
  <div>{{session('Success')}}</div>
  <script>
    function reload() {
      window.location.reload()
    }
    window.onload = setTimeout(reload, 5000);
  </script>
</div>
@elseif(session("Error"))
<div class="alert alert-danger w-100 text-center" role="alert">
  <div>{{session('Error')}}</div>
  <script>
    function reload() {
      window.location.reload()
    }
    window.onload = setTimeout(reload, 5000);
  </script>
</div>
@elseif(session("Update"))
<div class="alert alert-primary w-100 text-center" role="alert">
  <div>{{session('Update')}}</div>
  <script>
    function reload() {
      window.location.reload()
    }
    window.onload = setTimeout(reload, 5000);
  </script>
</div>
@elseif(session("Delete"))
<div class="alert alert-warning w-100 text-center" role="alert">
  <div>{{session('Delete')}}</div>
  <script>
    function reload() {
      window.location.reload()
    }
    window.onload = setTimeout(reload, 5000);
  </script>
</div>
@elseif(session("Info"))
<div class="alert alert-info w-100 text-center" role="alert">
  <div>{{session('Info')}}</div>
  <script>
    function reload() {
      window.location.reload()
    }
    window.onload = setTimeout(reload, 5000);
  </script>
</div>
@endif