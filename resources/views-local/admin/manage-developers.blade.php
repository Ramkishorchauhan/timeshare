@extends('admin/layout')
@section('container')

    <div class="body-main-content">
        <div class="timeshare-section">
            <div class="timeshare-header">
                <div class="mr-auto">
                    <h4 class="heading-title">Manage Developers</h4>
                </div>
                <div class="ts-filter wd30">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#CreateDevelopers">Create New Developers</a>
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
                @foreach($developers as $developer)
                <div class="col-md-4">
                    <div class="manage-developers-item">
                        <div class="manage-developers-comp-info">
                            <div class="manage-developers-comp-image">
                                <!--img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}"-->
                                <img src="{{asset('storage/app/public/developors_logo/'.$developer['logo'])}}" alt="">
                                
                            </div>
                            <div class="manage-developers-comp-content">
                                <div class="manage-developers-comp-name">{{$developer['name']}}</div>
                                <div class="manage-developers-location"><img src="{{asset('public/admin_assets/images/location.svg')}}"> {{$developer['location']}} </div>
                                <div class="manage-developers-PDF"><a target="_blank" href="{{asset('public/storage/developors_pdf/'.$developer['pdf'])}}"><img src="{{asset('public/admin_assets/images/PDF_file_icon.svg')}}">View PDF</a></div>
                            </div>
                        </div>
                        <div class="manage-developers-action">
                            <button type="button" value="{{$developer['id']}}" class="view-btn"> 
					 			Edit Details
                            </button>
                            <!--a href="#" onclick="edit_record(this)" data--bs-target="#editDevelopers" data-toggle="modal" data-id="{{$developer['id']}}">abc2</a>
                            <a data-bs-toggle="modal" id="{{$developer['id']}}" href="javascript:void(0)" onclick="edit_record({{$developer['id']}})" class="Edit-btn" data-bs-target="#editDevelopers">Edit Developer Details</a-->
							<a  target="_blank" href="{{ url('admin/developer-details') }}/{{ $developer['id'] }}"  class="view-btn">View Details</a>							
                        </div>
                    </div>
                </div>
                @endforeach                
            </div>
        </div>
    </div>



    
 <!-- Create New Developers -->
<div class="modal lm-modal fade" id="CreateDevelopers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create New Developers</h2>
            <form action="{{route('admin.developer-registration')}}" class="developers_form" id="add_developer" method="post" enctype="multipart/form-data">
                @csrf 
            <div class="row">              
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Developer Name" name="name" required>
                            <!--span class="{{$errors->first('name')?'error invalid-feedback':''}}">{{$errors->first('name')}}</span-->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="location" placeholder="Enter Location" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <input type="hidden"  name="created_by" value="{{ request()->session()->get('USER_ID') }}">
                
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="upload-signature">
                            <input type="file" name="logo" id="Upload Developer LOGO IMG" class="uploadsignature addsignature" required>
                            <label for="Upload Developer LOGO IMG">
                                <div class="signature-text"> 
                                    <span><img src="{{asset('public/admin_assets/images/export.svg')}}"> Upload Developer LOGO IMG</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="upload-signature">
                            <input type="file" name="pdf" id="Upload Developer Contract PDF" class="uploadsignature addsignature" required>
                            <label for="Upload Developer Contract PDF">
                                <div class="signature-text"> 
                                    <span><img src="{{asset('public/admin_assets/images/export.svg')}}">Upload Developer Contract PDF</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-12">
                    <div class="form-group">
                       <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <button class="save-btn">Add Developer</button>
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

@endsection

