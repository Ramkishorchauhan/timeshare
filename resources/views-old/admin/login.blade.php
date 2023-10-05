<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Timesharesimplyfied</title>    
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/auth.css')}}">
    <script src="{{asset('public/admin_assets/js/jquery-3.7.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/Iconsax/geticons.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/js/function.js')}}" type="text/javascript"></script>
    <style>
        .save-btn {
            text-align: center;
            border: none;
            padding: 8px 30px;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
            background: #4a95cf;
            box-shadow: 0px 4px 18px rgb(74 149 207 / 11%);
            border-radius: 5px;
        }
        .cancel-btn {
            text-align: center;
            border: none;
            padding: 8px 30px;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
            background: #393738;
            box-shadow: 0px 4px 18px rgb(74 149 207 / 11%);
            border-radius: 5px;
        }
    </style>
</head>
    <body>
        <div class="auth-section">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form">
                        <div class="brand-logo">
                            <img src="{{asset('public/admin_assets/images/logo.png')}}" alt="logo">
                        </div>
                        @if(session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong>{{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @endif
                        @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong></strong>{{session('status')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @endif
                        
                        <form class="pt-4" action="{{route('login.auth')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input name="email" type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button class="auth-form-btn">SIGN IN</button>
                            </div>
                    
                            <div class="mt-1 text-center">
                                <a class="auth-link text-black" data-bs-toggle="modal" data-bs-target="#ForgotPassword">Forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

 <!-- Forgot Password -->
 <div class="modal lm-modal fade" id="ForgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form auth-form">
            <!-- <h2>Forgot Password</h2> -->
            <div class="text-center">
                <img src="{{asset('public/admin_assets/images/logo.png')}}" alt="logo" style="width: 30%;">
                <h2>Forgot Password</h2>
            </div>
            <div id="message"></div>
            <form id="forgot-email-form" action="{{route('login.checkemail')}}" method="post">
            @csrf
                <div class="row pt-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="save-btn" id="forgot-email">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- end document-->
<script>
    $(".alert").alert('close');
</script>

<!-- <script>
      function duplicateEmail(element){
        var email = $(element).val();
        if(abc == email){
            alert("Hi");
        }
        $.ajax({
            type: "POST",
            url: '{{url('checkemail')}}',
            data: {email:email},
            dataType: "json",
            success: function(res) {
                if(res.exists){
                    alert('true');
                }else{
                    alert('false');
                }
            },
            error: function (jqXHR, exception) {

            }
        });
    }
</script> -->