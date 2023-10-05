<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Timesharesimplyfied</title>    
</head>
<style type="text/css">
    *{margin: 0; padding: 0}
</style>

<body style="padding:0; margin: 0;">
		
		<table align="center" cellpadding="0" cellspacing="0" width="100%"  style=" vertical-align: top;">
			<tr>
				<td>
					<table align="center" cellpadding="0" cellspacing="0" width="100%" style=" height: 1050px;"> 
						<tbody>
							<tr> 
								<td valign="top"> 
								<img src="{{asset('public/admin_assets/agreement_images/pdf1.png')}}" width="100%">
								</td> 
							</tr> 
						</tbody>
					</table>    
				</td>
			</tr>

			<tr> 
				<td valign="top">
					<table align="center" cellpadding="0" cellspacing="0" width="100%" style="height: 1000px;background-color: #dbeeff; margin-bottom: 1.5rem;"> 
						<tr> 
							<td valign="top" style="padding:10px;">
								<h2 style="color:#4A95CF;text-align: left;font-size: 32px;font-style: normal;font-weight: 400;line-height: 100%;padding:0;margin: 0 0 20px 0;">Your unique opportunity!</h2>
								<h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Introduction</h3>

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">We are very excited to have you as one of our newest community members! Our goal is to take the worry and hassle out of renting your vacation ownership points, and provide you with the value you truly deserve! We look forward to serving you; by acting as an intermediary between you and the vacation rental guest. Our corporate name is KTJ Enterprises Inc, dba Timeshare Simplified and our websites our www.timesharesimplified.com and www.vacationcondosforless.com. </p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td valign="top">
					<table align="center" cellpadding="0" cellspacing="0" width="100%" style="height: 1050px;background-color: #fff; margin-bottom: 1.5rem;"> 
						<tr> 
							<td valign="top"  style="padding:10px;">
								<h2 style="color:#4A95CF;text-align: left;font-size: 32px;font-style: normal;font-weight: 400;line-height: 100%;padding:0;margin: 0 0 20px 0;">Information</h2>
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Our team is available to you whenever you have questions or concerns throughout the process. Please feel free to contact us by email, text, or phone Mon - Fri 9 am - 6 pm & Sat 9 am - 3 pm PST at the provided numbers and we will get back with you within 24 hours.</p> 
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">To ensures your understanding of the program please look over the attached agreement, then click on the links to sign, and date the agreement electronically. All you need to do is sit back, relax, and enjoy the extra cash. </p> 
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">We are excited about creating a beneficial relationship for all parties involved. We look forward to helping you utilize your ownership, by providing an income source to alleviate many of the costs associated with owning a timeshare. Let me know if you have any questions or concerns. If you would like to speak with our Marriott Specialist please email them at support@vacationcondosforless.com.</p> 
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">We look forward to helping you out and please let us know if you have any other question or concern.</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
			   
				<td valign="top">
					<table align="center" cellpadding="0" cellspacing="0" width="100%" style="height: 1000px;background-color: #fff; margin-bottom: 1.5rem;"> 
						<tr> 
							<td valign="top"  style="padding:10px;">
								<h2 style="color:#4A95CF;text-align: left;font-size: 32px;font-style: normal;font-weight: 400;line-height: 100%;padding:0;margin: 0 0 20px 0;">Agreement</h2>

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">This agreement is hereby entered into on <input type="text" style="outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="user_name" value="{{$user[0]['name']}}"> between KTJ Enterprises Inc., dba Timeshare Simplified, and <input type="text" style="outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="agreementwith" value="{{$contract_details[0]['agreementwith']}}"> Marriott Vacation Club Member. This contract is void if not signed within <input type="text" style="outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="valid_days" value="{{$contract_details[0]['valid_days']}}"> days.</p> 

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">By signing this agreement, you agree to give us access to your Marriott Vacation Club personal information, owner number, username, and password to book reservations on your behalf. We will keep information secure and safe, and use only the agreed above number of points to book reservations for various different amounts, at various times of the year, depending upon business needs. </p> 

								<div class="" style="text-align: center; margin-bottom: 1rem;">
									<img src="{{asset('public/admin_assets/agreement_images/pdf2.png')}}" width="100%">
								</div>

							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td valign="top" >
					<table align="center" cellpadding="0" cellspacing="0" width="100%" style="height:1000px;background-color: #dbeeff; margin-bottom:1.5rem;"> 
						<tr> 
							<td valign="top"  style="padding:10px;">
								<h2 style="color:#4A95CF;text-align: left;font-size: 32px;font-style: normal;font-weight: 400;line-height: 100%;padding:0;margin: 0 0 20px 0;">Payment</h2>
							   
							   <h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Price per Point</h3>

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">KTJ Enterprises Inc., dba Timeshare Simplified agrees to rent out <input type="text" style="background: none; outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="user_name" value="{{$user[0]['name']}}"> Marriott Vacation Club Points - Use Year <input type="text" style="background: none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="points" value="{{$contract_details[0]['year']}}">for $ <input type="text" style="background: none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="points" value="{{$contract_details[0]['price_per_point']}}">  per point.</p> 
								<h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Details</h3>
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Please be aware on future points that you may want to sell us this price may not be the same. Payments will be made to you after we have finished booking your points; or every 2 - 3 weeks, according to the number of points used during that time period. Once the points have been booked for a reservation, those points are considered purchased by us, regardless if a reservation cancels. If someone cancels a reservation, we will re-use the points for another reservation and you will not be penalized. </p>

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">If at any time, you wish to withdraw from the program please contact us immediately, and we will be happy to give you a standing on your current balance of any unused points; and we will pay you what you are owed at that time. Any bookings you cancel that were booked by us, for a guest of ours, gives us the right to remove you from our program, and we reserve the right to forfeit any monies you would have received.</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> 
				<td valign="top">
					<table align="center" cellpadding="0" cellspacing="0" width="100%" style="height: 1000px;background-color: #dbeeff; margin-bottom: 1.5rem;"> 
						<tr>
							<td valign="top"  style="padding:10px;">
								<h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Please fill in:</h3>
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Please mark with a Y next to your choice of how you would like payments to be sent.</p>

								

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">PayPal Email <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" value="{{$contract_details[0]['paypal_email']}}"></p>

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Enter N/A if choosing to be paid by Check New Member</p>

								<h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Name:</h3>

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">First  <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="check_firstname" value="{{$contract_details[0]['check_firstname']}}"> Last <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="check_lastname" value="{{$contract_details[0]['check_lastname']}}"></p> 

								<h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Address:</h3>

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Street <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="street_address" value="{{$contract_details[0]['street_address']}}"> City, State, Zip <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="city_address" value="{{$contract_details[0]['city_address']}}"></p> 

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Email <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="check_email" value="{{$contract_details[0]['check_email']}}"> Phone <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="check_phone" value="{{$contract_details[0]['mobile']}}"></p> 
								
								
								<!--h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Paypal Account:</h3>


								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Username <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="paypal_email" value="{{$contract_details[0]['paypal_email']}}">Paypal Password <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="paypal_password" value="{{$contract_details[0]['paypal_password']}}"></p-->
								
								
								<h3 style="color: #353334;text-align: left;font-size: 22px;font-style: normal;font-weight: 500;line-height: 100%;padding:0;margin:0 0 10px 0">Marriott Account:</h3>


								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Username <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="developer_login_username" value="{{$contract_details[0]['developer_login_username']}}"> Password <input type="text" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="developer_login_password" value="{{$contract_details[0]['developer_login_password']}}"></p> 


								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;"><img src="{{asset('storage/app/public/user_signature/'.$contract_details[0]['signature'])}}" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="signature"></p> 
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;" >Print Name Marriott Owner Date & Signature</p> 

								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;"><img src="{{asset('storage/app/public/points_screenshot/'.$contract_details[0]['points_screenshot'])}}" style="background:none;outline:none; border-bottom: 1px dashed #353334;border-top: none; border-left: none; border-right: none;color:#353334;text-align: justify;font-family: Roboto;font-size: 14px;font-style: normal;font-weight: 400;line-height: 20px;" name="points_screenshot"></p> 
								<p style="color:#353334;font-size: 18px;font-style: normal;font-weight: 400;line-height: 30px;">Print Name Robert (Tony) Avitia Date & Signature</p> 
							</td>
						</tr>
						
					</table>
				</td>
				
			</tr>
			
			<tr> 
				<td valign="top">
					<table align="center" cellpadding="0" cellspacing="0" width="100%" > 
						<tr> 
							<td valign="top"  style="padding:0 10px;">
								<p style="color:#353334;text-align: center;font-size: 20px;font-style: normal;font-weight: 400;line-height: 20px; ">Toll Free: 800.461.5037 Call /Text</p> 
								<p style="color:#353334;text-align: center;font-size: 20px;font-style: normal;font-weight: 400;line-height: 20px; ">Direct: 702.581.8035 Mobile/Text</p>
								<p style="color:#353334;text-align: center;font-size: 20px;font-style: normal;font-weight: 400;line-height: 20px; ">Email: Support@vacationcondosforless.com</p>
								<p style="color:#353334;text-align: center;font-size: 20px;font-style: normal;font-weight: 400;line-height: 20px; ">Email: support@timesharesimplified.com</p>

								<div class="" style="text-align: center;">
									<img src="{{asset('public/admin_assets/agreement_images/pdf-logo.png')}}" style="width: 300px; margin: auto;">
								</div>
							</td>
						</tr>
					</table>  
				</td>
			</tr>
		</table> 

</body>
</html>