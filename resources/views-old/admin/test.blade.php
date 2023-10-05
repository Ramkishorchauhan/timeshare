@extends('admin/layout')
@section('container')

	<div class="body-main-content">
                <div class="orders-table-section">
                    <div class="timeshare-card">
                        <div class="timeshare-card-header">
                            <div class="timeshare-card-heading">
                                <h2>Users</h2>
                            </div>
                            <div class="search-filter">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <form>
                                            <div class="form-group search-form-group">
                                                <input type="text" class="form-control" id="search" name="search" placeholder="Search by name, email....">
                                                <span class="search-icon"><i class="iconsax" icon-name="search-normal-2"></i></span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option>Select Offer</option>
                                                <option>Accepted Offer</option>
                                                <option>Rejected Offer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option>Select Developer</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timeshare-card-body">
                              <div class="container">
                                <div class="row timeshare-modal-form">
                                    <form action="{{route('adduser')}}" class="developers_form" method="post" enctype="multipart/form-data">
                                        @csrf 
                                        <div class="row">              
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control " placeholder="Uaer Name" name="name" required="">
                                                        <!--span class=""></span-->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="email" class="form-control " placeholder="Uaer email" name="email" required="">
                                                        <!--span class=""></span-->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control " placeholder="Password" name="password" required="">
                                                        <!--span class=""></span-->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="contact" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="address" placeholder="Address">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <h2> Select Developer</h2> 
                                        <div class="row">
                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <select class="form-control" aria-label="Default select example" name="developer_id[]">
                                                        <option selected="">Select Developer</option>
                                                        @if($developers)
                                                            @foreach($developers as $dev)
                                                                <option value="{{$dev['id']}}">
                                                                    {{ $dev['name'] }} 
                                                                </option>                                                    
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <select class="form-control" aria-label="Default select example" name="points_enroll[]">
                                                        <option  selected="">Select Points Enrollment</option>
                                                        <option  value="1">Enrolled In Points</option>
                                                        <option  value="2">Non-Enrolled Weeks owner</option>
                                                        <option  value="3">Points only owner</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <select class="form-control" aria-label="Default select example" name="points_type[]">
                                                        <option  selected="">Select Points Type</option>
                                                        <option  value="1">Weeks Only</option>
                                                        <option  value="2">Weekends Points</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Start Date 1</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_start_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>End Date 1</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_end_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Start Date 2</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_start_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>End Date 2</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_end_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>
                                            
                                            <h2> Select Developer 2</h2>
                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <select class="form-control" aria-label="Default select example" name="developer_id[]">
                                                        <option selected="">Select Developer</option>
                                                        @if($developers)
                                                            @foreach($developers as $dev)
                                                                <option value="{{$dev['id']}}">
                                                                    {{ $dev['name'] }} 
                                                                </option>                                                    
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <select class="form-control" aria-label="Default select example" name="points_enroll[]">
                                                        <option  selected="">Select Points Enrollment</option>
                                                        <option  value="1">Enrolled In Points</option>
                                                        <option  value="2">Non-Enrolled Weeks owner</option>
                                                        <option  value="3">Points only owner</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">                                                
                                                <div class="form-group">
                                                    <select class="form-control" aria-label="Default select example" name="points_type[]">
                                                        <option  selected="">Select Points Type</option>
                                                        <option  value="1">Weeks Only</option>
                                                        <option  value="2">Weekends Points</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Start Date 1</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_start_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>End Date 1</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_end_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Start Date 2</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_start_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>End Date 2</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="anniversary_end_date[]" placeholder="Enter Contact" required="">
                                                </div>
                                            </div>
                                            
                                            

                                                                                     
                                            
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <button  type="submit" class="save-btn">Add User</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                </div>
                              </div>  


                            <!--div class="orders-table ts-table">
                                <table class="table rejected-stimates-item">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email ID</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th>offer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "row">
                                        @foreach($users as $user)
                                        <tr>
                                            <td><div class="ts-table-text">{{$user['name']}}</div></td>
                                            <td>
                                                <div class="ts-table-text">{{$user['email']}}</div>    
                                            </td>
                                            <td>
                                                <div class="ts-table-text">{{$user['contact']}}</div>
                                            </td>
                                            <td>
                                                @if($user['status'] == 1)
                                                    <div class="orders-price-text accepted-offer">Active</div>
                                                @else
                                                    <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="orders-price-text accepted-offer">09</div>
                                            </td>
                                            <td>
                                                <div class="ts-table-action"><a class="view-btn" href="{{ url('admin/users-details') }}/{{ $user['id'] }}">View</a></div>
                                            </td>
                                        </tr>
                                
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="ts-table-pagination">
                                    
                                </div>
                            </div-->
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('scripts')
<script type="text/javascript">
 $(document).ready(function() {
    $(document).on('keyup',function(e) {
        e.preventDefault();
	    var value = $('#search').val();
        // $('.ts-table-pagination').hide();
        


        $.ajax({
			url : "/timesharesimplified/admin/usersearch?search="+value,
			type : 'GET',
            data : {search: value},
			
			success : function(res){
                $('.ts-table').html('');
                $('.ts-table').html(res);

				console.log(res);
				// //$('#row').append(`<td><div class="ts-table-text"></div></td>`);

                // document.querySelector("#row").innerHTML = ""

                // res.users.forEach((item, index)=>{

                    

                //  $('#row').append(`<tr><td><div class="ts-table-text">${item.name}</div></td>
                //  <td><div class="ts-table-text">${item.email}</div></td>
                //  <td><div class="ts-table-text">${item.contact}</div></td>
                //  <td><div class="ts-table-text">${item.contact}</div></td>
                //  <td><div class="ts-table-text"><div class="orders-price-text accepted-offer">${item.status}</div></div></td>
                //  </tr>`);
                 


                // })

        	}
		});
        
	});

    
});
</script>
@endsection