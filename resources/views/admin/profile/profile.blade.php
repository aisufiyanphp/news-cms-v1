@extends('admin.layout.layout')

@section('title', 'Profile')

@section('page-title', 'Profile')

@section('content')
<div class="container-fluid">
	<div class="row">      
      <div class="col-4">        
        <div class="card card-dark">                    
          <!-- form start -->
          <form action="" method="post" id="profileForm">
            @csrf
            <div class="card-body">            
          	    <div class="form-group">
	                <label for="name">Name</label>
	                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$admin[0]->name}}">
	              </div>  	           	            
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" value="{{$admin[0]->email}}">
                </div>                            
                <div class="form-group">
                  <label for="number">Mobile Number</label>
                  <input type="text" class="form-control" name="number" id="number" placeholder="Mobile" value="{{$admin[0]->mobile}}">
                </div>                            

	              <button type="submit" id class="btn btn-dark btn-block">Submit</button>
            </div>                        
          </form>
        </div>        
      </div>      
    </div>
</div>
@endsection

@push('scripts_link')
<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
@endpush

@push('bottom_scripts')
<script>
$(document).ready(function(){
   const profileValidator = new JustValidate('#profileForm');

   profileValidator.addField('#name', [
    { rule: 'required', errorMessage: 'Name Field is required'  }
    { rule: 'minLength', value:   }
   ])
   .onSuccess((event) => {
      // event.preventDefault();
      console.log('✅ Validation passed and button was clicked!');
      // 👉 put your button click logic here
   });

});  
// document.addEventListener('DOMContentLoaded', function(){
// const profileValidator = new JustValidate('#profileForm');
//});  
</script>
@endpush