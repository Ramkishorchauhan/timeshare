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
                                            <select class="form-control" id="dev_id" name="dev_id">
                                                <option value="">Select Developer</option>

                                                @foreach($developer as $dev)
                                                    <option value="{{$dev['id']}}">
                                                        {{ $dev['name'] }} 
                                                    </option>
                                                    
                                                @endforeach
                                            </select>
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
                                            <td><div class="ts-table-text">{{$user->name}}</div></td>
                                            <td>
                                                <div class="ts-table-text">{{$user->email}}</div>    
                                            </td>
                                            <td>
                                                <div class="ts-table-text">{{$user->contact}}</div>
                                            </td>
                                            <td>
                                                @if($user->status == 1)
                                                    <div class="orders-price-text accepted-offer">Active</div>
                                                @else
                                                    <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="orders-price-text accepted-offer">00</div>
                                            </td>
                                            <td>
                                                <div class="ts-table-action"><a class="view-btn" href="{{ url('admin/users-details') }}/{{ $user->id }}">View</a></div>
                                            </td>
                                        </tr>
                                
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="ts-table-pagination">
                                    {{ $users->appends(Request::except('page'))->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('scripts')
<script type="text/javascript">

function getAllThreeValue() {
    var value = $('#search').val();
        var devid = $('#dev_id').val();
        console.log(value,devid);
}

 $(document).ready(function() {
    $(document).on('keyup change',  "#search, #dev_id", function(e) {
        e.preventDefault();
        
	    var value = $('#search').val();
        var devid = $('#dev_id').val();
        console.log(value,devid);
        $('.ts-table-pagination').hide();
        


        $.ajax({
			url : "/timesharesimplified/admin/usersearch?search="+value,
			type : 'GET',
            data : {
                search: value,
                devid: devid
            },
			
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