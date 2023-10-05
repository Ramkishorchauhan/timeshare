
@extends('admin/layout')
@section('container')


    <div class="body-main-content">
        <div class="timeshare-section">
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
                                        <div class="ts-table-text">{{$ept['developer_name']}}</div>    
                                    </td>
                                    
                                    <td>
                                        @if($ept['status'] == 1)
                                            <div class="orders-price-text accepted-offer">Active</div>
                                        @else
                                            <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                                        @endif
                                    </td>
                                    
                                    <td>
										<div class="ts-table-action"><a class="view-btn btn-primary" href="#">Edit</a><!--{{ url('admin/edit-details') }}/{{ $ept['id'] }}--> <a class="view-btn btn-success" href="{{ url('admin/week-type-details') }}/{{$ept['developer_id']}}/{{ $ept['id'] }}" target="_blank">View Details</a> <a class="view-btn btn-danger" href="{{ url('admin/users-details') }}/{{ $ept['id'] }}">Delete</a></div>
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
                 <input type="hidden" class="form-control" name="developer_id" value="{{$ept['developer_id']}}">


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

