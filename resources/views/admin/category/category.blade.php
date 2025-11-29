@extends('admin.layout.layout')

@section('title', 'Category :: News CMS V1')

@section('page-title', 'Category')

@section('content')
<div class="container-fluid">
	<div class="row">
	  <div class="col-12">	    
	    <div class="card">
	      <div class="card-header text-right">
            <a href="{{route('admin.add.category')}}" class="btn btn-outline-primary" title="Add Category">
            	<i class="nav-icon fas fa-plus"></i>
            </a>  	      	
	      </div>
	      <!-- /.card-header -->
	      <div class="card-body">
	        <table id="example1" class="table">
	          <thead>
		          <tr>
		            <th>#</th>
		            <th>Title</th>
		            <th>Desc</th>
		            <th>Img</th>		            
		            <th>M. Title</th>
		            <th>M. Keyword</th>
		            <th>Order</th>
		            <th>Status</th>
		            <th>Action</th>
		          </tr>
	          </thead>
	          <tbody>
	          	@foreach($categories as $category)
                <tr>
	                <td>{{$loop->iteration}}</td>
			          	<td>{{$category->category_title}}</td>
			          	<td>{{$category->description}}</td>
			          	<td>
			          		 @if(!is_null($category->image))
			          		    <img src="{{asset('image/category-img/'.$category->image)}}" width="60px" class="img-thumbnail">
			          		 @endif
			          	</td>
			          	<td>{{$category->meta_title}}</td>
			          	<td>{{$category->meta_keywords}}</td>
			          	<td>{{$category->order}}</td>
			          	<td>
			          		@if($category->status)
			          	    <span class="badge badge-success">Active</span>
			          	  @else
			          	    <span class="badge badge-danger">Deactive</span>
			          	  @endif
			          	</td>
			          	<td>
			          		 <a href="{{route('admin.edit.category', ['id'=>$category->id])}}" class="btn btn-outline-primary btn-sm" title="Edit Category">
				               	<i class="fas fa-edit"></i>
				             </a>
				             &nbsp;
				             <a href="{{route('admin.add.category')}}" class="btn btn-outline-danger btn-sm" title="Delete Category">
				               	<i class="fas fa-trash"></i>
				             </a> 		          		 
			          	</td>
                </tr>  
	          	@endforeach		          
	          </tbody>	         
	        </table>
	      </div>
	      <!-- /.card-body -->
	    </div>
	    <!-- /.card -->
	  </div>
	  <!-- /.col -->
	</div>
	<!-- /.row -->
</div>
@endsection

@push('style_link')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@push('scripts_link')
	<!-- DataTables  & Plugins -->
	<script src="{{asset('admin-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/jszip/jszip.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
@endpush

@push('bottom_scripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": true, 
      "autoWidth": true,      
      "ordering": false,
      "stateSave": true      
    });    
  });
</script>
@endpush

