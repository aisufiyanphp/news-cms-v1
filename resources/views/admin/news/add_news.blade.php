@extends('admin.layout.layout')

@section('title', 'Add News')

@section('page-title', 'Add News')

@section('content')
<div class="container-fluid">
  <div class="card"> 
    <div class="card-body">
      <form action="{{route('admin.submit.add.news')}}" method="post" enctype="multipart/form-data" id="addNewsForm">
      @csrf
      	<div class="row"> 
          <div class="col-lg-4">

        	    <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
              </div>  

              <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select class="custom-select rounded-0" id="category" name="category">
                        <option value="">Select Category</option>
                        @forelse($categoris as $category)
                            <option value="{{$category->id}}">{{$category->category_title}}</option>
                        @empty
                            <option value="">Category not found</option>
                        @endforelse                 
                      </select>
                    </div>  
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="sub_category">Sub Category</label>
                      <select class="custom-select rounded-0" id="sub_category" name="sub_category">
                        <option value="">Select Sub Category</option>                    
                      </select>
                    </div>
                 </div>
              </div>                                          

              <div class="row"> 
                <div class="col-md-6">
                   <div class="form-group">
                      <label>Publish Date</label>
                      <div class="input-group date" id="publish_date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#publish_date" name="publishDate" id="publishDate" />
                        <div class="input-group-append" data-target="#publish_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                   </div>
                </div>
                <div class="col-md-6">
                  <!-- <div class="bootstrap-timepicker"> -->
                    <div class="form-group">
                      <label>Publish Time</label>
                      <div class="input-group date" id="timepicker" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" name="publishTime" id="publishTime"/>
                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                      </div>                    
                    </div>                  
                  <!-- </div> -->
                </div>
              </div>

              <div class="row">
                 <div class="col-md-6">
                      <div class="form-group">
                        <label for="status">Status (Publish)</label>
                        <select class="custom-select rounded-0" id="status" name="status">
                          <option value="1">Publish</option>
                          <option value="0">Draft</option>                    
                        </select>
                      </div>     
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                        <label>Publish End Date</label>
                        <div class="input-group date" id="publish_end_date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#publish_end_date" name="publishEndDate" id="publishEndDate" />
                          <div class="input-group-append" data-target="#publish_end_date" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                     </div>
                 </div>
              </div>
              
              <div class="form-group mt-2">                    
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail"> 
                    <label class="custom-file-label" for="thumbnail">Thumbnail Img</label>
                  </div>
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
              
          </div>          
          <div class="col-lg-8">                                     
              <div class="form-group">
                  <label>Content</label>
                  <textarea class="form-control" rows="2" name="description" id="description" placeholder="Content"></textarea>
              </div>                
              <button type="submit" class="btn btn-dark btn-block">Submit</button>              
          </div>      
        </div>
      </form>
    </div> 
  </div>
</div>
@endsection

@push('style_link')
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('admin-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<style>
  .ck-editor__editable {
    min-height: 590px !important;   /* editor visible height */
    max-height: 590px !important;   /* prevent growing */
    overflow-y: auto !important;    /* show vertical scroll */
    border: 1px solid #ced4da;
    padding: 10px;
  }
</style>
@endpush

@push('scripts_link')
<script src="{{asset('admin-assets/plugins/moment/moment.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin-assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Ckeditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<!-- just validate -->
<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
@endpush

@push('bottom_scripts')
<script>
ClassicEditor
  .create(document.querySelector('#description'), {
    ckfinder: {
      //{{--uploadUrl: "{{ route('admin.news.upload-image').'?_token='.csrf_token() }}"--}}
    }
  }).catch(error => {
    console.error(error);
  });
</script>

<script>
$(document).ready(function(){

   //Date picker
   $('#publish_date, #publish_end_date').datetimepicker({
      format: 'L'
   });
   //Timepicker
   $('#timepicker').datetimepicker({
      format: 'LT'
   });

    //get sub category for showing in select box 
    $("#category").on("change", function(){
       let category = $(this).val();
       let token = "{{csrf_token()}}";
       let selectTag = $("#sub_category");
       selectTag.empty(); 
       if(category !== ""){           
           let url = '{{ route("admin.all.sub.category", ":id") }}';
           url = url.replace(':id', category);
           $.ajax({
               url: url,
               method: 'get',
               dataType: 'JSON',                              
               beforSend: function(){
                  console.log("ajax request send");
               },
               success: function(response){
                  //console.log(response);
                                 
                  if(response.status){                     
                     let subCategory = response.data;                     
                     let option;
                     subCategory.forEach(function(categoryItem){
                         option += `<option value="${categoryItem.id}">${categoryItem.title}</option>`;                         
                     });
                     selectTag.append(option);                     
                  }else{
                     selectTag.append(`<option value="">Select Sub Category</option>`);
                     Toast.fire({
                       icon: 'error',
                       title: response.msg
                     });
                  }
               },
               error: function(error){
                  console.log(error);                  
                  Toast.fire({
                     icon: 'error',
                     title: 'Technical Error! Contact to developers'
                  });
               }   
           });  

       }else{
          selectTag.append(`<option value="">Select Sub Category</option>`);          
          Toast.fire({
              icon: 'error',
              title: 'First check category exist for artical'
          });
       }       

    });

    const newsValidator = new JustValidate('#addNewsForm', {
         errorFieldCssClass: 'is-invalid', // class added to invalid fields
         successFieldCssClass: 'is-valid', // class added to valid fields
    });
    newsValidator.addField('#title', [
      {rule: 'required', errorMessage: 'News title is required'},
      {rule: 'minLength', value: 3},
      {rule: 'maxLength', value: 90}

    ]).addField('#category', [
      {rule: 'required', errorMessage: 'Select related category for artical'},
      {rule: 'number', value: 3}      

    ]).addField('#sub_category', [
      {rule: 'required', errorMessage: 'Select related category for artical'},
      {rule: 'number', value: 3}      

    ]).addField('#publishDate', [
      {rule: 'required', errorMessage: 'Artical publish date is required'},        

    ]).addField('#publishTime', [
      {rule: 'required', errorMessage: 'Artical publish time is required'},        

    ]).addField('#description', [
      {rule: 'required', errorMessage: 'Artical description is required'},        
      
    ]).onSuccess((event) => {              
       let form  = event.target;
       let formData = new FormData(form);  

       $.ajax({
           url: '{{route("admin.submit.add.news")}}',
           method: 'post',
           //dataType: 'JSON',
           data: formData,
           contentType: false,
           processData: false,
           beforeSend: function(){                           
              showBtnProcess('#addNewsForm button');
           },
           success: function(response){
              console.log(response);    

              hideBtnProcess('#addNewsForm button');              
              if(response.status){
                 event.target.reset();
                 newsValidator.refresh();
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
              hideBtnProcess('#addNewsForm button');
              Toast.fire({
                 icon: 'error',
                 title: 'Technical Error! Contact to developers'
              });
           }   
       });         
      
    });

    $('#publish_date').on('change.datetimepicker', function (e) {
      newsValidator.revalidateField('#publishDate');
    });

    $('#timepicker').on('change.datetimepicker', function (e) {
      newsValidator.revalidateField('#publishTime');
    });

});
</script>
@endpush
