@extends('admin/layout')
@section('container')

	<div class="body-main-content">
                <div class="orders-table-section">
                    <div class="timeshare-card">
                        <div class="timeshare-card-header">
                            <div class="timeshare-card-heading">
                                <h2>App Menu</h2>
                            </div>
                            <div class="search-filter">
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
                                <div class="row g-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#CreateMenu">Create New Menu</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="timeshare-card-body">
                            <div class="orders-table ts-table">
                                <table class="table rejected-stimates-item">
                                    <thead>
                                        <tr>
                                            <th>Menu Title</th>
                                            <th>Slug</th>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "row">
                                        @foreach($all_app_menu as $appmenu)
                                        <tr>
                                            <td><div class="ts-table-text">{{$appmenu['menu_title']}}</div></td>
                                            <td>
                                                <div class="ts-table-text">{{$appmenu['menu_slug']}}</div>    
                                            </td>
                                            <td>
                                                <div class="ts-table-text"><img src="{{asset('storage/app/public/menu_icon/'.$appmenu['icon'])}}" width="40px" height="40px"></div>
                                            </td>
                                            <td>
                                                @if($appmenu['status'] == 1)
                                                    <div class="orders-price-text accepted-offer">Active</div>
                                                @else
                                                    <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="manage-point-card-action">
                                                    <div class="edit-option">
                                                        <button class="edit-app-menu" id="edit-app-menu" value="{{$appmenu->id}}"><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></button>
                                                    </div>
                                                    <a class="delete-btn" href="{{url('admin/delete-app-menu').'/'.$appmenu->id}}"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                                                </div>
                                            </td>
                                        </tr>
                                
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            


            <div class="orders-table-section">
                    <div class="timeshare-card">
                        <div class="timeshare-card-header">
                            <div class="timeshare-card-heading">
                                <h2>App Menu</h2>
                            </div>
                            <div class="search-filter">
                                <div class="row g-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#CreateSocialMedia">Create Social media</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="timeshare-card-body">
                            <div class="orders-table ts-table">
                                <table class="table rejected-stimates-item">
                                    <thead>
                                        <tr>
                                            <th>Social Media Name</th>
                                            <th>Social Media Slug</th>
                                            <th>Social Icon</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "row">
                                        @foreach($social_media_link as $sml)
                                        <tr>
                                            <td><div class="ts-table-text">{{$sml['social_media_name']}}</div></td>
                                            <td>
                                                <div class="ts-table-text">{{$sml['social_media_slug']}}</div>    
                                            </td>
                                            <td>
                                                <div class="ts-table-text"><img src="{{asset('storage/app/public/menu_icon/'.$sml['icon'])}}" width="40px" height="40px"></div>
                                            </td>
                                            <td>
                                                @if($sml['status'] == 1)
                                                    <div class="orders-price-text accepted-offer">Active</div>
                                                @else
                                                    <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="manage-point-card-action">
                                                    <div class="edit-option">
                                                        <button class="social-media" id="social-media" value="{{$sml->id}}"><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></button>
                                                    </div>
                                                    <a class="delete-btn" href="{{url('admin/delete-social-media-link').'/'.$sml->id}}"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                                                </div>
                                            </td>
                                        </tr>
                                
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>

 <!-- Create Menu -->
 <div class="modal lm-modal fade" id="CreateMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create App Menu</h2>
            <form action="{{route('admin.add-app-menu')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="Menu Name (EX. Home, About)">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="slug" type="url" class="form-control" placeholder="Menu URL" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" name="icon" class="form-control" placeholder="Menu Icon" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                        <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="save-btn">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Edit Menu -->
