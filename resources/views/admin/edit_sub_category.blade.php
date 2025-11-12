@extends('admin.layout.layout')

@section('title', 'Edit Sub Category')

@section('page-title', 'Edit Sub Cateogry')

@section('content')
<div class="container-fluid">
  <div class="row">      
      <div class="col-lg-4 col-md-8">        
        <div class="card card-dark">                    
          <!-- form start -->
          <form action="" method="post" id="editSubCategoryForm">
              @csrf
              <input type="hidden" name="subCategoryId" value="{{$subCategory[0]->id}}">
              <div class="card-body">            
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$subCategory[0]->title}}">
              </div>
              <div class="form-group">
                  <label for="status">Category</label>
                  <select class="custom-select rounded-0" id="category" name="category">
                    @forelse($categories as $category)
                      @if($subCategory[0]->category_id === $category->id)
                        <option value="{{$category->id}}" selected>{{$category->category_title}}</option>
                      @else
                        <option value="{{$category->id}}">{{$category->category_title}}</option>
                      @endif
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
                            <option value="1" @selected($subCategory[0]->status == '1')>Active</option>
                            <option value="0" @selected($subCategory[0]->status == '0')>Deactive</option>                    
                          </select>
                        </div>
                   </div>
                   <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                              <label for="title">Order</label>
                              <input type="number" min="1" class="form-control" name="order" id="order" placeholder="Category Order" value="{{$subCategory[0]->order}}">
                        </div>
                   </div>
              </div>              
              <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" rows="2" placeholder="Description">{{$subCategory[0]->description}}</textarea>
              </div>
              <div class="form-group">
                  <label for="title">Meta Title</label>
                  <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" value="{{$subCategory[0]->meta_title}}">
              </div>
              <div class="form-group">
                  <label>Meta Keyword (comma seprated)</label>
                  <textarea class="form-control" rows="2" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword">{{$subCategory[0]->meta_keywords}}</textarea>
              </div>
              <div class="form-group">
                  <label>Meta Description</label>
                  <textarea class="form-control" rows="2" name="meta_description" placeholder="Meta Description">{{$subCategory[0]->meta_description}}</textarea>
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

    const categoryValidator = new JustValidate('#editSubCategoryForm', {
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
           url: '{{route("admin.submit.edit.sub.category")}}',
           method: 'post',
           //dataType: 'JSON',
           data: formData,
           contentType: false,
           processData: false,
           beforSend: function(){
              showBtnProcess('#editSubCategoryForm button');
           },
           success: function(response){              
              hideBtnProcess('#editSubCategoryForm button');                            
              if(response.status){                                             
                 Toast.fire({
                   icon: 'success',
                   title: response.msg
                 });
                 setTimeout(function(){
                   window.location.href = "{{route('admin.sub.category.list')}}";
                 }, 2000);
                 
              }else{                 
                 Toast.fire({
                   icon: 'error',
                   title: response.msg
                 });
              }
           },
           error: function(error){
              console.log(error);
              hideBtnProcess('#editSubCategoryForm button');
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