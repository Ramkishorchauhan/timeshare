@extends('admin/layout')
@section('container')



    <div class="body-main-content">
        <div class="timeshare-section">
            <div class="timeshare-header">
                <div class="mr-auto">
                    <h4 class="heading-title">Manage Points</h4>
                </div>
                <div class="ts-filter wd30">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="dropsearchselect">
                                    <option value="">Show all</option>
                                    @foreach($developers as $key=>$hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                    @endforeach
                                   
                                </select>
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
            <div class="row">
                @foreach($developers as $key=>$dlist)                   
                    <div class="col-md-12 devfilter" id="{{$dlist->id}}">
                        <div class="manage-point-item">
                            <div class="manage-point-item-head">
                                <div class="manage-point-comp-info">
                                    <div class="manage-point-comp-image">
                                        <img src="{{asset('storage/app/public/developors_logo/'.$dlist->logo)}}" alt="">
                                    </div>
                                    <div class="manage-point-comp-content">
                                        <div class="manage-point-comp-name">{{$dlist->name}}</div>
                                    </div>
                                </div>

                                <div class="manage-point-item-action">
                                    <a class="add-Year"  onclick="addYearPoint({{$dlist->id}})">Add Year</a> <!--data-bs-toggle="modal"  data-bs-target="#addYearPoint"-->
                                </div>
                            </div>
                            <div class="manage-point-item-list">
                                @if(isset($points))
                                    <div class="row g-2">                                  
                                        @foreach($points as $point)
                                        @if($dlist->id==$point->developer_id)
                                        <div class="col-md-4">
                                            <div class="manage-point-card">
                                                <div class="manage-point-card-content">
                                                    <h2>Price Per Point {{$point->year}}</h2>
                                                    <div class="manage-point-price">{{$point->currency.$point->price_per_point}}</div>
                                                </div>
                                                <div class="manage-point-card-action">
                                                    <button  class="edit-btn" value="{{$point->id}}" ><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></button> <!--data-bs-toggle="modal" data-bs-target="#editYear".-->
                                                    <a class="delete-btn" href="{{url('admin/delete-point').'/'.$point->id}}"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                                                </div>    
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                @else
                                <a class="delete-btn" href="{{url('admin/delete-point').'/'.$point->id}}"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach                  
            </div>
        </div>
    </div>

 
 
 
 <!-- add Year -->
<div class="modal lm-modal fade" id="addYear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Add Year</h2>
            <form action="{{route('admin.add-points')}}" method="post" id="addPoints">
                @csrf
                <input type="hidden" name="developer_id" id="developerid">
                <input type="hidden" name="created_by" value="{{ request()->session()->get('USER_ID') }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="year" class="form-control" placeholder="Add Year" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="price_per_point" class="form-control" placeholder="Point Price" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                        <button type="button" class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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



    <!-- edit Year -->
    <div class="modal lm-modal fade" id="editYear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body">
            <div class="timeshare-modal-form">
                <h2>Edit Year</h2>
                <form action="{{route('admin.update-point')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden"  name="developer_id" id="developer_id">
                    <input type="hidden"  name="created_by" id="created_by">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="year" id="year">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="price_per_point" id="price_per_point">
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
                        <button class="save-btn">Update</button>
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

    <script type="text/javascript">
        function addYearPoint(clicked_id)
        {
            $('#addYear').modal('show');
            document.getElementById("developerid").value = clicked_id;
        }
    

    $(document).ready(function() {
        $(document).on('click','.edit-btn',function() {
            var point_id=$(this).val();
            //alert(point_id);
        
            $("#editYear").modal('show');
            $.ajax({
                url : "edit-point/"+point_id,
                type : 'GET',
                
                success : function(res){
                    //console.log(res);
                    $('#id').val(res.developers.id);
                    $('#developer_id').val(res.developers.developer_id);
                    $('#year').val(res.developers.year);
                    $('#price_per_point').val(res.developers.price_per_point);
                    $('#status').val(res.developers.status);
                    $('#created_by').val(res.developers.created_by);                  

                }
            });
            
        });

    }); 


    $(function () {
        $("#dropsearchselect").on('change', function () {
            var id = $(this).val();

            $('.devfilter').each(function(){
                if(!id){
                    $('.devfilter').show();
                }else{
                    id === $(this).attr('id') ? $(this).show() : $(this).hide();
                }
            });

        });
    });
</script>
 
@endsection