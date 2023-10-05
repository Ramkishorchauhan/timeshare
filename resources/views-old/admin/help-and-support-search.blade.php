
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