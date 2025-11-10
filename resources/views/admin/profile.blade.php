@extends('admin.layout.layout')

@section('title', 'Profile')

@section('page-title', 'Profile')

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
	                <label for="name">Name</label>
	                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
	              </div>  	           	            
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
                </div>                            
                <div class="form-group">
                  <label for="number">Mobile Number</label>
                  <input type="text" class="form-control" name="number" id="number" placeholder="Mobile">
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