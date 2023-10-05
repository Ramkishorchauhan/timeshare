
@extends('admin/layout')
@section('container')


    <div class="body-main-content">
        <div class="timeshare-section">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.manage-developers')}}">Developers</a></li>
                    @foreach($developers as $developer)
                        @if($developer->id==$page_data['developer_id'])
                        <li class="breadcrumb-item active" aria-current="page">{{$developer->name}} {{$page_data['page_title']}}</li>
                        @endif
                    @endforeach
                </ol>   
            </nav>
            <div class="timeshare-header">                
                <div class="mr-auto">
                    <h4 class="heading-title">Manage Developers Enroll Points Type</h4>
                </div>
                <div class="ts-filter wd30">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#Createenrollpoints">Create Enroll Points</a>
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
                                    <th>Enroll Type</th>
                                    <th>Developer Name</th>                                           
                                    <th>Status</th>                                            
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id = "row">
								@if(count($enrolled_point_type)< 1)									
									<tr><td colspan="4" class="text-center">Data Not Available</td></tr>					
								@else

                                @foreach($enrolled_point_type as $ept)
                                <tr>
                                    <td><div class="ts-table-text">{{$ept['point_type_title']}}</div></td>
                                    <td>
                                    @foreach($developers as $developer)
                                        @if($developer->id==$page_data['developer_id'])
                                            <div class="ts-table-text">{{$developer->name}}</div>
                                        @endif
                                    @endforeach
                                            
                                    </td>
                                    
                                    <td>
                                        @if($ept['status'] == 1)
                                            <div class="orders-price-text accepted-offer">Active</div>
                                        @else
                                            <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                                        @endif
                                    </td>
                                    
                                    <td>
										<div class="ts-table-action">
                                            <button class="edit-details" value="{{ $ept['id'] }}"> Edit </button>
                                            <input type="hidden" id="baseurl" value="{{url('admin/edit-enroll/')}}" >
                                            <a class="view-btn btn-success" href="{{ url('admin/week-type-details') }}/{{$ept['developer_id']}}/{{ $ept['id'] }}">View Details</a> <a class="view-btn btn-danger" href="{{ url('admin/delete-enrolled-type') }}/{{ $ept['id'] }}">Delete</a>
                                        </div>
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
            <h2>Create New Developers Enroll Points</h2>
            <form action="{{route('admin.enrollpoints-registration')}}" class="developers_form" id="add_developer" method="post" enctype="multipart/form-data">
                @csrf 
            <div class="row">              
                 <input type="hidden" class="form-control" name="developer_id" value="{{$page_data['developer_id']}}">


                <div class="col-md-7">
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Developer Enroll Points Type" name="point_type_title" required>
                            <!--span class="{{$errors->first('name')?'error invalid-feedback':''}}">{{$errors->first('name')}}</span-->
                    </div>
                </div>
                
                
                <div class="col-md-5">
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                                
                <div class="col-md-12">
                    <div class="form-group">
                       <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <button class="save-btn">Add New Enroll</button>
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




<div class="modal lm-modal fade" id="editenrolltype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Edit Enroll Type</h2>
            
            <form action="{{route('admin.update-enrolled-type')}}"  method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                 <input type="hidden" name="id" id="id"> 
                <input type="hidden" name="developer_id" id="developer_id">                
                <ul class="alert alert-warning d-none" id="update_errorList"></ul>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name">
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="point_type_title" id="point_type_title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" id="status" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>               

                
                
                <div class="col-md-12">
                    <div class="form-group">
                       <button type="button" class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <button  class="save-btn">Save</button>
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
	    var enrollid=$(this).val();
        var url= $('#baseurl').val();

       //alert(url);
        $("#editenrolltype").modal('show');
        $.ajax({
			url : `${url}/${enrollid}`,
			type : 'GET',
			
			success : function(res){
				//alert('<img src="'+path + res.developers.logo + '" />');
                let enroll = res.enroll[0]
                $('#id').val(enroll.id);
                
                $('#developer_id').val(enroll.developer_id);
                $('#name').val(enroll.developer_name);
                $('#point_type_title').val(enroll.point_type_title);
                $('#status').val(enroll.status);
                $('#created_by').val(enroll.created_at);
                
        	}
		});
        
	});

    
});
</script>

@endsection

