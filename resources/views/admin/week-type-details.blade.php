
@extends('admin/layout')
@section('container')

 
    <div class="body-main-content">
        <div class="timeshare-section">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.manage-developers')}}">Developers</a></li>
                    <li class="breadcrumb-item"><a href="{{URL('admin/developer-details/'.$page_data['enroll_id'])}}">Developer's Enroll Type</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$page_data['page_title']}}</li>
                </ol>   
            </nav>
            <div class="timeshare-header">
                <div class="mr-auto">
                    <h4 class="heading-title">Manage Developers Week Points Type</h4>
                </div>
                <div class="ts-filter wd30">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#Createenrollpoints">Create Week Points</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="timeshare-card-body">
                    <div class="orders-table ts-table">
                        <table class="table rejected-stimates-item">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Enroll Type Name</th>
                                    <th>Developer Name</th>                                           
                                    <th>Status</th>                                            
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id = "row">
								@if(count($week_point_type)< 1)									
									<tr><td colspan="4" class="text-center">Data Not Available</td></tr>
								@else
                                @foreach($week_point_type as $wpt)
                                <tr>
                                    <td><div class="ts-table-text">{{$wpt['point_type_title']}}</div></td>
                                    @foreach($enroll_type as $et)                                      
                                        @if($et['id'] ==$page_data['enroll_id'])
                                           <td><div class="ts-table-text">{{$et['point_type_title']}}</div></td>                        
                                        @endif
                                    @endforeach  
                                    <td>
										@foreach($developers as $dev)
                                       
										@if($dev['id'] ==$wpt['developer_id'])
                                        <div class="ts-table-text">{{$dev['name']}}</div> 
										@endif
                                        @endforeach									
                                    </td>
                                    
                                    <td>
                                        @if($wpt['status'] == 1)
                                            <div class="orders-price-text accepted-offer">Active</div>
                                        @else
                                            <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                                        @endif
                                    </td>
                                    
                                    <td>
										<div class="ts-table-action">
                                        <button class="edit-details" value="{{ $wpt['id'] }}"> Edit</button> 
                                        <input type="hidden" id="baseurl" value="{{url('admin/edit-week-type')}}" >
                                        <a class="view-btn btn-success" href="{{ url('admin/ownership-type-detail') }}/{{$wpt['developer_id']}}/{{$wpt['enrolled_point_type_id']}}/{{ $wpt['id'] }}">View Details</a> <a class="view-btn btn-danger" href="{{ url('admin/delete-weektype') }}/{{ $wpt['id'] }}">Delete</a></div>
                                    </td>
                                </tr>
                        
								@endforeach
								@endif
                            </tbody>
                        </table>
                        
                    </div>
                </div>               
            </div>  
        </div>
    </div>



    
 <!-- Start  Create New Enrollpoints Type -->
<div class="modal lm-modal fade" id="Createenrollpoints" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create New Developers Week  Points</h2>
            <form action="{{route('admin.weeklyType-registration')}}" class="developers_form" id="add_developer" method="post" enctype="multipart/form-data">
                @csrf 
            <div class="row">
			<input type="hidden"  name="developer_id" value="{{$page_data['developer_id']}}">
            <input type="hidden"  name="enrolled_point_type_id" value="{{$page_data['enroll_id']}}">
				<div class="col-md-6">	
                <div class="form-group">
                <label>Developer Name</label> 
                    @foreach($developers as $dev)                                       
                        @if($dev['id'] ==$page_data['developer_id'])
                        <input type="text" class="form-control"  name="developer_name" value="{{$dev['name']}}" disabled>
                        @endif
                    @endforeach	
                    </div>
                </div>
				
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Enroll Point Type</label>
                    @foreach($enroll_type as $et)                                      
                        @if($et['id'] ==$page_data['enroll_id'])
                            <input type="text" class="form-control"  name="enrolled_point_type_id" value="{{$et['point_type_title']}}" disabled>                        
                        @endif
                    @endforeach   
                   </div>
                </div>


                <div class="col-md-7">
                    <div class="form-group">
                    <label>Enroll Week Type</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Developer Enroll Points Type" name="point_type_title" required>
                            <!--span class="{{$errors->first('name')?'error invalid-feedback':''}}">{{$errors->first('name')}}</span-->
                    </div>
                </div>
                
                
                <div class="col-md-5">
                    <div class="form-group">
                    <label>Status</label>
                        <select class="form-control" aria-label="Default select example" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                                
                <div class="col-md-12">
                    <div class="form-group">
                       <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <button class="save-btn">Add New Week Type</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End  Enroll Type  -->


  <!-- edit Developers -->
<div class="modal lm-modal fade" id="editweektype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create New Developers Week  Points</h2>
            <form action="{{route('admin.update-weektype')}}" class="developers_form" id="add_developer" method="post" enctype="multipart/form-data">
                @csrf 
            <div class="row">
			<input type="hidden"  name="week_id" id="week_id">
            <input type="hidden"  name="developer_id" id="developer_id"  >
            <input type="hidden"  name="enrolled_point_type_id" value="{{$page_data['enroll_id']}}">
				<div class="col-md-6">	
                    <div class="form-group">
                        <label>Developer Name</label>                     
                        <input type="text" class="form-control" id="developer_name"  name="developer_name" disabled>
                   </div>
                </div>
				
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Enroll Point Type</label>
                   
                            <input type="text" class="form-control" id="enroll_name" name="enroll_name" disabled>                        
                        
                   </div>
                </div>


                <div class="col-md-7">
                    <div class="form-group">
                    <label>Enroll Week Type</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Developer Enroll Points Type" id="week_type_title" name="point_type_title" required>
                            <!--span class="{{$errors->first('name')?'error invalid-feedback':''}}">{{$errors->first('name')}}</span-->
                    </div>
                </div>
                
                
                <div class="col-md-5">
                    <div class="form-group">
                    <label>Status</label>
                        <select class="form-control" aria-label="Default select example" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                                
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="button" class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>                       
                       <button class="save-btn">Update Week Type</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div> 
@endsection


@section('scripts')
<script type="application/javascript">
    
 $(document).ready(function() {
    $(document).on('click','.edit-details',function() {
	    var weekid=$(this).val();
       var url= $('#baseurl').val();

       //alert(url);
        $("#editweektype").modal('show');
        $.ajax({
			url : `${url}/${weekid}`,
			type : 'GET',
			
			success : function(res){
				//alert('<img src="'+path + res.developers.logo + '" />');
                let weektype = res.weektype[0]
                $('#week_id').val(weektype.id);
                
                $('#developer_id').val(weektype.developer_id);
                $('#developer_name').val(weektype.developer_name);
                $('#enrolled_point_type_id').val(weektype.enrolled_point_type_id);
                $('#enroll_name').val(weektype.enroll_name);
                $('#week_type_title').val(weektype.point_type_title);
                $('#status').val(weektype.status);
                
        	}
		});
        
	});

    
});
</script>

@endsection

