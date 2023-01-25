<?php 



$voicemail_option = array(

'Generic Voicemail' =>
"Hi, sorry I missed your call. I’m either away at the moment or on the phone, please leave your name and number along with a short message and I’ll be sure to get back to you. Thanks and have a great day!",

'Salesperson' =>
"Hi, you've reached [Name] at [Company Name]. I'm unavailable right now. Probably helping [type of company] [hire the best and brightest engineers]. Leave your name and number, and we'll discuss how your company can see similar results.",

'Customer service ' =>
"Hello. You have reached [Name]. I cannot answer the phone right now, but I will return your call as soon as I can. If this is regarding a recent order, please call our Customer Service Department at [Number]. They are available Monday through Friday from 8 a.m. until 5 p.m. Eastern Time. Or you can log in to our website at [Website]. Otherwise, please leave a message after the beep.",

'Promotion' =>
"Hi, this is [Name], the sales manager at [Company Name]. I’m either busy assisting customers, getting ready for our End of Season Sale, featuring deep discounts on our huge selection of power sports equipment and gear or if I’m really lucky, I’m out riding the latest CAN-AM DS 250! Leave a message, and I will call you back as soon as possible. Thanks for calling!",

'Short Voicemail' =>
"Hi, this is [Name]. I'm either on a call or away from my desk. Please leave your name, number, and a brief message and I'll get back to you. Thank you.",

'Busy Voicemail' =>
"You have reached [Name] at [Company Name]. Thank you for calling. I apologize for the inconvenience, but if you leave your name, number, and message, I will return your call as soon as possible.",

'Email Me' =>
"Hi, you've reached [Name] at [Company Name]. If you need a quick response, please shoot me an email at [Email] and I'll be in touch by EOD tomorrow. If it's not urgent, leave me a message with your name and number. Have a great day.",

'Telemarketers' =>
"You have reached [Name] at [Company Name]. Thank you for your call. Please leave your name, number, and message. Sorry I missed your call. If you’re a telemarketer, then I’m definitely not sorry. If you’re not a telemarketer, then I’ll return your call as soon as possible.",

'Conference' =>
"Hello. You have reached [Name], [Marketing Manager] for [Company Name]. I am currently out of the office attending a conference until [August 4th]. I will be checking messages daily, however, if you need immediate assistance, please contact [Marketing Specialist], [Michael Kim] at extension [240]. Otherwise, please leave a message, and I will call you back at my earliest opportunity.",

'Vacation' =>
"Hi, you've reached [Name]. I'm away from [August 4th] to [August 12th]. If you need help with [orders] before then, please contact [Contact] at [Number]. Everyone else, please leave your name and number and I'll return your call when I return. Thanks and have a great day.",

'Holiday' =>
"Hi, you've reached [Name] of [Company Name]. We're closed until [January 2nd]. Please leave your name and phone number and someone will return your call ASAP. Have a great [New Years].",

'Left Company' =>
"Hello, [Name] is chasing new adventures and is no longer with [Company Name]. Please forward all future requests to [Contact] at [Number]. Thank you!",

'Department' =>
"You've reached the [Delivery Department] of [Company Name]. All of our personnel are currently occupied on the floor. Please leave your contact information and we'll get back to you as soon as possible. Or email us at [Email]",

'Company' =>
"Thank you for calling [Company Name]. No one is available to answer your call right now. Our business hours are Monday through Friday, 9 am to 7 pm. Please leave your name and phone number so that someone from our Customer Success Team can follow up with you. For more information, please visit [Website].",
)



?>
<div class="form-row">


 <?php 
 printf(
 '<div class="form-group col-md-6"><input type="text" class="form-control %s" name="first_name" id="first_name_%s" data-cart-id="%s" placeholder="First Name" value="%s"> </div>',
 'prefix-cart-first_name',
 $cart_item_key,
 $cart_item_key,
 $first_name
 );
  printf(
 '<div class="form-group col-md-6"><input type="text" class="form-control %s" name="last_name" id="last_name_%s" data-cart-id="%s" placeholder="Last Name" value="%s"> </div>',
 'prefix-cart-last_name',
 $cart_item_key,
 $cart_item_key,
 $last_name
 );
 ?>
