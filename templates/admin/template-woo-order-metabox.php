<?php if ( isset( $data->call_scenario_data ) ): ?>
	<?php $item = $data->call_scenario_data; ?>
		<!--pre>
			<#?php //var_dump($item) ?>
		</pre-->

		<div class="admin-call-scenario">
				<!--Basic-->
				<?php if ( $item["selectedForm"] == "basic" ): ?>
					<h2 class="selected-title">Basic Scenario</h2>
					<div class="title">Business Hours</div>
					<ul class="bushrs">
						<?php if ( isset( $item["busHrs"] ) ): ?>
							
							<?php foreach ($item["busHrs"] as $key => $value): ?>
								<?php 
									$days = explode( ",", $value );
								 ?>
								<li class="bushrs-data"><?= $days[0]; ?></li>
							<?php endforeach ?>
						
						<?php else: ?>
	
							<p>No business hours given.</p>

						<?php endif ?>
					</ul>
					<div class="user-to-ring">
						<div class="title">User to ring</div>
						<?php 
							$ring_data = explode(' - ', $item["userToRing"]);
						 ?>
						<div class="user-items">
							<p><strong>Ext: </strong><?= $ring_data[0] ?></p> 
							<p><strong>User: </strong><?= $ring_data[1] ?></p> 
						</div>
					</div>
					<div class="ring-count">
						<p><strong><?= $item["ringCount"]; ?></strong> ring(s) before all mised calls goes to voicemail</p>
					</div>
				<!--End of Basic-->

				<!--Team-->
				<?php elseif( $item["selectedForm"] == "team" ): ?>

					<h2 class="selected-title">Team Scenario</h2>
					<div class="title">Business Hours</div>
					<ul class="bushrs">
						<?php if ( isset( $item["busHrs"] ) ): ?>
							
							<?php foreach ($item["busHrs"] as $key => $value): ?>
								<?php 
									$days = explode( ",", $value );
								 ?>
								<li class="bushrs-data"><?= $days[0]; ?></li>
							<?php endforeach ?>
						
						<?php else: ?>
	
							<p>No business hours given.</p>

						<?php endif ?>
					</ul>
					<div class="user-to-ring">
						<div class="title">User to ring</div>
						<p class="ring-type"><?= $item["ringType"]; ?></p>
						
						<?php foreach ($item["userToRing"] as $key => $value): ?>
							<?php 
								$ring_data = explode(' - ', $value);
							 ?>
							<div class="user-items">
								<p><strong>Ext: </strong><?= $ring_data[0] ?></p> 
								<p><strong>User: </strong><?= $ring_data[1] ?></p> 
							</div>
						<?php endforeach ?>

					</div>
					<div class="ring-count">
						<p><strong><?= $item["ringCount"]; ?></strong> ring(s) before all mised calls goes to voicemail</p>
					</div>
					
				<!--End of Team-->

				<!--Auto Attendant-->
				<?php elseif ( $item["selectedForm"] == "auto-attendant" ): ?>
					<h2 class="selected-title">Auto Attendant Scenario</h2>
					<?php foreach ($item["form_values"] as $key => $value): ?>
						<?php 
							$field = explode("|", $value);
							var_dump($value);
						 ?>

						 <?php if ( $field[0] == "Greetings" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<div class="voice-gender"><strong>Voice Gender: </strong><?= ( isset( $field[1] ) ) ? $field[1] : 'Male' ; ?></div>
								<div class="voice-value"><strong>Voice Text: </strong><?= ( isset( $field[2] ) ) ? $field[2] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "Ring-One" ): ?>
							<div class="config-items">
								<div class="user-ring">
									<?php 
										$ring_data = explode(' - ', $field[1]);
									 ?>
									<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
									<div class="user-items">
										<div><strong>Ext: </strong><?= $ring_data[0] ?></div> 
										<div><strong>User: </strong><?= $ring_data[1] ?></div> 
									</div>
								</div>
							</div>
						<?php elseif( $field[0] == "Ring-Group" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<?php $decoded_data = json_decode(stripslashes($field[2])) ?>
								<div class="ring-type">
									<strong>Ring Type: </strong><?= $field[1]; ?>
								</div>

								<?php foreach ( $decoded_data as $key => $value ): ?>
									<?php 
										$ring_data = explode(' - ', $value);
									 ?>
									<div class="user-items">
										<p><strong>Ext: </strong><?= $ring_data[0] ?></p> 
										<p><strong>User: </strong><?= $ring_data[1] ?></p> 
									</div>
								<?php endforeach ?>

								<div><strong><?= ( isset( $field[3] ) ) ? $field[3] : '' ; ?></strong> ring(s) before all mised calls goes to voicemail</div>
								<div><strong>Selected User: </strong><?= ( isset( $field[4] ) ) ? $field[4] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "Announcements" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<div class="voice-gender"><strong>Voice Gender: </strong><?= ( isset( $field[1] ) ) ? $field[1] : 'Male' ; ?></div>
								<div class="voice-value"><strong>Voice Text: </strong><?= ( isset( $field[2] ) ) ? $field[2] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "Voicemail" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<div class="user-email"><strong>Email: </strong><?= ( isset( $field[1] ) ) ? $field[1] : '' ; ?></div>
								<div class="voice-gender"><strong>Voice Gender: </strong><?= ( isset( $field[2] ) ) ? $field[2] : 'Male' ; ?></div>
								<div class="voice-value"><strong>Voice Text: </strong><?= ( isset( $field[3] ) ) ? $field[3] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "No-Configuration" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
							</div>
						<?php endif; ?>
					<?php endforeach ?>
				<!--End of Auto Attendant-->

				<!--Advanced-->
				<?php elseif ( $item["selectedForm"] == "advanced" ): ?>
					<h2 class="selected-title">Advanced Scenario</h2>

					<div class="title">Business Hours</div>
					<ul class="bushrs">
						<?php if ( isset( $item["busHrs"] ) ): ?>
							
							<?php foreach ($item["busHrs"] as $key => $value): ?>
								<?php 
									$days = explode( ",", $value );
								 ?>
								<li class="bushrs-data"><?= $days[0]; ?></li>
							<?php endforeach ?>
						
						<?php else: ?>
	
							<p>No business hours given.</p>

						<?php endif ?>
					</ul>
					<div class="user-to-ring">
						<div class="title">User to ring</div>
						<p class="ring-type"><?= $item["ringType"]; ?></p>
						
						<?php foreach ($item["userToRing"] as $key => $value): ?>
							<?php 
								$ring_data = explode(' - ', $value);
							 ?>
							<div class="user-items">
								<p><strong>Ext: </strong><?= $ring_data[0] ?></p> 
								<p><strong>User: </strong><?= $ring_data[1] ?></p> 
							</div>
						<?php endforeach ?>

					</div>
					<div class="ring-count">
						<p><strong><?= $item["ringCount"]; ?></strong> ring(s) before all mised calls goes to voicemail</p>
					</div>

					<?php foreach ($item["form_values"] as $key => $value): ?>
						<?php 
							$field = explode("|", $value);
						 ?>

						 <?php if ( $field[0] == "Greetings" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<div class="voice-gender"><strong>Voice Gender: </strong><?= ( isset( $field[1] ) ) ? $field[1] : 'Male' ; ?></div>
								<div class="voice-value"><strong>Voice Text: </strong><?= ( isset( $field[2] ) ) ? $field[2] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "Ring-One" ): ?>
							<div class="config-items">
								<div class="user-ring">
									<?php 
										$ring_data = explode(' - ', $field[1]);
									 ?>
									<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
									<div class="user-items">
										<div><strong>Ext: </strong><?= $ring_data[0] ?></div> 
										<div><strong>User: </strong><?= $ring_data[1] ?></div> 
									</div>
								</div>
							</div>
						<?php elseif( $field[0] == "Ring-Group" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<?php $decoded_data = json_decode(stripslashes($field[2])) ?>
								<div class="ring-type">
									<strong>Ring Type: </strong><?= $field[1]; ?>
								</div>

								<?php foreach ( $decoded_data as $key => $value ): ?>
									<?php 
										$ring_data = explode(' - ', $value);
									 ?>
									<div class="user-items">
										<p><strong>Ext: </strong><?= $ring_data[0] ?></p> 
										<p><strong>User: </strong><?= $ring_data[1] ?></p> 
									</div>
								<?php endforeach ?>

								<div><strong><?= ( isset( $field[3] ) ) ? $field[3] : '' ; ?></strong> ring(s) before all mised calls goes to voicemail</div>
								<div><strong>Selected User: </strong><?= ( isset( $field[4] ) ) ? $field[4] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "Announcements" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<div class="voice-gender"><strong>Voice Gender: </strong><?= ( isset( $field[1] ) ) ? $field[1] : 'Male' ; ?></div>
								<div class="voice-value"><strong>Voice Text: </strong><?= ( isset( $field[2] ) ) ? $field[2] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "Voicemail" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
								<div class="user-email"><strong>Email: </strong><?= ( isset( $field[1] ) ) ? $field[1] : '' ; ?></div>
								<div class="voice-gender"><strong>Voice Gender: </strong><?= ( isset( $field[2] ) ) ? $field[2] : 'Male' ; ?></div>
								<div class="voice-value"><strong>Voice Text: </strong><?= ( isset( $field[3] ) ) ? $field[3] : '' ; ?></div>
							</div>
						<?php elseif( $field[0] == "No-Configuration" ): ?>
							<div class="config-items">
								<div class="config-type"><?= ( isset( $field[0] ) ) ? $field[0] : '' ; ?></div>
							</div>
						<?php endif; ?>
					<?php endforeach ?>
				<!--Advanced-->
			<?php endif; ?>
		</div>
	<?php else: ?>
		<h3>Empty</h3>
<?php endif ?>