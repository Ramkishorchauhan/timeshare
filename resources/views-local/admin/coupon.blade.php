@extends('admin/layout')
@section('container')


<div class="body-main-content">
    <div class="timeshare-section">
        <div class="timeshare-header">
            <div class="mr-auto">
                <h4 class="heading-title">Manage coupon</h4>
            </div>
            <div class="ts-filter wd30">
                <div class="row g-2">
                    <div class="col-md-12">
                        <div class="form-group">
                        <a class="Create-btn" data-bs-toggle="modal" data-bs-target="#CreateCoupon">Create New Coupon</a>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        @if(session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong>{{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong></strong>{{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        @endif
        <div class="row">
        @foreach ($coupon as $coupons)
            <div class="col-md-6">
                <div class="manage-coupon-card">
                    <div class="manage-coupon-content">
                        <div class="coupon-code-value">{{$coupons->name}}</div>
                        <p>{{$coupons->description}}</p>
                        <div class="manage-coupon-list">
                            <ul>
                                <li><span>Start From:</span> {{date('d F Y', strtotime($coupons->from_date))}}</li>
                                <li><span>Valid Upto:</span> {{date('d F Y', strtotime($coupons->to_date))}}</li>
                                
                                <li><span>Coupon for Developer:</span> @foreach ($developer as $item) {{$coupons->developer_id==$item->id?$item->name:''}}@endforeach</li>
                                
                            </ul>
                        </div>
                    </div>
                    
                    <div class="manage-point-card-action">
                        <button class="edit-btn" id="edit-btn" value="{{$coupons->id}}"><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></button>
                        <a class="delete-btn" href="{{url('admin/delete-coupon').'/'.$coupons->id}}"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                    </div>
                </div>
            </div>
        @endforeach
            <!-- <div class="col-md-6">
                <div class="manage-coupon-card">
                    <div class="manage-coupon-content">
                        <div class="coupon-code-value">TIMESRE50</div>
                        <p>Get 50% extra rate in point rent out with Marriott points</p>
                        <div class="manage-coupon-list">
                            <ul>
                                <li><span>Start From:</span> 29 March 2023</li>
                                <li><span>Valid Upto:</span> 29 March 2024</li>
                                <li><span>Coupon for Developer:</span> Marriott</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="manage-point-card-action">
                        <a class="edit-btn" data-bs-toggle="modal" data-bs-target="#editCoupon"><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></a>
                        <a class="delete-btn" href="#"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-6">
                <div class="manage-coupon-card">
                    <div class="manage-coupon-content">
                        <div class="coupon-code-value">TIMESRE50</div>
                        <p>Get 50% extra rate in point rent out with Marriott points</p>
                        <div class="manage-coupon-list">
                            <ul>
                                <li><span>Start From:</span> 29 March 2023</li>
                                <li><span>Valid Upto:</span> 29 March 2024</li>
                                <li><span>Coupon for Developer:</span> Marriott</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="manage-point-card-action">
                        <a class="edit-btn" data-bs-toggle="modal" data-bs-target="#editCoupon"><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></a>
                        <a class="delete-btn" href="#"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="manage-coupon-card">
                    <div class="manage-coupon-content">
                        <div class="coupon-code-value">TIMESRE50</div>
                        <p>Get 50% extra rate in point rent out with Marriott points</p>
                        <div class="manage-coupon-list">
                            <ul>
                                <li><span>Start From:</span> 29 March 2023</li>
                                <li><span>Valid Upto:</span> 29 March 2024</li>
                                <li><span>Coupon for Developer:</span> Marriott</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="manage-point-card-action">
                        <a class="edit-btn" data-bs-toggle="modal" data-bs-target="#editCoupon"><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></a>
                        <a class="delete-btn" href="#"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>


 <!-- Create Coupon -->
 <div class="modal lm-modal fade" id="CreateCoupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Create Coupon</h2>
            <form action="{{route('admin.add-coupon')}}" method="post" >
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="couponname" type="text" class="form-control" placeholder="Coupon Name (EX. TIMESHARE20)" required>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" name="coupontype"  required>
                                <option>Coupon Type</option>
                                <option value="1">Fixed</option>
                                <option value="2">Percent</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="couponvalue" class="form-control" placeholder="Add Value" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="datetime-local" name="validfrom"  class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="datetime-local" name="validupto" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    
                
                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" name="devvalue">
                                <option>Select Developer</option>
                                @foreach ($developer as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="coupondescription" class="form-control" placeholder="Coupon Description (ex. Get 20% extra amount on timeshare points rent out"></textarea>
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


<!-- Edit Coupon -->
<div class="modal lm-modal fade" id="editCoupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Edit Coupon</h2>
            <form action="{{route('admin.update-coupon')}}"  method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" id="coupon_name" class="form-control" placeholder="Coupon Name (EX. TIMESHARE20)" required>
                            <input type="hidden"  name="coupon_id" id="coupon_id">
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" name="cou_type" id="cou_type">
                                <option value="1" >Fixed</option>
                                <option value="2" >Percent</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="cou_value" name="cou_value" class="form-control" placeholder="Add Value">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <input type="date" id="from_dates" name="from_date" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <input type="date" id="end_dates" name="end_date" class="form-control">
                        </div>
                    </div>
                    
                

                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" name="devvalue" id="dev_value">
                                @foreach ($developer as $item)
                                <option value="{{ $item->id }}" {{$item->id?'selected':''}}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="coupon_description" placeholder="Coupon Description (ex. Get 20% extra amount on timeshare points rent out"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                        <button type="button" class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="save-btn" id="">Update</button>
                        </div>
                    </div>
                </div>
            <form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
 $(document).ready(function() {
    $(document).on('click','.edit-btn',function() {
	    var coupon_id=$(this).val();
        // alert(coupon_id);
       
        $("#editCoupon").modal('show');
        $.ajax({
			url : "edit-coupon/"+coupon_id,
			type : 'GET',
			
			success : function(res){
				// console.log(res);
                $('#coupon_name').val(res.coupons.name);
                $('#coupon_id').val(res.coupons.id);
                $('#cou_type').val(res.coupons.type);
                $('#cou_value').val(res.coupons.value);
                $('#from_dates').val(String(res.coupons.from_date).split(" ")[0]);
                $('#end_dates').val(String(res.coupons.to_date).split(" ")[0]);
                $('#dev_value').val(res.coupons.developer_id);
                $('#coupon_description').val(res.coupons.description);

        	}
		});
        
	});

    
});
</script>
@endsection