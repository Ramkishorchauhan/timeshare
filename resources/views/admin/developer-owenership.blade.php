
@extends('admin/layout')
@section('container')


    <div class="body-main-content">
        <div class="timeshare-section">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.manage-developers')}}">Developers</a></li>
                    <li class="breadcrumb-item"><a href="{{URL('admin/developer-details/'.$page_data['enroll_id'])}}">Developer's Enroll Type</a></li>
                    <li class="breadcrumb-item"><a href="{{URL('admin/week-type-details/'.$page_data['developer_id'].'/'.$page_data['enroll_id'])}}">Developer's Week Type</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$page_data['page_title']}}</li>
                </ol>   
            </nav>
            <div class="timeshare-header">
                <div class="mr-auto">
                    <h4 class="heading-title">Manage Developers OwenerShip Level Type</h4>
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
									<th>OwenerShip Name </th>
									<th>Developer Name</th>
									<th>Weekly Points Type</th>
									<th>Enroll Points Type</th>
									<th>Point Range</th>
									<th>Maximum Points</th>                                                                          
									<th>Status</th>                                            
									<th>Action</th>
								</tr>
							</thead>
                            <tbody id = "row">
							@if(count($owenership_level)< 1)
								
									<tr ><td colspan="8" class="text-center">Data Not Available</td></tr>
								@else
									@foreach($owenership_level as $wpt)
									<tr>
										<td><div class="ts-table-text">{{$wpt['ownership_type']}}</div></td>
										<td>
											<div class="ts-table-text">{{$wpt['developer_name']}}</div>    
										</td>
											@if($wpt->point_type_title == '')
												<td><div class="ts-table-text">N/A</div></td>
											@else
												<td><div class="ts-table-text">{{$wpt['point_type_title']}}</div></td>
											@endif
											@if($wpt->enrolled_point_types == '')
												<td><div class="ts-table-text">N/A</div></td>
											@else
												<td><div class="ts-table-text">{{$wpt['enrolled_point_types']}}</div></td>
											@endif
											@if($wpt->min_points == '')
												<td><div class="ts-table-text">N/A</div></td>
											@else
												<td><div class="ts-table-text">{{$wpt['min_points']}}</div></td>
											@endif
											
											@if($wpt->max_points == '')
												<td><div class="ts-table-text">N/A</div></td>
											@else
												<td><div class="ts-table-text">{{$wpt['max_points']}}</div></td>  
											@endif
										
										<td>
											@if($wpt['status'] == 1) 
												<div class="orders-price-text accepted-offer">Active</div>
											@else
												<div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
											@endif
										</td>
										
										<td>
											<div class="ts-table-action"><a class="view-btn btn-primary" href="{{ url('admin/edit-details') }}/{{ $wpt['id'] }}">Edit</a>  <a class="view-btn btn-danger" href="{{ url('admin/users-details') }}/{{ $wpt['id'] }}">Delete</a></div>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="developer_id" required>
                            <option value="" selected>Select Developers</option>
                            @foreach($developers as $dev)
                            <option value="{{$dev->id}}">{{$dev->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


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


  <!-- edit Developers -->
<div class="modal lm-modal fade" id="editDevelopers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Edit Developers</h2>
            
            <form action="{{route('admin.update-developer')}}"  method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <input type="hidden" name="id" id="developer_id">
                <input type="hidden" name="created_by" value="{{ request()->session()->get('USER_ID') }}">
                <ul class="alert alert-warning d-none" id="update_errorList"></ul>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name">
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="location" id="location">
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

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="upload-signature">
                            <input type="file" name="logo" id="Upload Developer LOGO IMG" class="uploadsignature1 addsignature1">
                            <label for="Upload Developer LOGO IMG">
                                <div class="signature-text" > 
                                    <span id="logo_img" class="logo_img">Developer LOGO</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="upload-signature">
                            <input type="file" name="pdf" id="pdf" class="uploadsignature1 addsignature1">
                            <label for="Upload Developer Contract PDF">
                                <div class="signature-text">                                     
                                    <span id="pdffile" class="pdffile">Developer Contract</span>
                                </div>
                            </label>
                        </div>
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
    var pathlogo = "{!! asset('public/storage/developors_logo/')!!}";
    var pathpdf = "{!! asset('public/storage/developors_pdf/')!!}";
    
 $(document).ready(function() {
    $(document).on('click','.Edit-btn',function() {
	    var developer_id=$(this).val();
        //alert(developer_id);
       
        $("#editDevelopers").modal('show');
        $.ajax({
			url : "edit-developer/"+developer_id,
			type : 'GET',
			
			success : function(res){
				//alert('<img src="'+path + res.developers.logo + '" />');
                $('#developer_id').val(res.developers.id);
                $('#name').val(res.developers.name);
                $('#location').val(res.developers.location);
                $('#status').val(res.developers.status);
                $('#created_by').val(res.developers.created_by);
                $('#logo_img').append('<img src="'+pathlogo +'/'+res.developers.logo + '" />');
                $('#pdffile').append('<img src="'+pathpdf +'/'+ res.developers.pdf + '" />');

        	}
		});
        
	});

    
});
</script>

<script>
$(document).ready(function() {
    
    $("#developer_id").change(function() {
        var id = $(this).children(":selected").attr("id");
        
        $.ajax({
			url : "enroll_points_by_id/"+id,
			type : 'GET',
			
			success : function(res){
                if(res.enroll.length != 0) {
                    $(".enrollpointtype").attr("style", "display:block");
                    document.querySelector('.enrollpointtypeid').innerHTML = '';
                    $('.enrollpointtypeid').append('<option>Select Enroll Points Type</option>');
                    $.each(res.enroll, function (i, p) {
                        $('.enrollpointtypeid').append($('<option></option>').val(p.id).html(p.point_type_title));
                    });
                }else{
                    $(".enrollpointtype ").attr("style", "display:none");
                    document.querySelector('.enrollpointtypeid').innerHTML = '';
                    $(".weeklytype").attr("style", "display:none");
                    document.querySelector('.weeklytypeid').innerHTML = '';
                }

        	}
		});
    });
    
});
</script>

<script>
$(document).ready(function() {
    
    $("#enroll_type_id").change(function() {
        var id = $(this).children(":selected").val();
        // alert(id);
        $.ajax({
			url : "weekly_type_by_id/"+id,
			type : 'GET',
			
			success : function(res){
                console.log(res);
                if(res.weekly.length != 0) {
                    $(".weeklytype").attr("style", "display:block");
                    document.querySelector('.weeklytypeid').innerHTML = '';
                    $('.weeklytypeid').append('<option>Select Week Points Type</option>');
                    $.each(res.weekly, function (i, p) {
                        $('.weeklytypeid').append($('<option></option>').val(p.id).html(p.point_type_title));
                    });
                }else{
                    $(".weeklytype").attr("style", "display:none");
                    document.querySelector('.weeklytypeid').innerHTML = '';
                }

        	}
		});
    });
    
});
</script>

<script>
$(document).ready(function() {
    
    $("#developerid").change(function() {
        var id = $(this).children(":selected").val();
        // alert(id);
        $.ajax({
			url : "get_weekly_type_by_id/"+id,
			type : 'GET',
			
			success : function(res){
                console.log(res);
                if(res.enrollid.length != 0) {
                    $(".enrollpointstype").attr("style", "display:block");
                    document.querySelector('.enrolledpointid').innerHTML = '';
                    $('.enrolledpointid').append('<option>Select Developer Enroll Points Type</option>');
                    $.each(res.enrollid, function (i, p) {
                        $('.enrolledpointid').append($('<option></option>').val(p.id).html(p.point_type_title));
                    });
                }else{
                    $(".enrollpointstype").attr("style", "display:none");
                    document.querySelector('.enrolledpointid').innerHTML = '';
                }

        	}
		});
    });
    
});
</script>

@endsection

