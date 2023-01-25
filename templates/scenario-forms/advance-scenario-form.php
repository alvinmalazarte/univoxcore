<h1>Advanced Scenario</h1>
				<div class="advanced-config">
					<div class="advanced">
						<h3><i class="fa fa-clock-o"></i> Business Hours</h3>
						<div class="row">
							<select id="day">
								<option value="1">Sunday</option>
								<option value="2">Monday</option>
								<option value="3">Tuesday</option>
								<option value="4">Wednesday</option>
								<option value="5">Thursday</option>
								<option value="6">Friday</option>
								<option value="7">Saturday</option>
							</select>
							<select id="start">
								<option value="6:00 AM">6:00 AM</option>
								<option value="7:00 AM">7:00 AM</option>
								<option value="8:00 AM">8:00 AM</option>
								<option value="9:00 AM">9:00 AM</option>
								<option value="10:00 AM">10:00 AM</option>
								<option value="11:00 AM">11:00 AM</option>
								<option value="12:00 PM">12:00 PM</option>
								<option value="1:00 PM">1:00 PM</option>
								<option value="2:00 PM">2:00 PM</option>
								<option value="3:00 PM">3:00 PM</option>
								<option value="4:00 PM">4:00 PM</option>
								<option value="5:00 PM">5:00 PM</option>
								<option value="6:00 PM">6:00 PM</option>
								<option value="7:00 PM">7:00 PM</option>
								<option value="8:00 PM">8:00 PM</option>
								<option value="9:00 PM">9:00 PM</option>
								<option value="10:00 PM">10:00 PM</option>
							</select>
							<select id="end">
								<option value="6:00 AM">6:00 AM</option>
								<option value="7:00 AM">7:00 AM</option>
								<option value="8:00 AM">8:00 AM</option>
								<option value="9:00 AM">9:00 AM</option>
								<option value="10:00 AM">10:00 AM</option>
								<option value="11:00 AM">11:00 AM</option>
								<option value="12:00 PM">12:00 PM</option>
								<option value="1:00 PM">1:00 PM</option>
								<option value="2:00 PM">2:00 PM</option>
								<option value="3:00 PM">3:00 PM</option>
								<option value="4:00 PM">4:00 PM</option>
								<option value="5:00 PM">5:00 PM</option>
								<option value="6:00 PM">6:00 PM</option>
								<option value="7:00 PM">7:00 PM</option>
								<option value="8:00 PM">8:00 PM</option>
								<option value="9:00 PM">9:00 PM</option>
								<option value="10:00 PM">10:00 PM</option>
							</select>
							<button class="button-blue addBusHrs" name="button-team">+</button>
						</div>
						<div class="row">
							<ul class="busHrs">
								<?php if ( !empty($item["busHrs"]) ): ?>
									<?php foreach ($item["busHrs"] as $key => $value): ?>
										<li>
											<?php 
												
												$hrs = explode(",", $value);
											 ?>
											<p><?= $hrs[0] ?> <a href="#" data-targetid="<?= $hrs[1] ?>"><img draggable="false" class="emoji" alt="✖" src="https://s.w.org/images/core/emoji/11.2.0/svg/2716.svg"></a></p>	
										</li>
									<?php endforeach ?>
								<?php else: ?>
									<li style="background:white;"><span style="color:black">No business hours given.</span></li>
								<?php endif ?>
							</ul>
						</div>
						<div class="row team">
							<h3>Select User to ring</h3>
							<input type="radio" class="ring-type sim" name="advanced-ring-type" id="advanced-simultaneous" checked>
							<label for="advanced-simultaneous">Simultaneous Ring</label>
							<span>&nbsp;&nbsp;or&nbsp;&nbsp;</span>
							<input type="radio" class="ring-type seq" name="advanced-ring-type" id="advanced-sequential"<?= ( $item !== "" && isset($item["ringType"]) && $item["ringType"] == "Sequential Ring" ) ? " checked" : ""; ?>>
							<label for="advanced-sequential">Sequential Ring</label>
							<div class="row col-md-12">
								<ul class="clearfix user_list sim ring_options">
								
									<?php 
									
								
									
											foreach($ring_options as $key => $value):
											$name_ext = explode("|", $value);
											?>
											<li>
											
												<input type="radio" name="advanced-radio-sim" value="<?=$name_ext[0]." - ".$name_ext[1]?>"<?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == $name_ext[0]." - ".$name_ext[1] ) ? "checked" : "" ; ?> id="<?=$value?>">
												<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
												
												
												
											</li>
										<?php	
											endforeach
										?>
								
								
									<!--li>
										
									</li>
									<li>
										<input type="radio" name="advanced-radio-sim" value="102 - Firstname Lastname" id="advanced-sim-102"<?//= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == "advanced-sim-102" ) ? " checked" : ""; ?>>
										<label for="advanced-sim-102">102 - User 1</label>
									</li>
									<li>
										<input type="radio" name="advanced-radio-sim" value="103 - Firstname Lastname" id="sim-103"<?//= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == "advanced-sim-103" ) ? " checked" : ""; ?>>
										<label for="advanced-sim-103">103 - User 1</label>
									</li>
									<li>
										<input type="radio" name="advanced-radio-sim" value="104  - Firstname Lastname" id="advanced-sim-104"<?//= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == "advanced-sim-104" ) ? " checked" : ""; ?>>
										<label for="advanced-sim-104">104 - User 1</label>
									</li-->
								</ul>
								<ul class="clearfix user_list seq ring_options">
								
								
									<?php 
											foreach($ring_options as $key => $value):
											$name_ext = explode("|", $value);
											?>
											<li>
											
												<input type="checkbox" name="advanced-radio-seq" value="<?=$name_ext[0]." - ".$name_ext[1]?>"<?= ( $item !== "" && isset($item["userToRing"]) && in_array( $name_ext[0]." - ".$name_ext[1], $item["userToRing"] ) ) ? "checked" : "" ; ?> id="<?=$value?>">
												<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
												
												
												
											</li>
									<?php	
										endforeach
									?>
								
								
									<!--li>
										<input type="checkbox" name="advanced-radio-seq" value="101 - Firstname Lastname" id="advanced-seq-101"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "advanced-seq-101", $item["userToRing"] ) ) ? " checked" : ""; ?>>
										<label for="advanced-seq-101">101 - User 1</label>
									</li>
									<li>
										<input type="checkbox" name="advanced-radio-seq" value="102 - Firstname Lastname" id="advanced-seq-102"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "advanced-seq-102", $item["userToRing"] ) ) ? " checked" : ""; ?>>
										<label for="advanced-seq-102">102 - User 1</label>
									</li>
									<li>
										<input type="checkbox" name="advanced-radio-seq" value="103 - Firstname Lastname" id="advanced-seq-103"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "advanced-seq-103", $item["userToRing"] ) ) ? " checked" : ""; ?>>
										<label for="advanced-seq-103">103 - User 1</label>
									</li>
									<li>
										<input type="checkbox" name="advanced-radio-seq" value="104 - Firstname Lastname" id="advanced-seq-104"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "advanced-seq-104", $item["userToRing"] ) ) ? " checked" : ""; ?>>
										<label for="advanced-seq-104">104 - User 1</label>
									</li-->
								</ul>
							</div>

						</div>
						<div class="row">
							<div class="numform">							        		
								<button class="subnum">-</button>
				        		<input type="number" class="rings" min="1" max="9" name="" readonly="" value="1">
				        		<button class="addnum">+</button>							        	
				        	</div>
				        	<span> ring(s) before all mised calls goes to voicemail </span>
						</div>
					</div>
					<div class="num_list">
						<ul>
							 <?php 
							 	$content = array();
								
								if(isset($item["selectedForm"]) && $item["selectedForm"] == "advanced"){	$_ispopulate = true;
								}
								else{$_ispopulate = false;}
								
								
								
							 	if ( $item !== "" && isset($item["form_values"] ) && $item["selectedForm"] == "advanced" ): ?>
								 
								 
									
								 <?php
									

								 foreach ($item["form_values"] as $key => $value): ?>
								 	
								 	<?php 
										
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
							<li class="active" data-type="Greetings" data-loaded="<?= ( $item !== "" && $_ispopulate&& isset($item["form_values"]) ) ? ltrim($item["form_values"][0], '|') : "" ;
							?>"  data-attendant-index="0" >
								<a href="#">
									<span class="num">-</span>
									<span class="type">Greetings</span>
								</a>
							</li>
							
							<li class="" data-type="<?= ( isset($content[1][0]) ) ? $content[1][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][1], '|') : "" ; ?>" data-advance-index="1">
								<a href="#">
									<span class="num">1</span>
									<span class="type"><?= ( isset($content[1][0]) ) ? $content[1][0] : "Ring-One" ?>
									
									
									</span>
								</a>
							</li>
							<li data-type='<?= ( isset($content[2][0]) ) ? $content[2][0] : "Ring-One" ?>' data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][2], '|') : "" ; ?>" data-advance-index="2">
								<a href="#">
									<span class="num">2</span>
									<span class="type"><?= ( isset($content[2][0]) ) ? $content[2][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[3][0]) ) ? $content[3][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][3], '|') : "" ; ?>" data-advance-index="3">
								<a href="#">
									<span class="num">3</span>
									<span class="type"><?= ( isset($content[3][0]) ) ? $content[3][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[4][0]) ) ? $content[4][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][4], '|') : "" ; ?>" data-advance-index="4">
								<a href="#">
									<span class="num">4</span>
									<span class="type"><?= ( isset($content[4][0]) ) ? $content[4][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[5][0]) ) ? $content[5][0] : "Ring-One" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][5], '|') : "" ; ?>" data-advance-index="5">
								<a href="#">
									<span class="num">5</span>
									<span class="type"><?= ( isset($content[5][0]) ) ? $content[5][0] : "Ring-One" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[6][0]) ) ? $content[6][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][6], '|') : "" ; ?>" data-advance-index="6">
								<a href="#">
									<span class="num">6</span>
									<span class="type"><?= ( isset($content[6][0]) ) ? $content[6][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[7][0]) ) ? $content[7][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][7], '|') : "" ; ?>" data-advance-index="7">
								<a href="#">
									<span class="num">7</span>
									<span class="type"><?= ( isset($content[7][0]) ) ? $content[7][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[8][0]) ) ? $content[8][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate &&  isset($item["form_values"]) ) ? ltrim($item["form_values"][8], '|') : "" ; ?>" data-advance-index="8">
								<a href="#">
									<span class="num">8</span>
									<span class="type"><?= ( isset($content[8][0]) ) ? $content[8][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[9][0]) ) ? $content[9][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][9], '|') : "" ; ?>" data-advance-index="9">
								<a href="#">
									<span class="num">9</span>
									<span class="type"><?= ( isset($content[9][0]) ) ? $content[9][0] : "No-Configuration" ?></span>
								</a>
							</li>
							<li data-type="<?= ( isset($content[10][0]) ) ? $content[10][0] : "No-Configuration" ?>" data-loaded="<?= ( $item !== "" && $_ispopulate && isset($item["form_values"]) ) ? ltrim($item["form_values"][10], '|') : "" ; ?>" data-advance-index="10">
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
		                    <input type="radio" class="tts text" value="Text to Speech" name="advanced-tts" id="advanced-text" checked="">
		                    <input type="radio" class="tts mp3" value="Upload File" name="advanced-tts" id="advanced-mp3">
		                    <label for="advanced-text" class="text-label tts-nav">Text to Speech</label>
		                    <label for="advanced-mp3" class="mp3-label tts-nav">Upload file</label>
		                    <div class="row type-content text">
		                        <div class="row gender">
		                            <div class="col-xs-6">
		                                <input type="radio" name="advanced-gender" value="Male" id="advanced-male" checked>
		                                <label for="advanced-male">Male</label>
		                            </div>
		                            <div class="col-xs-6">
		                                <input type="radio" name="advanced-gender" value="Female" id="advanced-female">
		                                <label for="advanced-female">Female</label>
		                            </div>
		                        </div>
		                        <div class="row">
		                            <select class="advace-greeting-speech"><!---->
		                                <option data-text="Hi, sorry I missed your call. I’m either away at the moment or on the phone, please leave your name and number along with a short message and I’ll be sure to get back to you. Thanks and have a great day!" class="ng-star-inserted" value="Generic Voicemail">Generic Voicemail</option>

		                                <option data-text="Hi, you've reached [Name] at [Company Name]. I'm unavailable right now. Probably helping [type of company] [hire the best and brightest engineers]. Leave your name and number, and we'll discuss how your company can see similar results." class="ng-star-inserted" value="Salesperson">Salesperson</option>

		                                <option data-text="Hello. You have reached [Name]. I cannot answer the phone right now, but I will return your call as soon as I can. If this is regarding a recent order, please call our Customer Service Department at [Number]. They are available Monday through Friday from 8 a.m. until 5 p.m. Eastern Time. Or you can log in to our website at [Website]. Otherwise, please leave a message after the beep." class="ng-star-inserted" value="Customer service">Customer service</option>

		                                <option data-text="Hi, this is [Name], the sales manager at [Company Name]. I’m either busy assisting customers, getting ready for our End of Season Sale, featuring deep discounts on our huge selection of power sports equipment and gear or if I’m really lucky, I’m out riding the latest CAN-AM DS 250! Leave a message, and I will call you back as soon as possible. Thanks for calling!" class="ng-star-inserted" value="Promotion">Promotion</option>

		                                <option data-text=" Hi, this is [Name]. I'm either on a call or away from my desk. Please leave your name, number, and a brief message and I'll get back to you. Thank you." class="ng-star-inserted" value="Short Voicemail">Short Voicemail</option>

		                                <option data-text="You have reached [Name] at [Company Name]. Thank you for calling. I apologize for the inconvenience, but if you leave your name, number, and message, I will return your call as soon as possible." class="ng-star-inserted" value="Busy Voicemail">Busy Voicemail</option>

		                                <option data-text="Hi, you've reached [Name] at [Company Name]. If you need a quick response, please shoot me an email at [Email] and I'll be in touch by EOD tomorrow. If it's not urgent, leave me a message with your name and number. Have a great day." class="ng-star-inserted" value="Email Me">Email Me </option>

		                                <option data-text="You have reached [Name] at [Company Name]. Thank you for your call. Please leave your name, number, and message. Sorry I missed your call. If you’re a telemarketer, then I’m definitely not sorry. If you’re not a telemarketer, then I’ll return your call as soon as possible." class="ng-star-inserted" value="Telemarketers">Telemarketers </option>

		                                <option data-text="Hello. You have reached [Name], [Marketing Manager] for [Company Name]. I am currently out of the office attending a conference until [August 4th]. I will be checking messages daily, however, if you need immediate assistance, please contact [Marketing Specialist], [Michael Kim] at extension [240]. Otherwise, please leave a message, and I will call you back at my earliest opportunity." class="ng-star-inserted" value="Conference">Conference </option>

		                                <option data-text="Hi, you've reached [Name]. I'm away from [August 4th] to [August 12th]. If you need help with [orders] before then, please contact [Contact] at [Number]. Everyone else, please leave your name and number and I'll return your call when I return. Thanks and have a great day." class="ng-star-inserted" value="Vacation">Vacation </option>

		                                <option data-text=" Hi, you've reached [Name] of [Company Name]. We're closed until [January 2nd]. Please leave your name and phone number and someone will return your call ASAP. Have a great [New Years]." class="ng-star-inserted" value="Holiday"> Holiday </option>

										<option data-text="Hello, [Name] is chasing new adventures and is no longer with [Company Name]. Please forward all future requests to [Contact] at [Number]. Thank you!" class="ng-star-inserted" value="Left Company">Left Company</option>

		                                <option data-text="You've reached the [Delivery Department] of [Company Name]. All of our personnel are currently occupied on the floor. Please leave your contact information and we'll get back to you as soon as possible. Or email us at [Email]" class="ng-star-inserted" value="Department">Department </option>

		                                <option data-text="Thank you for calling [Company Name]. No one is available to answer your call right now. Our business hours are Monday through Friday, 9 am to 7 pm. Please leave your name and phone number so that someone from our Customer Success Team can follow up with you. For more information, please visit [Website]." class="ng-star-inserted" value="Company">Company</option>

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
											
												<input type="radio" name="advanced-user" value="<?=$name_ext[0]." - ".$name_ext[1]?>" <?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"] == $value ) ? "checked" : "" ; ?> id="<?=$value?>">
												<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
												
											</li>
										<?php	
										endforeach
										?>
									
									<!--li>
										<input type="radio" name="advanced-user" value="102 - Firstname Lastname" id="advanced-102">
										<label for="advanced-102">102 - Firstname Lastname</label>
									</li>
									<li>
										<input type="radio" name="advanced-user" value="103 - Firstname Lastname" id="advanced-103">
										<label for="advanced-103">103 - Firstname Lastname</label>
									</li>
									<li>
										<input type="radio" name="advanced-user" value="104 - Firstname Lastname" id="advanced-104">
										<label for="advanced-104">104 - Firstname Lastname</label>
									</li-->
								</ul>
		                	</div>
		                	<div class="Ring-Group form-content">
			                	<input type="radio" class="ring-type sim" name="advanced-group-ring-type" value="Simultaneous Ring" id="advanced-group-simultaneous" checked="">
								<label for="advanced-group-simultaneous">Simultaneous Ring</label>
								<span>or</span>
								<input type="radio" class="ring-type seq" name="advanced-group-ring-type" value="Sequential Ring" id="advanced-group-sequential">
								<label for="advanced-group-sequential">Sequential Ring</label>
								<div class="row">
									<ul class="clearfix user_list sim ring_options">
											<?php 
											foreach($ring_options as $key => $value):
											$name_ext = explode("|", $value);
											?>
											<li>
											
												<input type="radio" name="advanced-user" value="<?=$name_ext[0]." - ".$name_ext[1]?>"<?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"] == $value ) ? "checked" : "" ; ?> id="<?=$value?>">
												<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
												
											</li>
											<?php	
												endforeach
											?>
									
										<!--li>
											<input type="radio" name="advanced-user" value="101 - Firstname Lastname" id="advanced-sim-101" checked>
											<label for="advanced-sim-101">101 - Firstname Lastname</label>
										</li>
										<li>
											<input type="radio" name="advanced-user" value="102 - Firstname Lastname" id="advanced-sim-102"<?//= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == "102 - Firstname Lastname" ) ? " checked" : ""; ?>>
											<label for="advanced-sim-102">102 - Firstname Lastname</label>
										</li>
										<li>
											<input type="radio" name="advanced-user" value="103 - Firstname Lastname" id="advanced-sim-103"<?//= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == "103 - Firstname Lastname" ) ? " checked" : ""; ?>>
											<label for="advanced-sim-103">103 - Firstname Lastname</label>
										</li>
										<li>
											<input type="radio" name="advanced-user" value="104 - Firstname Lastname" id="advanced-sim-104"<?//= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == "104 - Firstname Lastname" ) ? " checked" : ""; ?>>
											<label for="advanced-sim-104">104 - Firstname Lastname</label>
										</li-->
									</ul>
									<ul class="clearfix user_list seq ring_options">
										<?php 
											foreach($ring_options as $key => $value):
											$name_ext = explode("|", $value);
											?>
											<li>
											
												<input type="checkbox" name="advanced-seq" value="<?=$name_ext[0]." - ".$name_ext[1]?>"<?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"] == $value ) ? "checked" : "" ; ?> id="<?=$value?>">
												<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
												
											</li>
											<?php	
												endforeach
											?>
										<!--li>
											<input type="checkbox" name="advanced-seq" value="101 - Firstname Lastname" id="advanced-seq-101"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "101 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
											<label for="advanced-seq-101">101 - Firstname Lastname</label>
										</li>
										<li>
											<input type="checkbox" name="advanced-seq" value="102 - Firstname Lastname" id="advanced-seq-102"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "102 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
											<label for="advanced-seq-102">102 - Firstname Lastname</label>
										</li>
										<li>
											<input type="checkbox" name="advanced-seq" value="103 - Firstname Lastname" id="advanced-seq-103"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "103 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
											<label for="advanced-seq-103">103 - Firstname Lastname</label>
										</li>
										<li>
											<input type="checkbox" name="advanced-seq" value="104 - Firstname Lastname" id="advanced-seq-104"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "104 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
											<label for="advanced-seq-104">104 - Firstname Lastname</label>
										</li-->
									</ul>
								</div>
								<div class="row">
									<div class="numform">		
										<button class="subnum">-</button>
						        		<input type="number" class="rings" min="1" max="9" name="advance-ring-missed" readonly="" value="1">
						        		<button class="addnum">+</button>					  	
						        	</div>
						        	<span> ring(s) before all mised calls goes to voicemail 
						        		<select id="advance-user-voicemail" name="advance-user-voicemail" class="ring_select_option">
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
			                    <input type="radio" class="tts text" value="Text to Speech" name="advanced-announcements-tts" id="advanced-announcements-text" checked="">
			                    <input type="radio" class="tts mp3" value="Upload File" name="advanced-announcements-tts" id="advanced-announcements-mp3">
			                    <label for="advanced-announcements-text" class="text-label tts-nav">Text to Speech</label>
			                    <label for="advanced-announcements-mp3" class="mp3-label tts-nav">Upload file</label>
			                    <div class="row type-content text">
			                        <div class="row gender">
			                            <div class="col-xs-6">
			                                <input type="radio" name="advanced-announcements-gender" value="Male" id="group-male" checked="">
			                                <label for="advanced-announcements-male">Male</label>
			                            </div>
			                            <div class="col-xs-6">
			                                <input type="radio" name="advanced-announcements-gender" value="Female" id="advanced-announcements-female">
			                                <label for="advanced-announcements-female">Female</label>
			                            </div>
			                        </div>
			                        <div class="row">
			                            <select class="advace-announcements-speech"><!---->
			                               <option data-text="Hi, sorry I missed your call. I’m either away at the moment or on the phone, please leave your name and number along with a short message and I’ll be sure to get back to you. Thanks and have a great day!" class="ng-star-inserted" value="Generic Voicemail">Generic Voicemail</option>

		                                <option data-text="Hi, you've reached [Name] at [Company Name]. I'm unavailable right now. Probably helping [type of company] [hire the best and brightest engineers]. Leave your name and number, and we'll discuss how your company can see similar results." class="ng-star-inserted" value="Salesperson">Salesperson</option>

		                                <option data-text="Hello. You have reached [Name]. I cannot answer the phone right now, but I will return your call as soon as I can. If this is regarding a recent order, please call our Customer Service Department at [Number]. They are available Monday through Friday from 8 a.m. until 5 p.m. Eastern Time. Or you can log in to our website at [Website]. Otherwise, please leave a message after the beep." class="ng-star-inserted" value="Customer service">Customer service</option>

		                                <option data-text="Hi, this is [Name], the sales manager at [Company Name]. I’m either busy assisting customers, getting ready for our End of Season Sale, featuring deep discounts on our huge selection of power sports equipment and gear or if I’m really lucky, I’m out riding the latest CAN-AM DS 250! Leave a message, and I will call you back as soon as possible. Thanks for calling!" class="ng-star-inserted" value="Promotion">Promotion</option>

		                                <option data-text=" Hi, this is [Name]. I'm either on a call or away from my desk. Please leave your name, number, and a brief message and I'll get back to you. Thank you." class="ng-star-inserted" value="Short Voicemail">Short Voicemail</option>

		                                <option data-text="You have reached [Name] at [Company Name]. Thank you for calling. I apologize for the inconvenience, but if you leave your name, number, and message, I will return your call as soon as possible." class="ng-star-inserted" value="Busy Voicemail">Busy Voicemail</option>

		                                <option data-text="Hi, you've reached [Name] at [Company Name]. If you need a quick response, please shoot me an email at [Email] and I'll be in touch by EOD tomorrow. If it's not urgent, leave me a message with your name and number. Have a great day." class="ng-star-inserted" value="Email Me">Email Me </option>

		                                <option data-text="You have reached [Name] at [Company Name]. Thank you for your call. Please leave your name, number, and message. Sorry I missed your call. If you’re a telemarketer, then I’m definitely not sorry. If you’re not a telemarketer, then I’ll return your call as soon as possible." class="ng-star-inserted" value="Telemarketers">Telemarketers </option>

		                                <option data-text="Hello. You have reached [Name], [Marketing Manager] for [Company Name]. I am currently out of the office attending a conference until [August 4th]. I will be checking messages daily, however, if you need immediate assistance, please contact [Marketing Specialist], [Michael Kim] at extension [240]. Otherwise, please leave a message, and I will call you back at my earliest opportunity." class="ng-star-inserted" value="Conference">Conference </option>

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
		                	<div class="Voicemail form-content">
		                		<p>Send Voicemail to <input type="email" name="advanced-voice-email" placeholder="Email"></p>
			                    <input type="radio" class="tts text" name="advanced-voicemail-tts" value="Text to Speech" id="advanced-voicemail-text" checked="">
			                    <input type="radio" class="tts mp3" name="advanced-voicemail-tts" value="Upload File" id="advanced-voicemail-mp3">
			                    <label for="advanced-voicemail-text" class="text-label tts-nav">Text to Speech</label>
			                    <label for="advanced-voicemail-mp3" class="mp3-label tts-nav">Upload file</label>
			                    <div class="row type-content text">
			                        <div class="row gender">
			                            <div class="col-xs-6">
			                                <input type="radio" name="advanced-voicemail-gender" value="Male" id="advanced-voicemail-male" checked="">
			                                <label for="advanced-voicemail-male">Male</label>
			                            </div>
			                            <div class="col-xs-6">
			                                <input type="radio" name="advanced-voicemail-gender" value="Female" id="advanced-voicemail-female">
			                                <label for="advanced-voicemail-female">Female</label>
			                            </div>
			                        </div>
			                        <div class="row">
			                            <select class="advace-voicemail-speech"><!---->
			                                <option data-text="Hi, sorry I missed your call. I’m either away at the moment or on the phone, please leave your name and number along with a short message and I’ll be sure to get back to you. Thanks and have a great day!" class="ng-star-inserted" value="Generic Voicemail">Generic Voicemail</option>

		                                <option data-text="Hi, you've reached [Name] at [Company Name]. I'm unavailable right now. Probably helping [type of company] [hire the best and brightest engineers]. Leave your name and number, and we'll discuss how your company can see similar results." class="ng-star-inserted" value="Salesperson">Salesperson</option>

		                                <option data-text="Hello. You have reached [Name]. I cannot answer the phone right now, but I will return your call as soon as I can. If this is regarding a recent order, please call our Customer Service Department at [Number]. They are available Monday through Friday from 8 a.m. until 5 p.m. Eastern Time. Or you can log in to our website at [Website]. Otherwise, please leave a message after the beep." class="ng-star-inserted" value="Customer service">Customer service</option>

		                                <option data-text="Hi, this is [Name], the sales manager at [Company Name]. I’m either busy assisting customers, getting ready for our End of Season Sale, featuring deep discounts on our huge selection of power sports equipment and gear or if I’m really lucky, I’m out riding the latest CAN-AM DS 250! Leave a message, and I will call you back as soon as possible. Thanks for calling!" class="ng-star-inserted" value="Promotion">Promotion</option>

		                                <option data-text=" Hi, this is [Name]. I'm either on a call or away from my desk. Please leave your name, number, and a brief message and I'll get back to you. Thank you." class="ng-star-inserted" value="Short Voicemail">Short Voicemail</option>

		                                <option data-text="You have reached [Name] at [Company Name]. Thank you for calling. I apologize for the inconvenience, but if you leave your name, number, and message, I will return your call as soon as possible." class="ng-star-inserted" value="Busy Voicemail">Busy Voicemail</option>

		                                <option data-text="Hi, you've reached [Name] at [Company Name]. If you need a quick response, please shoot me an email at [Email] and I'll be in touch by EOD tomorrow. If it's not urgent, leave me a message with your name and number. Have a great day." class="ng-star-inserted" value="Email Me">Email Me </option>

		                                <option data-text="You have reached [Name] at [Company Name]. Thank you for your call. Please leave your name, number, and message. Sorry I missed your call. If you’re a telemarketer, then I’m definitely not sorry. If you’re not a telemarketer, then I’ll return your call as soon as possible." class="ng-star-inserted" value="Telemarketers">Telemarketers </option>

		                                <option data-text="Hello. You have reached [Name], [Marketing Manager] for [Company Name]. I am currently out of the office attending a conference until [August 4th]. I will be checking messages daily, however, if you need immediate assistance, please contact [Marketing Specialist], [Michael Kim] at extension [240]. Otherwise, please leave a message, and I will call you back at my earliest opportunity." class="ng-star-inserted" value="Conference">Conference </option>

		                                <option data-text="Hi, you've reached [Name]. I'm away from [August 4th] to [August 12th]. If you need help with [orders] before then, please contact [Contact] at [Number]. Everyone else, please leave your name and number and I'll return your call when I return. Thanks and have a great day." class="ng-star-inserted" value="Vacation">Vacation </option>

		                                <option data-text=" Hi, you've reached [Name] of [Company Name]. We're closed until [January 2nd]. Please leave your name and phone number and someone will return your call ASAP. Have a great [New Years]." class="ng-star-inserted" value="Holiday"> Holiday </option>

										<option data-text="Hello, [Name] is chasing new adventures and is no longer with [Company Name]. Please forward all future requests to [Contact] at [Number]. Thank you!" class="ng-star-inserted" value="Left Company">Left Company</option>

		                                <option data-text="You've reached the [Delivery Department] of [Company Name]. All of our personnel are currently occupied on the floor. Please leave your contact information and we'll get back to you as soon as possible. Or email us at [Email]" class="ng-star-inserted" value="Department">Department </option>

		                                <option data-text="Thank you for calling [Company Name]. No one is available to answer your call right now. Our business hours are Monday through Friday, 9 am to 7 pm. Please leave your name and phone number so that someone from our Customer Success Team can follow up with you. For more information, please visit [Website]." class="ng-star-inserted" value="Company">Company</option>
			                            </select>
			                            <button class="insert-btn">Insert</button>
			                        </div>
			                        <div class="row">
			                            <textarea name="voice_text_to_speech"></textarea>
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
				
	
		
