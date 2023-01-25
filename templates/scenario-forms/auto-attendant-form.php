<h1>Auto Attendant</h1>
				<div class="auto-config">
				
				<?php
				/* $form_values = explode("|",$item["form_values"][1]);
							
							
							if($form_values[0] == "Announcements" && $form_values[1] == "Upload File" ){
								echo "<pre>";
								print_r ($form_values );
							echo "</pre>"; 
							} */
							
							
							?>
					<div class="num_list">
						<ul>
							 <?php 
							 
								if(isset($item["selectedForm"]) && $item["selectedForm"] == "auto-attendant"){
									$_ispopulate = true;
								}
								else{
									$_ispopulate = false;
								}
							 
							 	$content = array();
							 	if ( $item !== "" && isset($item["form_values"]) && $item["selectedForm"] == "auto-attendant" ): ?>
								 
								
								 
								 <?php 
									/* echo $item["selectedForm"];
									echo $_ispopulate; */
								 ?>
								 
								 <?php foreach ($item["form_values"] as $key => $value): ?>
								 	
								 	<?php 
										
									   
										/* $array[2] = str_replace("\\","", $array[2] );
										$comma_separated = implode("|", $array); */

								
									
										$value = ltrim($value, '|');
								 		$items = explode("|", $value);

								 		array_push($content,$items);
										
										
										
										if("Ring-Group" == $items[0]){
											
											$items[2] = htmlspecialchars(str_replace("\\","", $items[2] ));
											$comma_separated = implode("|", $items); 
											
											$item["form_values"][$key] =$comma_separated; 
										//	print_r($comma_separated); 
										}
										
								 	?>

								 <?php endforeach ?>
							 <?php endif ?>
							<li class="active" data-type="Greetings" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][0], '|') : "" ;
							?>"  data-attendant-index="0" >
								<a href="#">
									<span class="num">-</span>
									<span class="type">Greetings</span>
								</a>
							</li>
							<li class="" data-type="<?= ( isset($content[1][0]) ) ? $content[1][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][1], '|') : "" ; ?>" data-attendant-index="1">
								<a href="#">
									<span class="num">1</span>
									<span class="type"><?= ( isset($content[1][0]) ) ? $content[1][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type='<?= ( isset($content[2][0]) ) ? $content[2][0] : "Ring-One" ?>' data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][2], '|') : "" ; ?>" data-attendant-index="2">
								<a href="#">
									<span class="num">2</span>
									<span class="type"><?= ( isset($content[2][0]) ) ? $content[2][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[3][0]) ) ? $content[3][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][3], '|') : "" ; ?>" data-attendant-index="3">
								<a href="#">
									<span class="num">3</span>
									<span class="type"><?= ( isset($content[3][0]) ) ? $content[3][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[4][0]) ) ? $content[4][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][4], '|') : "" ; ?>" data-attendant-index="4">
								<a href="#">
									<span class="num">4</span>
									<span class="type"><?= ( isset($content[4][0]) ) ? $content[4][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[5][0]) ) ? $content[5][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][5], '|') : "" ; ?>" data-attendant-index="5">
								<a href="#">
									<span class="num">5</span>
									<span class="type"><?= ( isset($content[5][0]) ) ? $content[5][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[6][0]) ) ? $content[6][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][6], '|') : "" ; ?>" data-attendant-index="6">
								<a href="#">
									<span class="num">6</span>
									<span class="type"><?= ( isset($content[6][0]) ) ? $content[6][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[7][0]) ) ? $content[7][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][7], '|') : "" ; ?>" data-attendant-index="7">
								<a href="#">
									<span class="num">7</span>
									<span class="type"><?= ( isset($content[7][0]) ) ? $content[7][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[8][0]) ) ? $content[8][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][8], '|') : "" ; ?>" data-attendant-index="8">
								<a href="#">
									<span class="num">8</span>
									<span class="type"><?= ( isset($content[8][0]) ) ? $content[8][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[9][0]) ) ? $content[9][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][9], '|') : "" ; ?>" data-attendant-index="9">
								<a href="#">
									<span class="num">9</span>
									<span class="type"><?= ( isset($content[9][0]) ) ? $content[9][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[10][0]) ) ? $content[10][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][10], '|') : "" ; ?>" data-attendant-index="10">
								<a href="#">
									<span class="num">*</span>
									<span class="type"><?= ( isset($content[10][0]) ) ? $content[10][0] : "No-Configuration" ?></span>
								</a>
							</li>
						</ul>
					</div>
					<div class="config-form">
						<h3 class="form-title">Configure <span>Greeting</span></h3>
						<div class="row config-content greetings" style="display: block;">
		                    <input type="radio" class="tts text" value="Text to Speech" name="auto-tts" id="auto-text" checked>
		                    <input type="radio" class="tts mp3" value="Upload file" name="auto-tts" id="auto-mp3">
		                    <label for="auto-text" class="text-label tts-nav">Text to Speech</label>
		                    <label for="auto-mp3" class="mp3-label tts-nav">Upload file</label>
		                    <div class="row type-content text">
		                        <div class="row gender">
		                            <div class="col-xs-6">
		                                <input type="radio" name="auto-gender" value="Male" id="auto-male" checked>
		                                <label for="auto-male">Male</label>
		                            </div>
		                            <div class="col-xs-6">
		                                <input type="radio" name="auto-gender" value="Female" id="auto-female">
		                                <label for="auto-female">Female</label>
		                            </div>
		                        </div>
		                        <div class="row">
		                            <select class="form-control auto-greeting-speech" ><!----><option data-text="Hello and thank you for calling, [Company Name], where [state your short company slogan]. If you know the extension of the party you are trying to reach, you may dial it at any time. To speak with a Sales representative, press 1. To reach a Customer Support agent, press 2. To reach our Billing department, press 3. If you would like to know our regular business hours and location, press 4. If you would like to speak with an Operator, press 0, or press 9 to repeat the available options." class="ng-star-inserted" value="Departmental">Departmental</option>
									
									<option data-text="Thank you for calling [Company Name]. If you know your party’s extension, please dial it at any time. To reach our general voicemail box, press 1. For more information about [Company Name], press 2. If you are an existing customer, please press 3. For billing questions, press 4. To repeat menu options, press 9. For all other inquiries, press 0." class="ng-star-inserted" value="Informational">Informational</option>
									
									<option data-text="Thanks for calling [Company Name]. For more information about our products, press 1. If you have troubleshooting questions, press 2. For billing questions, press 3. For a our general voicemail box, press 4. For our regular business hours, press 5. If you know your party’s extension, please dial it now. For all other inquiries, please stay on the line, and a representative will be happy to assist you." class="ng-star-inserted" value="Product-Focused">Product-Focused</option>
									
									<option data-text="You’ve reached [Company Name], the [company’s slogan]. Please choose from the following menu options: To speak with the operator, press 0. For customer support, press 1. For troubleshooting questions, press 2. For accounting questions, press 3. For a list of our staff members, press 4. To leave us a message, press 5. To repeat these options, press 6." class="ng-star-inserted" value="Operator-Focused">Operator-Focused</option>
									
									<option data-text="Thank you for calling [Company Name]. Our offices are currently closed for the day. Standard office hours are Monday to Friday, 8 AM to 8 PM Eastern Time. Did you know that you can check your account status with us 24 hours a day / 7 days a week by visiting  account login webpage]? Here you can view information about your account, as well as answers to general questions you may have. Otherwise, please call back during standard office hours, and we will be happy to assist you. To repeat this message, press the * key." class="ng-star-inserted" value="Website-Focused">Website-Focused</option>
									
									<option data-text="Thank you for calling [Your Office Name]. If this is a medical emergency, hang up and dial 9 1 1 now. Please select one of the following options: For physicians’ appointments at all locations, press 1. If you are a physician trying to reach a [Office Name] physician, press 2 For prescription refills or questions related to medication, press 3.  For office hours, fax number, mailing address and directions, press 4. All other callers … please press 5." class="ng-star-inserted" value="Medical Office">Medical Office</option>
									
									<option data-text="Thank you for calling the law office of [Name]. If you know your party’s extension, please dial it at any time. To reach our company directory, press 1. For more information about [Company Name], press 2. If you are an existing customer, please press 3. For Docket questions, press 4. To repeat menu options, press 9. For all other inquiries, press 0." class="ng-star-inserted" value="Law Office">Law Office</option>
									
									</select>
		                            <button class="insert-btn">Insert</button>
		                        </div>
		                        <div class="row">
		                            <textarea></textarea>
		                        </div>
		                        <div class="row">
		                            <audio></audio>
		                        </div>
		                    </div>
		                    <div class="row type-content mp3">
		                        <div class="file-upload">
		                            <input type="file" name=""  data-key-id="<?=$scenario_key_session?>" accept="audio/mp3,audio/*;capture=microphone">
		                        </div>
								<div id="file-attachment">
								
								</div>
		                    </div>
		                </div>
		                <div class="row config-content main">
		                	<select class="auto-options">
		                		<option value="No-Configuration">No-Configuration</option>
		                		<option value="Ring-One">Ring-One</option>
		                		<option value="Ring-Group">Ring-Group</option>
		                		<option value="Announcements">Announcements</option>
		                		<option value="Voicemail">Voicemail</option>
		                	</select>
		                	<div class="Ring-One form-content">
		                		<ul class="clearfix user_list ring_options">
								
								<?php 
									foreach($ring_options as $key => $value):
										$name_ext = explode("|", $value);
										?>
										<li>
										
											<input type="radio" name="auto-user" value="<?=$name_ext[0]." - ".$name_ext[1]?>"<?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"] == $value ) ? "checked" : "" ; ?> id="<?=$value?>">
											<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
										</li>
										
										
										
										
									<?php	
									endforeach
								?>
									
									<!--li>
										<input type="radio" name="auto-user" value="102 - Firstname Lastname" id="auto-102">
										<label for="auto-102">102 - Firstname Lastname</label>
									</li>
									<li>
										<input type="radio" name="auto-user" value="103 - Firstname Lastname" id="auto-103">
										<label for="auto-103">103 - Firstname Lastname</label>
									</li>
									<li>
										<input type="radio" name="auto-user" value="104 - Firstname Lastname" id="auto-104">
										<label for="auto-104">104 - Firstname Lastname</label>
									</li-->
								</ul>
		                	</div>
		                	<div class="Ring-Group form-content">
			                	<input type="radio" class="ring-type sim" name="auto-ring-type" value="Simultaneous Ring" id="auto-simultaneous" checked="">
								<label for="auto-simultaneous">Simultaneous Ring</label>
								<span> or </span>
								<input type="radio" class="ring-type seq" name="auto-ring-type" value="Sequential Ring Ring" id="auto-sequential">
								<label for="auto-sequential">Sequential Ring</label>
								<div class="row">
									<ul class="clearfix user_list sim ring_options">
									
									
										<?php 
											foreach($ring_options as $key => $value):
											$name_ext = explode("|", $value);
											?>
											<li>
											
												<input type="radio" name="auto-user" value="<?=$name_ext[0]." - ".$name_ext[1]?>"<?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"] == $value ) ? "checked" : "" ; ?> id="<?=$value?>">
												<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
											</li>
										<?php	
											endforeach
										?>
									
										<!--li>
											<input type="radio" name="auto-user" value="101 - Firstname Lastname" id="auto-sim-101">
											<label for="auto-sim-101">101 - Firstname Lastname</label>
										</li>
										<li>
											<input type="radio" name="auto-user" value="102 - Firstname Lastname" id="auto-sim-102">
											<label for="auto-sim-102">102 - Firstname Lastname</label>
										</li>
										<li>
											<input type="radio" name="auto-user" value="103 - Firstname Lastname" id="auto-sim-103">
											<label for="auto-sim-103">103 - Firstname Lastname</label>
										</li>
										<li>
											<input type="radio" name="auto-user" value="104 - Firstname Lastname" id="auto-sim-104">
											<label for="auto-sim-104">104 - Firstname Lastname</label>
										</li-->
									</ul>
									<ul class="clearfix user_list seq ring_options">
									
										<?php 
											foreach($ring_options as $key => $value):
											$name_ext = explode("|", $value);
											?>
											<li>
											
												<input type="checkbox" name="auto-user-seq" value="<?=$name_ext[0]." - ".$name_ext[1]?>"<?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"] == $value ) ? "checked" : "" ; ?> id="<?=$value?>">
												<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
											</li>
										<?php	
											endforeach
										?>
									
									
									
										<!--li>
											<input type="checkbox" value="101 - Firstname Lastname" id="auto-seq-101">
											<label for="auto-seq-101">101 - Firstname Lastname</label>
										</li>
										<li>
											<input type="checkbox" value="102 - Firstname Lastname" id="auto-seq-102">
											<label for="auto-seq-102">102 - Firstname Lastname</label>
										</li>
										<li>
											<input type="checkbox" value="103 - Firstname Lastname" id="auto-seq-103">
											<label for="auto-seq-103">103 - Firstname Lastname</label>
										</li>
										<li>
											<input type="checkbox" value="104 - Firstname Lastname" id="auto-seq-104">
											<label for="auto-seq-104">104 - Firstname Lastname</label>
										</li-->
									</ul>
								</div>
								<div class="row">
									<div class="numform">		
										<button class="subnum">-</button>
						        		<input type="number" class="rings" min="1" max="9" name="" readonly="" value="1">
						        		<button class="addnum">+</button>					  	
						        	</div>
						        	<span> ring(s) before all mised calls goes to voicemail 
						        		<select name="auto-user-voicemail" id="auto-user-voicemail" class="ring_select_option">
											<?php 
											foreach($ring_options as $key => $value):
											$name_ext = explode("|", $value);
											?>
											<option><?=$name_ext[0]?></option>
											<?php	
												endforeach
											?>
							        	</select>
							        </span>
								</div>
			                </div>
		                	<div class="Announcements form-content">
			                    <input type="radio" class="tts text" value="Text to Speech" name="announcements-tts" id="announcements-text" checked="">
			                    <input type="radio" class="tts mp3" value="Upload File" name="announcements-tts" id="announcements-mp3">
			                    <label for="announcements-text" class="text-label tts-nav">Text to Speech</label>
			                    <label for="announcements-mp3" class="mp3-label tts-nav">Upload file</label>
			                    <div class="row type-content text">
			                        <div class="row gender">
			                            <div class="col-xs-6">
			                                <input type="radio" name="attendant-announcements-gender" value="Male" id="attendant-announcements-male" checked>
			                                <label for="attendant-announcements-male">Male</label>
			                            </div>
			                            <div class="col-xs-6">
			                                <input type="radio" name="attendant-announcements-gender" value="Female" id="attendant-announcements-female">
			                                <label for="attendant-announcements-female">Female</label>
			                            </div>
			                        </div>
			                        <div class="row">
			                            <select class="auto-announcements-speech"><!---->
										
			                                <option data-text="Hi, sorry I missed your call. I’m either away at the moment or on the phone, please leave your name and number along with a short message and I’ll be sure to get back to you. Thanks and have a great day!" class="ng-star-inserted"  value="Generic Voicemail">Generic Voicemail</option>
											
			                                <option data-text="Hi, you've reached [Name] at [Company Name]. I'm unavailable right now. Probably helping [type of company] [hire the best and brightest engineers]. Leave your name and number, and we'll discuss how your company can see similar results." class="ng-star-inserted" value="Salesperson">Salesperson</option>
											
			                                <option data-text="Hello. You have reached [Name]. I cannot answer the phone right now, but I will return your call as soon as I can. If this is regarding a recent order, please call our Customer Service Department at [Number]. They are available Monday through Friday from 8 a.m. until 5 p.m. Eastern Time. Or you can log in to our website at [Website]. Otherwise, please leave a message after the beep." class="ng-star-inserted" value="Customer service">Customer service</option>
											
			                                <option data-text="Hi, this is [Name], the sales manager at [Company Name]. I’m either busy assisting customers, getting ready for our End of Season Sale, featuring deep discounts on our huge selection of power sports equipment and gear or if I’m really lucky, I’m out riding the latest CAN-AM DS 250! Leave a message, and I will call you back as soon as possible. Thanks for calling!" class="ng-star-inserted" value="Promotion">Promotion</option>
											
			                                <option data-text=" Hi, this is [Name]. I'm either on a call or away from my desk. Please leave your name, number, and a brief message and I'll get back to you. Thank you." class="ng-star-inserted" value="Short Voicemail">Short Voicemail</option>
											
			                                <option data-text="You have reached [Name] at [Company Name]. Thank you for calling. I apologize for the inconvenience, but if you leave your name, number, and message, I will return your call as soon as possible." class="ng-star-inserted" value="Generic Voicemail">Busy Voicemail</option>
											
			                                <option data-text="Hi, you've reached [Name] at [Company Name]. If you need a quick response, please shoot me an email at [Email] and I'll be in touch by EOD tomorrow. If it's not urgent, leave me a message with your name and number. Have a great day." class="ng-star-inserted" value="Email Me"> Email Me </option>
											
			                                <option data-text=" You have reached [Name] at [Company Name]. Thank you for your call. Please leave your name, number, and message. Sorry I missed your call. If you’re a telemarketer, then I’m definitely not sorry. If you’re not a telemarketer, then I’ll return your call as soon as possible." class="ng-star-inserted" value="Telemarketers">Telemarketers </option>
											
			                                <option data-text="Hello. You have reached [Name], [Marketing Manager] for [Company Name]. I am currently out of the office attending a conference until [August 4th]. I will be checking messages daily, however, if you need immediate assistance, please contact [Marketing Specialist], [Michael Kim] at extension [240]. Otherwise, please leave a message, and I will call you back at my earliest opportunity." class="ng-star-inserted" value="Conference"> Conference </option>
											
			                                <option data-text="Hi, you've reached [Name]. I'm away from [August 4th] to [August 12th]. If you need help with [orders] before then, please contact [Contact] at [Number]. Everyone else, please leave your name and number and I'll return your call when I return. Thanks and have a great day." class="ng-star-inserted" value="Vacation">Vacation </option>
											
			                                <option data-text=" Hi, you've reached [Name] of [Company Name]. We're closed until [January 2nd]. Please leave your name and phone number and someone will return your call ASAP. Have a great [New Years]." class="ng-star-inserted" value="Holiday"> Holiday </option>
											
											<option data-text="Hello, [Name] is chasing new adventures and is no longer with [Company Name]. Please forward all future requests to [Contact] at [Number]. Thank you!" class="ng-star-inserted" value="Left Company">Left Company</option>
											
			                                <option data-text="You've reached the [Delivery Department] of [Company Name]. All of our personnel are currently occupied on the floor. Please leave your contact information and we'll get back to you as soon as possible. Or email us at [Email]" class="ng-star-inserted" value="Department">Department </option>
											
			                                <option data-text="Thank you for calling [Company Name]. No one is available to answer your call right now. Our business hours are Monday through Friday, 9 am to 7 pm. Please leave your name and phone number so that someone from our Customer Success Team can follow up with you. For more information, please visit [Website]." class="ng-star-inserted" value="Company">Company</option>
			                            </select>
			                            <button class="insert-btn">Insert</button>
			                        </div>
			                        <div class="row">
			                            <textarea ></textarea>
			                        </div>
			                        <div class="row">
			                            <audio></audio>
			                        </div>
			                    </div>
			                    <div class="row type-content mp3">
			                        <div class="file-upload">
			                            <input type="file" name=""  data-key-id="<?=$scenario_key_session?>" accept="audio/mp3,audio/*;capture=microphone">
			                        </div>
									
									<div id="file-attachment">
			                            
			                        </div>
			                    </div>
			                </div>
		                	<div class="Voicemail form-content">
		                		<p>Send Voicemail to <input type="email" name="voice-email" placeholder="Email"></p>
			                    <input type="radio" class="tts text" value="Text to Speech" name="voicemail-tts" id="voicemail-text" checked>
			                    <input type="radio" class="tts mp3" value="Upload File" name="voicemail-tts" id="voicemail-mp3">
			                    <label for="voicemail-text" class="text-label tts-nav">Text to Speech</label>
			                    <label for="voicemail-mp3" class="mp3-label tts-nav">Upload file</label>
			                    <div class="row type-content text">
			                        <div class="row gender">
			                            <div class="col-xs-6">
			                                <input type="radio" name="voicemail-gender" value="Male" id="voicemail-male" checked>
			                                <label for="voicemail-male">Male</label>
			                            </div>
			                            <div class="col-xs-6">
			                                <input type="radio" name="voicemail-gender" value="Female" id="voicemail-female">
			                                <label for="voicemail-female">Female</label>
			                            </div>
			                        </div>
			                        <div class="row">
			                            <select class="auto-voicemail-speech"><!---->
			                                <option data-text="Hi, sorry I missed your call. I’m either away at the moment or on the phone, please leave your name and number along with a short message and I’ll be sure to get back to you. Thanks and have a great day!" class="ng-star-inserted"  value="Generic Voicemail">Generic Voicemail</option>
											
			                                <option data-text="Hi, you've reached [Name] at [Company Name]. I'm unavailable right now. Probably helping [type of company] [hire the best and brightest engineers]. Leave your name and number, and we'll discuss how your company can see similar results." class="ng-star-inserted" value="Salesperson">Salesperson</option>
											
			                                <option data-text="Hello. You have reached [Name]. I cannot answer the phone right now, but I will return your call as soon as I can. If this is regarding a recent order, please call our Customer Service Department at [Number]. They are available Monday through Friday from 8 a.m. until 5 p.m. Eastern Time. Or you can log in to our website at [Website]. Otherwise, please leave a message after the beep." class="ng-star-inserted" value="Customer service">Customer service</option>
											
			                                <option data-text="Hi, this is [Name], the sales manager at [Company Name]. I’m either busy assisting customers, getting ready for our End of Season Sale, featuring deep discounts on our huge selection of power sports equipment and gear or if I’m really lucky, I’m out riding the latest CAN-AM DS 250! Leave a message, and I will call you back as soon as possible. Thanks for calling!" class="ng-star-inserted" value="Promotion">Promotion</option>
											
			                                <option data-text=" Hi, this is [Name]. I'm either on a call or away from my desk. Please leave your name, number, and a brief message and I'll get back to you. Thank you." class="ng-star-inserted" value="Short Voicemail">Short Voicemail</option>
											
			                                <option data-text="You have reached [Name] at [Company Name]. Thank you for calling. I apologize for the inconvenience, but if you leave your name, number, and message, I will return your call as soon as possible." class="ng-star-inserted" value="Generic Voicemail">Busy Voicemail</option>
											
			                                <option data-text="Hi, you've reached [Name] at [Company Name]. If you need a quick response, please shoot me an email at [Email] and I'll be in touch by EOD tomorrow. If it's not urgent, leave me a message with your name and number. Have a great day." class="ng-star-inserted" value="Email Me"> Email Me </option>
											
			                                <option data-text=" You have reached [Name] at [Company Name]. Thank you for your call. Please leave your name, number, and message. Sorry I missed your call. If you’re a telemarketer, then I’m definitely not sorry. If you’re not a telemarketer, then I’ll return your call as soon as possible." class="ng-star-inserted" value="Telemarketers">Telemarketers </option>
											
			                                <option data-text="Hello. You have reached [Name], [Marketing Manager] for [Company Name]. I am currently out of the office attending a conference until [August 4th]. I will be checking messages daily, however, if you need immediate assistance, please contact [Marketing Specialist], [Michael Kim] at extension [240]. Otherwise, please leave a message, and I will call you back at my earliest opportunity." class="ng-star-inserted" value="Conference"> Conference </option>
											
			                                <option data-text="Hi, you've reached [Name]. I'm away from [August 4th] to [August 12th]. If you need help with [orders] before then, please contact [Contact] at [Number]. Everyone else, please leave your name and number and I'll return your call when I return. Thanks and have a great day." class="ng-star-inserted" value="Vacation">Vacation </option>
											
			                                <option data-text=" Hi, you've reached [Name] of [Company Name]. We're closed until [January 2nd]. Please leave your name and phone number and someone will return your call ASAP. Have a great [New Years]." class="ng-star-inserted" value="Holiday"> Holiday </option>
											
											<option data-text="Hello, [Name] is chasing new adventures and is no longer with [Company Name]. Please forward all future requests to [Contact] at [Number]. Thank you!" class="ng-star-inserted" value="Left Company">Left Company</option>
											
			                                <option data-text="You've reached the [Delivery Department] of [Company Name]. All of our personnel are currently occupied on the floor. Please leave your contact information and we'll get back to you as soon as possible. Or email us at [Email]" class="ng-star-inserted" value="Department">Department </option>
											
			                                <option data-text="Thank you for calling [Company Name]. No one is available to answer your call right now. Our business hours are Monday through Friday, 9 am to 7 pm. Please leave your name and phone number so that someone from our Customer Success Team can follow up with you. For more information, please visit [Website]." class="ng-star-inserted" value="Company">Company</option>
			                            </select>
			                            <button class="insert-btn">Insert</button>
			                        </div>
			                        <div class="row">
			                            <textarea name="text_to_speech"></textarea>
			                        </div>
			                        <div class="row">
			                            <audio></audio>
			                        </div>
			                    </div>
			                    <div class="row type-content mp3">
			                        <div class="file-upload">
			                           <input type="file" name=""  data-key-id="<?=$scenario_key_session?>" accept="audio/mp3,audio/*;capture=microphone">
			                        </div>
									<div id="file-attachment">
								
								</div>
			                    </div>
			                </div>
			                
		                </div>
					</div>
				</div>
