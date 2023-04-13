@if ($message = Session::get('success'))
    <div class="card mb-4 py-3 alert alert-success show hideMe" id="hideMe" role="alert">
        <div class="card-body">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif 
    
@if ($message = Session::get('error'))
    <div class="card mb-4 py-3 alert alert-error show hideMe" id="hideMe" role="alert">
        <div class="card-body">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
     
@if ($message = Session::get('warning'))
    <div class="card mb-4 py-3 alert alert-warning show hideMe" id="hideMe" role="alert">
        <div class="card-body">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
     
@if ($message = Session::get('info'))
    <div class="card mb-4 py-3 alert alert-info show hideMe" id="hideMe" role="alert">
        <div class="card-body">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
    
@if ($errors->any())
<div class="alert alert-danger alert-dismissible show hideMe" id="hideMe" role="alert">
  <p>Please check the form below for errors</p>
  <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<script>
    setTimeout(function(){
  $('#hideMe').remove();
}, 5100);
</script>