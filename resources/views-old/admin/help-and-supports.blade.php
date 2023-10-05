@extends('admin/layout')
@section('container')

<div class="body-main-content">
    <div class="timeshare-section">
        <div class="timeshare-header">
            <div class="mr-auto">
                <h4 class="heading-title">Help & Support</h4>
            </div>
            <div class="ts-filter wd60">
                <div class="row g-2">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" class="form-control" id="ip_date" name="ip_date">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="status" name="status">
                                <option value="">Select status</option>
                                <option value="1">Mark as resolved</option>
                                <option value="2">Waiting For User Response</option>
                                <option value="3">Response sent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group search-form-group">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search by name, email or phone number" >
                            <span class="search-icon"><img src="{{asset('public/admin_assets/images/search-normal.svg')}}"></span>
                        </div>
                    </div>

                    <!-- <div class="col-md-3">
                        <div class="form-group">
                            <a class="Create-btn" href="{{route('admin.all-queries')}}">View all queries</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        <div class="row helpsupportsec">
            @foreach($allhelpuser as $help)
            <div class="col-md-6">
                <div class="manage-support-item">
                    <div class="manage-support-icon">
                        <img src="{{asset('public/admin_assets/images/message.svg')}}">
                    </div>
                    <div class="manage-support-content">
                        <div class="support-date">Pushed on: {{date('d M, Y', strtotime($help->created_at))}} - {{date('H:i A', strtotime($help->created_at))}}</div>
                        <div class="support-descr">
                            <p>{{ $help->message }}</p>
                        </div>
                        <div class="support-user-info">
                            <div class="support-user-media">
                            @if(!empty($help->profile_img))
                                <img src="{{asset('storage/app/public/profile_pics/'.$help->profile_img)}}">
                            @else
                                <img src="{{asset('public/admin_assets/images/user.jpg')}}">
                            @endif
                            </div>
                            <div class="support-user-text">
                                <h2>{{ $help->name }}</h2>
                                <div class="support-cont-info-list">
                                    <div class="support-cont-info-item"><img src="{{asset('public/admin_assets/images/email-icon.svg')}}"> {{ $help->email }}</div>
                                    <div class="support-cont-info-item"><img src="{{asset('public/admin_assets/images/phone-icon.svg')}}"> {{ $help->contact }}</div>
                                </div>

                            </div>
                        </div> 

                        <div class="manage-support-action">
                            <div class="manage-support-Send">
                                @if(!empty($help->past_response))
                                <a class="sendreply-btn" onclick="Sendreply({{$help->id}})"> Send Reply</a>
                                <a class="sendreply-btn" onclick="Adminreply({{$help->id}})"> Past Response</a>
                                @else
                                <a class="sendreply-btn" onclick="Sendreply({{$help->id}})"> Send Reply</a>
                                @endif
                            </div>
                            <div class="manage-support-status">
                                <form action="{{route('admin.admin-status')}}" method="post" class="adstatus">
                                @csrf
                                    <input type="hidden" name="user_id" id="userid" value="{{$help->id}}">
                                    <select class="form-control adminstatus{{$help->id}}" id="adminstatus{{$help->id}}" name="adminstatus" onclick="javascript:someFunction(this)">
                                        <option value="">Select status</option>
                                        <option value="1" {{ $help->admin_status === '1' ? 'selected' : '' }}>Mark as resolved</option>
                                        <option value="2" {{ $help->admin_status === '2' ? 'selected' : '' }}>Waiting For User Response</option>
                                        <option value="3" {{ $help->admin_status === '3' ? 'selected' : '' }}>Response sent</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

 <!-- Send reply -->
 <div class="modal lm-modal fade" id="Sendreply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Send reply</h2>
            <div class="Sendreply-form">
                <form action="{{route('admin.send-reply')}}" method="post" id="sendreply">
                @csrf
                    <input type="hidden" name="user_id" id="userid">
                    <div class="form-group">
                        <div class="Sendreply-head">
                            <div class="Sendreply-icon">
                                <img src="{{asset('public/admin_assets/images/message.svg')}}">
                            </div>
                            <div class="Sendreply-text">
                                <p id="getmsg"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" placeholder="Type your message here…"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="send-btn">Send</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


 <!-- View reply -->
<div class="modal lm-modal fade" id="PastResponse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Past Response</h2>
            <div class="help-card-query-card">
                <div class="help-card-query-head">
                    <div class="help-card-query-icon">
                        <img src="{{asset('public/admin_assets/images/message.svg')}}">
                    </div>
                    <div class="help-card-query-text">
                        <h3 id="question"></h3>
                    </div>
                </div>
                <div class="help-card-query-body">
                    <div class="help-card-respond-card">
                        <div class="help-card-respond-icon">
                            <img src="{{asset('public/admin_assets/images/profile-circle.svg')}}">
                        </div>
                        <div class="help-card-respond-text">
                            <h3>Admin Respond</h3>
                            <div class="form-group" style="height:100%">
                                <textarea class="form-control" id="adminmsg" disabled style="color: var(--lightblack, #6A6A6A); font-size: 14px; font-style: normal; line-height: 20px; margin: 0px 0px 10px; padding: 0px; height: 181px; border: 0px;">
                                </textarea>
                            </div>
                        </div>
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
        function Sendreply(clicked_id)
        {
            $('#Sendreply').modal('show');
            document.getElementById("userid").value = clicked_id;
            $.ajax({
                url : "send-reply/"+clicked_id,
                type : 'GET',
                
                success : function(res){
                    // console.log(res);
                    $('#getmsg').html(res.sendreply.message);
                }
            });
        }
    


        function Adminreply(res_id) {
        
            $("#PastResponse").modal('show');
            $.ajax({
                url : "admin-reply/"+res_id,
                type : 'GET',
                
                success : function(res){
                    // console.log(res);
                    $('#adminmsg').html(res.adminreply.past_response);   
                    $('#question').html(res.adminreply.message); 
                                  

                }
            });
            
        };


            function someFunction(cls_name){

                $(cls_name).on('change', function() {
                    this.form.submit();
                });
            }

$(document).ready(function() {
    $(document).on('keyup change',  "#search, #ip_date, #status", function(e) {
        e.preventDefault();
        
	    var value = $('#search').val();
        var ip_date = $('#ip_date').val();
        var status = $('#status').val();
        console.log(value,status, ip_date);
        // $('.helpsupportsec').hide();
        


        $.ajax({
        	url : "/timesharesimplified/admin/help-support-search",
        	type : 'GET',
            data : {
                search: value,
                ipdate: ip_date,
                status:status,
            },
            
        	success : function(res){
                $('.helpsupportsec').html('');
                $('.helpsupportsec').html(res);

        		console.log(res);

        	}
        });
        
    });

    
});


</script>
@endsection