@extends('admin.layout.layout')

@section('title', 'Edit Sub Category')

@section('page-title', 'Edit Sub Cateogry')

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
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title">
              </div>  
              <div class="form-group">
                  <label for="status">Category</label>
                  <select class="custom-select rounded-0" id="status" name="status">
                    <option value="">Select Main Category</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="status">Status</label>
                  <select class="custom-select rounded-0" id="status" name="status">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>                    
                  </select>
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