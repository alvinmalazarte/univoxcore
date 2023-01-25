<h1>Team Scenario</h1>
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
					<button class="button-blue addBusHrs" name="button-basic">+</button>
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
				<div class="row">
					<h3>Select User to ring</h3><input type="radio" class="ring-type sim" name="team-ring-type" id="team-simultaneous" checked="">
					<label for="team-simultaneous">Simultaneous Ring</label>
					<span>&nbsp;&nbsp;or&nbsp;&nbsp;</span>
					<input type="radio" class="ring-type seq" name="team-ring-type" id="team-sequential"<?= ( $item !== "" && isset($item["ringType"]) && $item["ringType"] == "Sequential Ring" ) ? " checked" : ""; ?>>
					<label for="team-sequential">Sequential Ring</label>
					<div class="row row col-md-12">
						<ul class="clearfix user_list sim ring_options">
						
							<?php 
							foreach($ring_options as $key => $value):
							$name_ext = explode("|", $value);
								?>
								<li>
								
									<input type="radio" name="team_sim_ring" value="<?=$value?>" <?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"][0] == $value ) ? " checked" : ""; ?> id="<?=$value?>">
									
									<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
								</li>
								
								
								
								
							<?php	
							endforeach
							?>
						
						
						</ul>
						<ul class="clearfix user_list seq ring_options">
						
							<?php 
							foreach($ring_options as $key => $value):
							$name_ext = explode("|", $value);
								?>
								<li>
								
									
									
									
									<input type="checkbox" name="team-seq-ring" value="<?=$value?>" <?= ( $item !== "" && isset($item["userToRing"]) && in_array( $value, $item["userToRing"] ) ) ? "checked" : ""; ?> id="<?=$value?>">
									<label for="<?=$value?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
									
								</li>
								
								
								
								
							<?php	
							endforeach
							?>
						
						
							<!--li>
								<input type="checkbox" name="team-seq-ring" value="101 - Firstname Lastname" id="seq-101"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "101 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
								<label for="seq-101">101 - Firstname Lastname</label>
							</li>
							<li>
								<input type="checkbox" name="team-seq-ring" value="102 - Firstname Lastname" id="seq-102"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "102 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
								<label for="seq-102">102 - Firstname Lastname</label>
							</li>
							<li>
								<input type="checkbox" name="team-seq-ring" value="103 - Firstname Lastname" id="seq-103"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "103 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
								<label for="seq-103">103 - Firstname Lastname</label>
							</li>
							<li>
								<input type="checkbox" name="team-seq-ring" value="104 - Firstname Lastname" id="seq-104"<?//= ( $item !== "" && isset($item["userToRing"]) && in_array( "104 - Firstname Lastname", $item["userToRing"] ) ) ? " checked" : ""; ?>>
								<label for="seq-104">104 - Firstname Lastname</label>
							</li-->
						</ul>
					</div>

				</div>
				<div class="row">
					<div class="numform">							        		
						<button class="subnum">-</button>
		        		<input type="number" class="rings" min="1" max="9" name="team-rings-missed" readonly="" value="<?= ( $item !== "" && isset($item["ringCount"]) ) ? $item["ringCount"] : "1"; ?>">
		        		<button class="addnum">+</button>							        	
		        	</div>
		        	<span> ring(s) before all mised calls goes to voicemail </span>
				</div>
				
