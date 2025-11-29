@extends('admin.layout.layout')

@section('title', 'Edit Category')

@section('page-title', 'Edit Cateogry')

@section('content')
<div class="container-fluid">
  <div class="row">      
      <div class="col-lg-4 col-md-8">        
        <div class="card card-dark">                    
          <!-- form start -->
          <form action="{{route('admin.submit.edit.category')}}" method="post" id="editCategoryForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" value="{{$category[0]->id}}">            
            <div class="card-body">            
               <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$category[0]->category_title}}">
               </div>
               <div class="row">
                 <div class="col-md-6 col-sm-12">
                     <div class="form-group">
                        <label for="status">Status</label>
                        <select class="custom-select rounded-0" id="status" name="status">
                          <option value="1" @selected($category[0]->status == '1')>Active</option>
                          <option value="0" @selected($category[0]->status == '0')>Deactive</option>                    
                        </select>
                     </div>    
                 </div>
                 <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                          <label for="title">Order</label>
                          <input type="number" min="1" class="form-control" name="order" id="order" placeholder="Category Order" value="{{$category[0]->order}}">
                      </div>
                 </div>
               </div>     
               <div class="form-group mt-2">                    
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail"> 
                    <label class="custom-file-label" for="thumbnail">Thumbnail Img (optional)</label>
                  </div>
                  @if(!is_null($category[0]->image))
                     <img src="{{asset('image/category-img/'.$category[0]->image)}}" width="60px" class="img-thumbnail">
                  @endif
               </div>                  
               <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" rows="2" placeholder="Description">{{$category[0]->description}}</textarea>
               </div>
               <div class="form-group">
                  <label for="title">Meta Title</label>
                  <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" value="{{$category[0]->meta_title}}">
               </div>
               <div class="form-group">
                  <label>Meta Keyword (comma seprated)</label>
                  <textarea class="form-control" rows="2" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword">{{$category[0]->meta_keywords}}</textarea>
               </div>
               <div class="form-group">
                  <label>Meta Description</label>
                  <textarea class="form-control" rows="2" name="meta_description" placeholder="Meta Description">{{$category[0]->meta_description}}</textarea>
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

    const categoryValidator = new JustValidate('#editCategoryForm', {
         errorFieldCssClass: 'is-invalid', // class added to invalid fields
         successFieldCssClass: 'is-valid', // class added to valid fields
    });
    categoryValidator.addField('#title', [
      {rule: 'required', errorMessage:'Category title is required'},
      {rule: 'minLength', value: 3}

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
           url: '{{route("admin.submit.edit.category")}}',
           method: 'post',
           //dataType: 'JSON',
           data: formData,
           contentType: false,
           processData: false,
           beforSend: function(){
              showBtnProcess('#editCategoryForm button');
           },
           success: function(response){
              console.log(response);
              hideBtnProcess('#editCategoryForm button');  
                                                      
              if(response.status){                 
                 Toast.fire({
                   icon: 'success',
                   title: response.msg
                 });
                 setTimeout(function(){
                   window.location.href = "{{route('admin.category.list')}}";                 
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
              hideBtnProcess('#editCategoryForm button');
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