</div>
 
<div class="form-group">
 <?php 	  printf(
	 '<input type="email" class="form-control %s" name="phone_email" id="phone_email_%s" data-cart-id="%s" placeholder="Email" value="%s">',
	 'prefix-cart-phone_email',
	 $cart_item_key,
	 $cart_item_key,
	  $phone_email
	 ); ?>
</div>
<div class="form-row">
 <?php
  printf(
 '<div class="form-group col-md-6"><input type="number" class="form-control %s" name="phone_direct_dial" id="phone_direct_dial_%s" data-cart-id="%s" placeholder="Direct Dial" value="%s"><div id="number_modal" data-box-input="phone_direct_dial_%s"><i class="fas fa-align-center"></i></div> </div>',
 'prefix-cart-phone_direct_dial',
 $cart_item_key,
 $cart_item_key,
 $phone_direct_dial,
  $cart_item_key
 );
 
  printf(
 '<div class="form-group col-md-4"><input type="text" class="form-control %s" name="phone_ext" id="phone_ext_%s" data-cart-id="%s" value="%s" placeholder="101" ></div>',
 'prefix-cart-phone_ext',
 $cart_item_key,
 $cart_item_key,
 $phone_ext
 ); ?>
</div>

<div class="form-row phone-setting">
	
	<ul>
			<li><a href="#phone-voice-mail"><span>Voicemail</span></a></li>
			<li><a href="#phone-call-forwarding"><span>Call Forwarding</span></a></li>
	</ul>

