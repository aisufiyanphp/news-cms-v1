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
	        <table id="NewsTalbe" class="table">
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
	          	{{--@foreach($newsList as $news)
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
		          		 <a href="{{route('admin.edit.news', ['id'=>$news->id])}}" class="btn btn-outline-primary btn-sm" title="Edit News">
			               	<i class="fas fa-edit"></i>
			             </a>
			             &nbsp;
			             <a href="{{route('admin.news.detail', ['id'=>$news->id])}}" class="btn btn-outline-info btn-sm" title="News Detail">
			               	<i class="fas fa-eye"></i>
			             </a>
			             &nbsp;
			             <a href="#" class="btn btn-outline-danger btn-sm" title="Add Category">
			               	<i class="fas fa-trash"></i>
			             </a> 		          		 
		          	</td>
		          </tr>	          	
	          	@endforeach--}}		          
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

  	
    var detailUrl = "{{ url('admin/news/detail') }}/";

    $("#NewsTalbe").DataTable({
      "responsive": true,
      "lengthChange": true, 
      "autoWidth": true,      
      "ordering": false,      
      'processing': true,
      'serverSide': true,
      ajax: {
      	 url: "{{route('admin.get.news')}}",
      	 type: "post",
      	 data: {_token: "{{csrf_token()}}"},
      	 dataSrc: function (json) {
            //console.log(json); // <-- PRINT HERE
            return json.data;
         },
         error: function(error){
         	  console.log(error);
         }               	
      }, 
      columns: [
       	  {data: null, 
       	    render: function (data, type, row, meta) {               
               return meta.row + 1; 
            }
          },
       	  {data: 'title'},
       	  {data:'category.category_title'},
       	  {data:'sub_category.title'},       	  
       	  {
       	  	data: null, 
       	  	render: function(data, type, row, meta){
                return row.publish_date+" "+row.publish_time;
       	  	}
       	  },
       	  {
       	    data:'status',
       	    render: function(status){
               return status == 1 ? '<span class="badge badge-success">Publish</span>' : '<span class="badge badge-danger">Draft</span>';
       	    }
       	  },
       	  { 
       	  	data: 'id',
       	  	orderable: false, 
       	  	searchable: false,
       	  	render: function(id){
       	  		  let editUrl = "{{ url('admin/edit-news') }}/";
       	  		  let viewUrl = "{{ url('admin/news-detail') }}/";
                return `
                  <a href="${editUrl}${id}" class="btn btn-outline-primary btn-sm" title="Edit News">
			               	<i class="fas fa-edit"></i>
			            </a>
			            &nbsp;
			            <a href="${viewUrl}${id}" class="btn btn-outline-info btn-sm" title="View News">
			               	<i class="fas fa-eye"></i>
			            </a>
			            &nbsp;
			            <a href="#" class="btn btn-outline-danger btn-sm" title="Delete News">
			               	<i class="fas fa-trash"></i>
			            </a>
               `;
       	  	} 
       	  }
      ]
    });    

  });
</script>
@endpush

