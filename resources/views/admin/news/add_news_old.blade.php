@extends('admin.layout.layout')

@section('title', 'Add News')

@section('page-title', 'Add News')

@section('content')
<div class="container-fluid">
	<div class="row">      
    <div class="col-md-4">        
      <div class="card card-dark">                    
        <!-- form start -->
        <form action="" method="post">
          @csrf
          <div class="card-body">            
        	    <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
              </div>  
              <div class="form-group">
                <label for="category">Category</label>
                <select class="custom-select rounded-0" id="category" name="category">
                  <option value="">Select Category</option>                    
                </select>
              </div>
              <div class="form-group">
                <label for="sub_category">Sub Category</label>
                <select class="custom-select rounded-0" id="sub_category" name="sub_category">
                  <option value="">Select Sub Category</option>                    
                </select>
              </div>
              <div class="form-group">
                <label for="status">Status (Publish)</label>
                <select class="custom-select rounded-0" id="status" name="status">
                  <option value="1">Publish</option>
                  <option value="0">Draft</option>                    
                </select>
              </div>
              <div class="row"> 
                <div class="col-md-6">
                   <div class="form-group">
                      <label>Publish Date</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                   </div>
                </div>
                <div class="col-md-6">
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Publish Time</label>
                      <div class="input-group date" id="timepicker" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"/>
                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                      </div>                    
                    </div>                  
                  </div>
                </div>
              </div>
              
              <div class="form-group mt-1">                    
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Thumbnail Img</label>
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
        </form>
      </div>        
    </div>
    <div class="col-md-8">
        <!-- <textarea name="content" id="content"></textarea> -->
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="2" name="content" id="content" placeholder="Content"></textarea>
        </div>  
        
        <button type="submit" class="btn btn-dark btn-block">Submit</button>
    </div>      
  </div>
</div>
@endsection

@push('style_link')
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('admin-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<style>
  .ck-editor__editable {
    min-height: 600px !important; /* increase height */
  }
</style>
@endpush

@push('scripts_link')
<script src="{{asset('admin-assets/plugins/moment/moment.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin-assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Ckeditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@endpush

@push('bottom_scripts')
<script>
$(document).ready(function(){
   //Date picker
   $('#reservationdate').datetimepicker({
      format: 'L'
   });
   //Timepicker
   $('#timepicker').datetimepicker({
      format: 'LT'
   });

});
</script>
<script>
ClassicEditor
  .create(document.querySelector('#content'), {
    ckfinder: {
      //{{--uploadUrl: "{{ route('admin.news.upload-image').'?_token='.csrf_token() }}"--}}
    }
  }).catch(error => {
    console.error(error);
  });
</script>
@endpush
