<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeshare Registration</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    *{
        font-family: 'Roboto';
    }

    .send-btn{  border: 0;background-image: linear-gradient(#3E3E3F, #1A1A1C); color: rgb(241 241 241); border-radius: 15px; width: 50%;height: 50px;}

    body{  background-color: rgb(211, 211, 211);font-size: 18px;
    font-weight: normal;
    line-height: 24px; }
    .main-color{color: #0C8AFF;;}
    .white-color{color: white;}
    a{text-decoration: none;}
    .click-link{transition: 0.3s ease;}
    .click-link:hover{opacity: 0.7;}
    h3{text-align: center;font-size: 23px;color: #0C8AFF;}
    .logo-img{width: 130px;height: auto;margin: 0 auto;display: block;}
    .icons{display: flex;justify-content: right;}
    .footer-icons a{text-decoration: none;color: #0C8AFF;transition: 0.3s ease;}
    .footer-icons a:hover{opacity: 0.5;}
    table{ background-color: white;color: rgb(57, 57, 57); }
    .black-color{color: rgb(57, 57, 57);}
    p{text-align: justify; color: #353334;}
    .sign-icons .icons{justify-content: center;}
    .sign-icons .icons button{margin-right: 20px;}
    .footer-sec{display: flex;justify-content: space-between;align-items: center;}
    .footer-sec img{width: 80px;height: auto;}
    .banner{padding: 50px 20px; margin-top: 0; background: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5) ), url("{{asset('public/admin_assets/template/bg.jpg')}}");background-position: center;background-repeat: no-repeat;background-size: cover;}
    </style>

 

</head>
<body style="background-color: rgb(211, 211, 211);font-size: 18px;
    font-weight: normal;
    line-height: 24px;">
    <table border="0" width="40%"  cellspacing="0px" cellpadding="0px"  align="center"  >

        <tr>
            <td align="center" >
                <a href="#"><img src="{{asset('public/admin_assets/template/logo.png')}}" width="150px" class="logo-img" style="margin-top: 5px;margin-bottom: 5px;"></a>
                <div class="banner-sec">
                    <div class="banner">
                    <img src="{{asset("public/admin_assets/template/bg.jpg")}}" style="width:100px">
                        <h1  style=" color: white; font-weight: bold; text-align: center;font-size: 45px;">WELCOME!</h1>
                        <h2 class="white-color" style="text-align: left; color: white; ">Hi {{$name}},</h2>
                        <p class="white-color">Remember to book your Marriott abound points for maximum
                            availability throughout the year! Or <a href="#" style="color: #4196e7;font-weight: bold;" class="click-link">click here</a> to turn
                            your points into cash for this year and get them
                            rented immediately</p>
                    </div>
                </div>
            </td>
        </tr>
        
    </table>
    <table border="0" width="40%" cellspacing="10px" cellpadding="10px"  align="center"  >
        <tr>
            
            <td colspan="2">
                
                
                <p>You only have 30 days left to turn your Marriott weeks into Marriott Abound points for the following year. Simply log into your Marriott Vacation Club account and next to your week. Click: Elect vacation club
                    points. This will turn your Marriott week you own
                    i.e. (grande vista, Aruba, ocean club, grand, château, etc.…) Into its equivalent points value in
                    the abound program.
                    If you do not do this, you will have to use your week as a week for seven nights /eight days or
                    trade through Interval international. You can also convert them into points and we can
                    rent them out for you immediately <a href="#" style="color: #0C8AFF;font-weight: bold;" class="click-link">click here</a> to get
                    instant cash offer</p>
                    <p>Thank you, <br>Your Timeshare team</p>
            </td>
        </tr>
        <table border="0" width="40%"  cellspacing="10px" cellpadding="0px"  align="center"  >
            <tr>
                <td>
                    <hr style="opacity: 0.5;">
                    <div class="footer-sec">
                        <a href="#"><img src="{{asset('public/admin_assets/template/logo.png')}}" width="150px"  style="margin-top: 5px;margin-bottom: 5px;"></a>
                        <div class="footer-icons">
                            <a href=""><i class="fa fa-facebook" style="margin-right: 20px; font-size: 20px;"></i></a>
                            <a href=""><i class="fa fa-instagram" style="margin-right: 20px; font-size: 20px;"></i></a>
                            <a href=""><i class="fa fa-twitter" style="margin-right: 20px; font-size: 20px;"></i></a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

</body>
</html>