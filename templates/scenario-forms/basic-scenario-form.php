<h1>Basic Scenario</h1>
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
					<h3>Select User to ring</h3>
					<ul class="clearfix user_list ring_options">
					
						<?php 
						foreach($ring_options as $key => $value):
							$name_ext = explode("|", $value);
							?>
							<li>
							
								<input type="radio" name="basic_user" value="<?=$value?>"<?= ( $item !== "" && isset($item["userToRing"]) && $item["userToRing"] == $value ) ? "checked" : "" ; ?> id="<?=$name_ext[2]?>">
								<label for="<?=$name_ext[2]?>"><?=$name_ext[0]." - ".$name_ext[1]?></label>
							</li>
						<?php	
						endforeach
						?>
					
					</ul>

				</div>
				<div class="row">
					<div class="numform">							        		
						<button class="subnum">-</button>
		        		<input type="number" class="rings" min="1" max="9" name="rings-missed" readonly="" value="<?= ( $item !== '' && isset($item['ringCount']) && $item['ringCount'] !== '' ) ? $item['ringCount'] : '1' ;  ?>">
		        		<button class="addnum">+</button>							        	
		        	</div>
		        	<span> ring(s) before all mised calls goes to voicemail </span>
				</div>
				
