@extends('admin.layout.layout')

@section('title', 'Change Password')

@section('page-title', 'Change Password')

@section('content')
<div class="container-fluid">
	<div class="row">      
      <div class="col-4">        
        <div class="card card-dark">                    
          <!-- form start -->
          <form action="" method="post">
            @csrf
            <div class="card-body">            
          	    <div class="form-group">
	                <label for="old_pswd">Old Password</label>
	                <input type="password" class="form-control" name="old_pswd" id="old_pswd" placeholder="Old Password">
	              </div>  	           	            
                <div class="form-group">
                  <label for="new_pswd">New Password</label>
                  <input type="password" class="form-control" name="new_pswd" id="new_pswd" placeholder="New Password">
                </div>                            
                <div class="form-group">
                  <label for="conf_pswd">Confirm Password</label>
                  <input type="password" class="form-control" name="conf_pswd" id="conf_pswd" placeholder="Confirm Password">
                </div>                            

	              <button type="submit" class="btn btn-dark btn-block">Submit</button>
            </div>                        
          </form>
        </div>        
      </div>      
    </div>
</div>
@endsection

@push('bottom_scripts')
<script>
$(document).ready(function(){
   // const toast = $(document).Toasts('create', {
   //   class: 'bg-success',
   //   title: 'Toast Title',
   //   subtitle: 'Subtitle',
   //   body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
   //   autohide: false
   // });
   // console.log(toast);
   // setTimeout(function(){
   //    toast.toast('hide');
   // }, 2000);
});
</script>
@endpush