<div class="modal lm-modal fade" id="editAppMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Edit App Menu</h2>
            <form action="{{route('admin.update-app-menu')}}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" name="name" type="text" id="menu_name" placeholder="Menu Name2 (EX. Home, About)">
                            <input type="hidden"  name="menu_id" id="menu_id">
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" name="slug" type="url" id="menu_slug" placeholder="Menu URL">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" name="icon" class="form-control" id="menu_icon" placeholder="Menu Icon">
                            <label for="Upload Developer LOGO IMG" style="width: 100%; border: 1px dashed #4a95cf; border-radius: 5px; padding: 6px; box-shadow: 0px 4px 30px rgb(95 94 231 / 7%); background: #fff; color: #4a95cf; text-align: center; font-size: 12px;">
                                <div class="signature-text" > 
                                    <span id="logo_img" class="logo_img">Menu Icon</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                        <button type="button" class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="save-btn" id="">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Create Social Link -->
 <div class="modal lm-modal fade" id="CreateSocialMedia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create Social Media Link</h2>
            <form action="{{route('admin.add-social-media-link')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="mname" type="text" class="form-control" placeholder="Social Media Name (EX. Home, About)">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="mslug" type="url" class="form-control" placeholder="Social Media URL" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" name="icon" class="form-control" placeholder="Menu Icon" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                        <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="save-btn">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Edit Social Media Link -->
<div class="modal lm-modal fade" id="editsocialMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Edit Social Media Link</h2>
            <form action="{{route('admin.update-social-media-link')}}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="mname" type="text" class="form-control" id="mmenu_name" placeholder="Menu Name (EX. Home, About)" required>
                            <input type="hidden"  name="mmenu_id" id="mmenu_id">
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="mslug" type="url" class="form-control" id="mmenu_slug" placeholder="Menu URL" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="mstatus" id="mstatus">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" name="icon" class="form-control" id="mmenu_icon" placeholder="Menu Icon">
                            <label for="Upload Developer LOGO IMG" style="width: 100%; border: 1px dashed #4a95cf; border-radius: 5px; padding: 6px; box-shadow: 0px 4px 30px rgb(95 94 231 / 7%); background: #fff; color: #4a95cf; text-align: center; font-size: 12px;">
                                <div class="signature-text" > 
                                    <span id="mlogo_img" class="logo_img">Menu Icon</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                        <button type="button" class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="save-btn" id="">Update</button>
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
    var pathlogo = "{!! asset('storage/app/public/menu_icon/')!!}";
 $(document).ready(function() {
    $(document).on('click','.edit-app-menu',function() {
	    var coupon_id=$(this).val();
        // alert(coupon_id);
       
        $("#editAppMenu").modal('show');
        $.ajax({
			url : "edit-app-menu/"+coupon_id,
			type : 'GET',
			
			success : function(res){
                $('#logo_img').html(' ');
				if(res.appmenus != 0){
                    $('#menu_name').val(res.appmenu.menu_title);
                    $('#menu_id').val(res.appmenu.id);status
                    $('#menu_slug').val(res.appmenu.menu_slug);
                    $('#status').val(res.appmenu.status);
                    $('#logo_img').append('<img src="'+pathlogo +'/'+res.appmenu.icon + '" width="30px" height="30px"/>');
                }
        	}
		});
        
	});

    
});
</script>

<script type="application/javascript">
    var pathlogo = "{!! asset('storage/app/public/menu_icon/')!!}";
 $(document).ready(function() {
    $(document).on('click','.social-media',function() {
	    var coupon_id=$(this).val();
        // alert(coupon_id);
        
        $("#editsocialMenu").modal('show');
        $.ajax({
			url : "edit-social-media-link/"+coupon_id,
			type : 'GET',
			
			success : function(res){
                $('#mlogo_img').html(' ');
				if(res.appmenus != 0){
                    $('#mmenu_name').val(res.appmenus.social_media_name);
                    $('#mmenu_id').val(res.appmenus.id);
                    $('#mmenu_slug').val(res.appmenus.social_media_slug);
                    $('#mstatus').val(res.appmenus.status);
                    $('#mlogo_img').append('<img src="'+pathlogo +'/'+res.appmenus.icon + '" width="30px" height="30px"/>');
                }
        	}
		});
        
	});

    
});
</script>
@endsection
