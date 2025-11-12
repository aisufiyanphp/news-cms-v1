@extends('admin.layout.layout')

@section('title', 'Add Sub Category')

@section('page-title', 'Add Sub Cateogry')

@section('content')
<div class="container-fluid">
	<div class="row">      
      <div class="col-lg-4 col-md-8">        
        <div class="card card-dark">                    
          <!-- form start -->
          <form action="" method="post" id="addSubCategoryForm">
            @csrf
            <div class="card-body">            
          	    <div class="form-group">
	                <label for="title">Title</label>
	                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
	              </div>  
                <div class="form-group">
                  <label for="status">Category</label>
                  <select class="custom-select rounded-0" id="category" name="category">
                    @forelse($categories as $category)
                      <option value="{{$category->id}}">{{$category->category_title}}</option>
                    @empty 
                      <option value="">Category not found (First Create)</option> 
                    @endforelse  
                  </select>
                </div>
                <div class="row">
                   <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="status">Status</label>
                          <select class="custom-select rounded-0" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>                    
                          </select>
                        </div>
                   </div>
                   <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                              <label for="title">Order</label>
                              <input type="number" min="1" class="form-control" name="order" id="order" placeholder="Category Order">
                        </div>
                   </div>
                </div>	              
	              <div class="form-group">
	                <label>Description</label>
	                <textarea class="form-control" name="description" id="description" rows="2" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
	                <label for="title">Meta Title</label>
	                <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title">
	              </div>
	              <div class="form-group">
	                <label>Meta Keyword (comma seprated)</label>
	                <textarea class="form-control" rows="2" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword"></textarea>
                </div>
                <div class="form-group">
	                <label>Meta Description</label>
	                <textarea class="form-control" rows="2" name="meta_description" placeholder="Meta Description"></textarea>
                </div>  

	            <button type="submit" class="btn btn-dark btn-block">Submit</button>
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

    const categoryValidator = new JustValidate('#addSubCategoryForm', {
          errorFieldCssClass: 'is-invalid', // class added to invalid fields
          successFieldCssClass: 'is-valid', // class added to valid fields
    });
    categoryValidator.addField('#title', [
      {rule: 'required', errorMessage:'Category title is required'},
      {rule: 'minLength', value: 3}

    ]).addField('#category', [
       {rule: 'required', errorMessage: 'Category is required'},
       {rule: 'number'},
       {rule: 'minNumber', value: 1}

    ]).addField('#order', [
       {rule: 'required', errorMessage: 'Category Order is required'},
       {rule: 'number'},
       {rule: 'minNumber', value: 1}

    ]).addField('#description', [
       {rule: 'required', errorMessage: 'Category description is required'},
       {rule: 'maxLength', value: 150}

    ]).onSuccess((event) => {              
       let form  = event.target;
       let formData = new FormData(form);       

       $.ajax({
           url: '{{route("admin.submit.add.sub.category")}}',
           method: 'post',
           //dataType: 'JSON',
           data: formData,
           contentType: false,
           processData: false,
           beforSend: function(){
              showBtnProcess('#addSubCategoryForm button');
           },
           success: function(response){
              console.log(response);
              return false;
              hideBtnProcess('#addSubCategoryForm button');              
              if(response.status){
                 event.target.reset();
                 categoryValidator.refresh();
                 Toast.fire({
                   icon: 'success',
                   title: response.msg
                 });
              }else{
                 Toast.fire({
                   icon: 'error',
                   title: response.msg
                 });
              }
           },
           error: function(error){
              console.log(error);
              hideBtnProcess('#addSubCategoryForm button');
              Toast.fire({
                 icon: 'error',
                 title: 'Technical Error! Contact to developers'
              });
           }   
       });

    });

});

</script>
@endpush