<div class="hidden-voicemail col-md-12" id="phone-voice-mail">

					<h5>Voicemail Settings</h5>
					<p>All <strong>missed calls</strong> go to Voicemail after</p>
					
					<?php 
					  $option_loop = "";
					 for ($i=1; $i != 10 ; $i++) :
						$option_loop .=   '<option value="'.$i.'"  '.(($voicemail_number_of_rings == $i) ? "selected":"").'>'. $i .' Rings</option>';
					 endfor; 
					 
					  printf(
						 '
						 <select name="voicemail_number_of_rings"  class="form-control %s" id="voicemail_number_of_rings_%s" data-cart-id="%s">
						
						 '. $option_loop .'
						 </select>
						 ',
						 'prefix-cart-voicemail_number_of_rings',
						 $cart_item_key,
						 $cart_item_key
						 ); ?>
						<div class="pt-3 cart">
						
						<!--<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-text-to-speech" role="tab" aria-controls="pills-text-to-speech" aria-selected="true">Text to Speech</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-upload" role="tab" aria-controls="pills-upload" aria-selected="false">Upload File</a>
						  </li>
						</ul>-->
						
						 <?php 
						  
						 printf( 
						 '<input type="radio" class="tts text" value="Text to Speech" name="cart_tts_%s" id="cart_text_%s" checked="" data-cart-id="%s" '.( ($cart_tts =="Text to Speech") ? 'checked="checked"' : '').'>
						<label for="cart_text_%s" class="text-label tts-nav">Text to Speech</label>',
						 $cart_item_key,
						  $cart_item_key,
						 $cart_item_key,
						 $cart_item_key
						
						 ); ?>
						
						
						
						
						
						
						<?php 
						 
						 printf( 
						 '<input type="radio" class="tts mp3" value="Upload File" name="cart_tts_%s" id="cart_mp3_%s" data-cart-id="%s" '.( ($cart_tts == "Upload File") ? 'checked="checked"' : '').' >
						<label for="cart_mp3_%s" class="mp3-label tts-nav">Upload file</label>',
						  $cart_item_key,
						  $cart_item_key,
						 $cart_item_key,
						 $cart_item_key
						
						 ); ?>
						
						
						
						<div class="tab-content" id="pills-tabContent">
						  <div class="text tab-pane fade show active" id="pills-text-to-speech" role="tabpanel" aria-labelledby="pills-text-to-speech-tab">
						  	
						  	<!--<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="phone_voice1" name="phone_voice" class="custom-control-input" checked>
							  <label class="custom-control-label" for="phone_voice1">Male Voice</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="phone_voice2" name="phone_voice" class="custom-control-input">
							  <label class="custom-control-label" for="phone_voice2">Female Voice</label>
							</div>-->

							<div class="form-group">
							
							<?php 
							
						//	echo $voicemail_text_value ;
					  $option_loop = "";
				
						 foreach($voicemail_option as $key => $value){
								$option_loop .=   '<option value="'.$key.'"  data-text-value="'.$value.'" '.(($voicemail_text_value == $key) ? "selected":"").'>'. $key .' </option>';
						}
					
										 printf( 
						 '<select name="voicemail_text_value"  class="form-control mt-3 select-text-value %s" id="voicemail_text_value_%s" data-cart-id="%s">
						 '. $option_loop .'</select>',
						 'prefix-cart-voicemail_text_value',
						 $cart_item_key,
						 $cart_item_key
						
						 ); ?>
								
						
							<button id="insert_text_to_voice"> Insert	</button>
							</div>
							<div class="form-group">
							 
								<?php 
								
								
								  printf(
									 '<textarea class="form-control voice-text %s" name="voice_text" id="phone_ext_%s" data-cart-id="%s" rows="8" cols="50" placeholder="Text to be played as audio" >%s</textarea >',
									 'prefix-cart-voice_text',
									 $cart_item_key,
									 $cart_item_key,
									 $voice_text
									 );
								
								?>
								<div id="audio_converted">
								
								</div>
								
							</div>

						  </div>
						  <div class="mp3 tab-pane fade" id="pills-upload" role="tabpanel" aria-labelledby="pills-upload-tab">
						  	<div class="custom-file">
							  <input type="file" class="custom-file-input" id="customFile" value="c:/passwords.txt">
							  <label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<div id="file-attachment" <?=( (!$file_attachment && $file_attachment == "") ? 'style="display:none;"' : '')?>>
								<?php 
									if($file_attachment && $file_attachment != ""){
										?>
										<a href='<?=$file_attachment ?>' >sample</a>
										 <span class="close" data-cart-id="<?=$cart_item_key?>"></span>
										<?php
									}
								?>
								
							</div>
						  </div>
						  
						 
						</div>
						
					</div>

 </div>
 
 <div class="hidden-call-forwarding col-md-12" id="phone-call-forwarding">
					<h5>Call Forwarding Settings</h5>
					<div class="form-group">
					   
						
						<?php 
						 printf(
						 '<input type="text" class="form-control %s" name="mobile_number" id="mobile_number_%s" data-cart-id="%s" placeholder="Mobile Number" value="%s"> ',
						 'prefix-cart-mobile_number',
						 $cart_item_key,
						 $cart_item_key,
						 $mobile_number
						 );
						
						?>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
					 
					  
					  <?php 
					   
					 
						 printf(
						 '<input type="radio" class="custom-control-input %s" name="call_forwarding_option_%s" id="call_forwarding_option_enable_%s" data-cart-id="%s" value="enable"  '.( ($call_forwarding_option =="enable") ? 'checked="checked"' : '').'><label class="custom-control-label" for="call_forwarding_option_enable_%s">Enable</label>',
						 'prefix-cart-call_forwarding_option',
						 $cart_item_key,
						 $cart_item_key,
						  $cart_item_key,
						 $cart_item_key
						 );
						
						?>
					
					</div>
					<div class="custom-control custom-radio custom-control-inline">
 <?php
					  printf(
						 '<input type="radio" class="custom-control-input %s" name="call_forwarding_option_%s" id="call_forwarding_option_disable_%s" data-cart-id="%s" value="disable"  '. (($call_forwarding_option =="disable") ? 'checked="checked"' : '').'> <label class="custom-control-label" for="call_forwarding_option_disable_%s">Disable</label>',
						 'prefix-cart-call_forwarding_option',
						 $cart_item_key,
						 $cart_item_key,
						  $cart_item_key,
						  $cart_item_key
						 );
						
						?>
					
					  
					</div>
				</div>
				
				
</div>

