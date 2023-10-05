@extends('admin/layout')
@section('container')

<!-- @php 
p($developers);
@endphp -->
    <div class="body-main-content">
                <div class="orders-table-section">
                    <div class="timeshare-card">
                        <div class="timeshare-card-header">
                            <div class="timeshare-card-heading">
                                <h2>Contracts</h2>
                            </div>
                            <div class="search-filter">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <form>
                                            <div class="form-group search-form-group">
                                                <input type="text" name="searchContract" id="searchContract" class="form-control" name="Start Date" placeholder="Search by name, email or phone number">
                                                <span class="search-icon"><i class="iconsax" icon-name="search-normal-2"></i></span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>Show all</option>
                                               @foreach($developers as $key=>$hotel)
                                                    <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control" placeholder="26 March, 2023">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <a class="send-notification-btn" data-bs-toggle="modal" data-bs-target="#sendnotification">Sent Notification</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timeshare-card-body">
                        @foreach($contracts as $list)
                            <div class="timeradio">
                                <input type="radio" name="contractstype" id="Marriott{{$list->id}}" value="contracts{{$list->id}}">
                                <label for="Marriott{{$list->id}}">
                                    <span class="radio-circle-mark"></span>
                                    <div class="contracts-list-content">
                                        <div class="row align-items-center g-1">
                                            <div class="col-md-5">
                                                <div class="estimates-comp-info">
                                                @foreach($developers as $key=>$hotel)
                                                    @if($hotel->id == $list->developer_id)
                                                    <div class="estimates-comp-image">
                                                        <img src="{{asset('/public/storage/developors_logo/'.$hotel->logo)}}">
                                                    </div>
                                                    @endif
                                                @endforeach    
                                                    <div class="estimates-comp-content">
                                                        <div class="estimates-comp-name">{{$list->developer_name}}</div>
                                                        <div class="manage-developers-PDF"><a href="{{asset('/public/storage/developors_pdf/'.$hotel->pdf)}}"><img src="{{asset('public/admin_assets/images/PDF_file_icon.svg')}}">View PDF</a></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="contracts-profile-item">
                                                    <div class="contracts-profile-media"><img src="{{asset('public/admin_assets/images/user.jpg')}}"></div>
                                                    <div class="contracts-profile-text">
                                                        <h2>{{$list->name}}</h2>
                                                        <div class="contracts-cont-info-list">
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/email-icon.svg')}}">{{$list->email}}</div>
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/phone-icon.svg')}}">{{$list->mobile}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="contracts-profile-action">
                                                    <a href="#">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </label>
                            </div>
                        @endforeach

                        </div>
                    </div>
                </div>
            </div>

 
            <!-- send notification -->
            <div class="modal lm-modal fade" id="sendnotification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <div class="timeshare-modal-form">
                        <h2>Send Notification</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea type="text" class="form-control" placeholder="Description"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                <button class="save-btn">Send</button>
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
    $(document).ready(function() {
        $("#searchContract").on('keyup',function() {
            var value = $(this).val(); 
                  
            $.ajax({
                url : "{{ route('admin.contractsearch') }}",
                type : 'GET',
                data : {"searchContract": value},
                
                success : function(res){                    

                    console.log(res);
                    //$('#row').append(`<td><div class="ts-table-text"></div></td>`);
                    // document.querySelector("#row").innerHTML = ""

                    // res.users.forEach((item, index)=>{

                    // $('#row').append(`<tr><td><div class="ts-table-text">${item.name}</div></td>
                    // <td><div class="ts-table-text">${item.email}</div></td>
                    // <td><div class="ts-table-text">${item.contact}</div></td>
                    // <td><div class="ts-table-text">${item.contact}</div></td>
                    // <td><div class="ts-table-text"><div class="orders-price-text accepted-offer">${item.status}</div></div></td>
                    // </tr>`);
                    


                    // })

                }
            });
            
        });

        
    });
    </script>
    @endsection