@extends('admin.layout.layout')

@section('title', 'News :: News CMS V1')

@section('page-title', 'News')

@section('content')
<div class="container-fluid">
	<div class="row">
	  <div class="col-12">	    
	    <div class="card">
	      <div class="card-header text-right">
            <a href="{{route('admin.add.news')}}" class="btn btn-outline-primary" title="Add News">
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
		            <th>category</th>		            
		            <th>Sub Cat.</th>
		            <th>P. DateTime</th>		            
		            <th>Status</th>		            
		            <th>acton</th>
		          </tr>
	          </thead>
	          <tbody>
	          	@foreach($newsList as $news)
	          	<tr>
		          	<td>{{$loop->iteration}}</td>
		          	<td>{{$news->title}}</td>
		          	<td>{{$news->category_id}}</td>
		          	<td>{{$news->sub_category_id}}</td>
		          	<td>{{$news->publish_date}}</td>		          	
		          	<td>
		          	  <span class="badge badge-success">{{$news->status}}</span>
		          	</td>
		          	<td>
		          		 <a href="#" class="btn btn-outline-primary btn-sm" title="Edit Category">
			               	<i class="fas fa-edit"></i>
			             </a>
			             &nbsp;
			             <a href="#" class="btn btn-outline-danger btn-sm" title="Add Category">
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
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
    //.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>
@endpush

