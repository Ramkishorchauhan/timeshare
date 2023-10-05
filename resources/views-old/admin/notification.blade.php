@extends('admin/layout')
@section('container')

<div class="body-main-content">
    <div class="timeshare-section">
        <div class="timeshare-header">
            <div class="mr-auto">
                <h4 class="heading-title">Manage App Notification</h4>
            </div>
            <div class="ts-filter wd70">
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group search-form-group">
                            <input type="text" class="form-control" name="Start Date" placeholder="Search by notification title">
                            <span class="search-icon"><img src="{{asset('public/admin_assets/images/search-normal.svg')}}"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#CreateNotification">Create New Notification</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="manage-notification-item">
                    <div class="manage-notification-icon">
                        <img src="{{asset('public/admin_assets/images/notification-bing.svg')}}">
                    </div>
                    <div class="manage-notification-content">
                        <div class="notification-date">Pushed on: 06 Dec, 2022 - 09:39Am</div>
                        <div class="notification-descr">
                            <p>Remember To Book Your Marriott Abound Points For Maximum Availability Throughout The Year! Or Click Here (<a href="www.timesharesimplified.com/points-calculator">www.timesharesimplified.com/points-calculator</a> ) To Turn Your Points Into Cash For This Year And Get Them Rented Immediately!</p>
                        </div>
                        <div class="notification-tag">
                            <h3>Developers:</h3>
                            <div class="tags-list">
                                <div class="Tags-text">Tattoo Course </div>
                                <div class="Tags-text">Body Piercing </div>
                                <div class="Tags-text">Tattoo  </div>
                                <div class="Tags-text">Tattoos 2023 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            <div class="manage-notification-item">
                    <div class="manage-notification-icon">
                        <img src="{{asset('public/admin_assets/images/notification-bing.svg')}}">
                    </div>
                    <div class="manage-notification-content">
                        <div class="notification-date">Pushed on: 06 Dec, 2022 - 09:39Am</div>
                        <div class="notification-descr">
                            <p>Remember To Book Your Marriott Abound Points For Maximum Availability Throughout The Year! Or Click Here (<a href="www.timesharesimplified.com/points-calculator">www.timesharesimplified.com/points-calculator</a> ) To Turn Your Points Into Cash For This Year And Get Them Rented Immediately!</p>
                        </div>
                        <div class="notification-tag">
                            <h3>Developers:</h3>
                            <div class="tags-list">
                                <div class="Tags-text">Tattoo Course </div>
                                <div class="Tags-text">Body Piercing </div>
                                <div class="Tags-text">Tattoo  </div>
                                <div class="Tags-text">Tattoos 2023 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            <div class="manage-notification-item">
                    <div class="manage-notification-icon">
                        <img src="{{asset('public/admin_assets/images/notification-bing.svg')}}">
                    </div>
                    <div class="manage-notification-content">
                        <div class="notification-date">Pushed on: 06 Dec, 2022 - 09:39Am</div>
                        <div class="notification-descr">
                            <p>Remember To Book Your Marriott Abound Points For Maximum Availability Throughout The Year! Or Click Here (<a href="www.timesharesimplified.com/points-calculator">www.timesharesimplified.com/points-calculator</a> ) To Turn Your Points Into Cash For This Year And Get Them Rented Immediately!</p>
                        </div>
                        <div class="notification-tag">
                            <h3>Developers:</h3>
                            <div class="tags-list">
                                <div class="Tags-text">Tattoo Course </div>
                                <div class="Tags-text">Body Piercing </div>
                                <div class="Tags-text">Tattoo  </div>
                                <div class="Tags-text">Tattoos 2023 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
            <div class="manage-notification-item">
                    <div class="manage-notification-icon">
                        <img src="{{asset('public/admin_assets/images/notification-bing.svg')}}">
                    </div>
                    <div class="manage-notification-content">
                        <div class="notification-date">Pushed on: 06 Dec, 2022 - 09:39Am</div>
                        <div class="notification-descr">
                            <p>Remember To Book Your Marriott Abound Points For Maximum Availability Throughout The Year! Or Click Here (<a href="www.timesharesimplified.com/points-calculator">www.timesharesimplified.com/points-calculator</a> ) To Turn Your Points Into Cash For This Year And Get Them Rented Immediately!</p>
                        </div>
                        <div class="notification-tag">
                            <h3>Developers:</h3>
                            <div class="tags-list">
                                <div class="Tags-text">Tattoo Course </div>
                                <div class="Tags-text">Body Piercing </div>
                                <div class="Tags-text">Tattoo  </div>
                                <div class="Tags-text">Tattoos 2023 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


 <!-- Create  Notification -->
 <div class="modal lm-modal fade" id="CreateNotification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create Notification</h2>
            <form action="{{route('admin.addnotification')}}" class="notification_form" id="notification" method="post" enctype="multipart/form-data">
                @csrf 
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Notification Title" name="ntitle">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Notification description" name="description"></textarea>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" id ="developer_ids" name="developer_id">
                            <option value="" selected>Select Developer</option>
                            @foreach($developers as $dev)
                            <option value="{{$dev->id}}" id="{{$dev->id}}">{{$dev->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        Notification date <input class="form-control" type="date" name="ndate" id="ndate">
                    </div>
                </div> 
                <!-- <div class="col-md-12 enrollpointtype" style="display:none">
                    <div class="form-group">
                        <select class="form-control enrollpointtypeid" aria-label="Default select example" id ="enroll_type_id" name="enroll_type_id">
                        </select>
                    </div>
                </div>
                <div class="col-md-12 weeklytype" style="display:none">
                    <div class="form-group">
                        <select class="form-control weeklytypeid" aria-label="Default select example" id ="weekly_type_id" name="weekly_type_id">
                        </select>
                    </div>
                </div>

                <div class="col-md-12 startdate" style="display:none">
                    <div class="form-group">
                        <select class="form-control startdateid" aria-label="Default select example" id ="startdate" name="startdate">
                        </select>
                    </div>
                </div> -->

                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Number of points">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="enrolled-list">
                            <ul class="">
                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Enrolled in Points" name="">
                                        <label for="Enrolled in Points">
                                            <span class="checkbox-text">Enrolled in Points</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Non-Enrolled Weeks owner" name="">
                                        <label for="Non-Enrolled Weeks owner">
                                            <span class="checkbox-text">Non-Enrolled Weeks owner</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Points only owner" name="">
                                        <label for="Points only owner">
                                            <span class="checkbox-text">Points only owner</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="enrolled-list">
                            <ul class="">
                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Weeks only" name="">
                                        <label for="Weeks only">
                                            <span class="checkbox-text">Weeks only</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Weeks and points" name="">
                                        <label for="Weeks and points">
                                            <span class="checkbox-text">Weeks and points</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="enrolled-list">
                            <ul class="">
                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Enrolled in Points" name="">
                                        <label for="Enrolled in Points">
                                            <span class="checkbox-text">Owner</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Select 4k-6999" name="">
                                        <label for="Select 4k-6999">
                                            <span class="checkbox-text">Select 4k-6999</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Executive- 7k-9999" name="">
                                        <label for="Executive- 7k-9999">
                                            <span class="checkbox-text">Executive- 7k-9999</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Presidential- 10k-14999" name="">
                                        <label for="Presidential- 10k-14999">
                                            <span class="checkbox-text">Presidential- 10k-14999</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    <div class="enrolledcheckbox">
                                        <input type="checkbox"  id="Chairman- 15k +" name="">
                                        <label for="Chairman- 15k +">
                                            <span class="checkbox-text">Chairman- 15k +</span>
                                            <span class="checkbox-circle-mark"></span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <textarea type="text" class="form-control" placeholder="Enter Notification Description"></textarea> 
                    </div>
                </div> -->
                
                <div class="col-md-12">
                    <div class="form-group">
                       <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <button class="save-btn">Create</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>


 <!-- edit Developers -->
<div class="modal lm-modal fade" id="editDevelopers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Edit Developers</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Developer Name" value="Marriott">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Location" value="Bethesda, Maryland, U.S ">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="upload-developer-media">
                            <div class="upload-developer-logo-img"><img src="images/Marriott Logo 1.png"></div> marriott logo 
                            <span class="delete-icon"><img src="images/delete-icon.svg"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="upload-developer-media">
                            <div class="upload-developer-logo-img"><img src="images/Marriott Logo 1.png"></div> marriott Contract PDF
                            <span class="delete-icon"><img src="images/delete-icon.svg"></span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                       <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <button class="save-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



@section('scripts')
<script>
$(document).ready(function() {
    
    $("#developer_id").change(function() {
        var id = $(this).children(":selected").attr("id");
        console.log(id);
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
    
    $("#weeklytypeid").change(function() {
        var id = $(this).children(":selected").val();
        // alert(id);
        $.ajax({
			url : "anniversary_startdate_by_id/"+id,
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
@endsection


