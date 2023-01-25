<?php 

	class Univoxx_Forms{


		public function univoxx_form_transaction(){
			?>
			<form id="univoxx_form" method="post" action="" enctype="multipart">
				<select name="employee_count">
					<option>How many employees?</option>
					<option>1</option>
					<option>2</option>
				</select>
				<input type="text" name="input_zip" placeholder="What is your billing zip code?">
				<input type="text" name="input_employee-email" placeholder="Who should we send the email to?">
				<button type="submit">Configure System</button>
				<br>
				<input type="text" name="input_number">
				<label>Bring your number
					<input type="radio" name="radio_number" value="" checked>
				</label>
				<label>
					New number
					<input type="radio" name="radio_number" value="">
				</label>
				<br>
				<br>
				<section class="select-phone-section">
					<h1>Select Phone & Apps</h1>
					<button class="standard-phone">Standard Phone</button>
					<button class="deluxe-phone">Deluxe Phone</button>
					<button class="wifi-phone">Wifi Phone</button>
					<button class="online-app">Online app</button>
					
					<div class="additional-apps">
						<button class="add-online-fax">Online Fax</button>
						<button class="add-conferencing">Conferencing</button>
						<button class="add-spam-call-bot">Spam Call Bot</button>
						<button class="add-call-recording">Call Recording</button>
						<button class="add-app-gallery">App Gallery</button>
					</div>
				</section>
				<section class="loop-phone">
					<div class="loop-phone-box">
						<div class="loop-phone-choice">
							<select name="loop_choice">
								<option>Standard Phone</option>
								<option>Deluxe Phone</option>
								<option>Wifi Phone</option>
								<option>Online App</option>
							</select>
						</div>
						<div class="loop-phone-form">
							<input type="text" name="input_firstname" placeholder="First Name" value="User 1">
							<input type="text" name="input_lastname" placeholder="Last Name">
							<input type="email" name="input_email" placeholder="Email">
							<input type="text" name="input_direct_dial" placeholder="Direct Dial">
							<input type="text" name="input_ext" placeholder="Ext" value="101">
						</div>
						<hr>
						<button id="loop-call-forwarding">Call Forwarding</button>
						<button id="loop-voicemail">Voicemail</button>

						<div class="hidden-call-forwarding">
							<h5>Call Forwarding Setting</h5>
							<input type="text" name="input_mobile">
							<label>
								Enable
								<input type="radio" name="phone-status" value="Enable">
							</label>
							<label>
								Disable
								<input type="radio" name="phone-status" value="Disable">
							</label>
						</div>

						<div class="hidden-voicemail">
							<h5>Voicemail Setting</h5>
							<p>All <strong>missed calls</strong> go to Voicemail after</p>
							<select>
								
							<?php 

								for ($i=1; $i < 10; $i++) { 
									?>
									<option <?= ($i == 4)?'selected':''; ?>><?= $i ?></option>
									<?php
								}

							 ?>
							</select>
							<div class="tab-loop-section">
								<label>
									Text to Speech
									<input type="radio" name="item_type" value="text-to-speech" checked>
								</label>
								<label>
									Upload File
									<input type="radio" name="item_type" value="upload-file">
								</label>
								<div class="hidden-text-speech">
									<label for="">
										Male
										<input type="radio" name="voice_type" value="male" checked>
									</label>
									<label for="">
										Female
										<input type="radio" value="female" name="voice_type">
									</label>
									<select name="generic-voicemail">
										<option>Generic Voicemail</option>
									</select>
									<textarea name="request_text">
										This is a testing message
									</textarea>
								</div>
								<div class="hidden-dropzone">
									<input type="file">
								</div>
							</div>
						</div>

					</div>
				</section>
				<section>
					<h1>Configure Call Scenarios</h1>
					<label>Basic
						<input type="radio" name="configure_scenario" value="basic" checked>
					</label>
					<label>Team
						<input type="radio" name="configure_scenario" value="team">
					</label>
					<label>Auto Attendant
						<input type="radio" name="configure_scenario" value="auto attendant">
					</label>
					<label>Advanced
						<input type="radio" name="configure_scenario" value="advanced">
					</label>
				</section>
				<section>
					<h1>Express Checkout</h1>
					<h3>Billing Address</h3>
					<div class="item-billing">
						<label>Company</label>
						<input type="text" name="billing_company" placeholder="Enter your Company Name">
					</div>
					<div class="item-billing">
						<label>Name</label>
						<input type="text" name="billing_name" placeholder="Enter your Company Name">
					</div>
					<div class="item-billing">
						<label>Email</label>
						<input type="text" name="billing_company" placeholder="sample@email.com">
					</div>
					<div class="item-billing">
						<label>Phone</label>
						<input type="text" name="billing_phone">
					</div>
					<div class="item-billing">
						<label>Address</label>
						<input type="text" name="billing_address">
					</div>
					<div class="item-billing">
						<label>City</label>
						<input type="text" name="billing_city">
					</div>
					<div class="item-billing">
						<label>State</label>
						<input type="text" name="billing_state">
					</div>
					<div class="item-billing">
						<label>Zip</label>
						<input type="text" name="billing_zip">
					</div>
					<div class="item-billing">
						<label>Card Number</label>
						<input type="text" name="billing_card_number">
					</div>
					<div class="item-billing">
						<input type="checkbox" name="billing_same_address">
						<label>Shipping address same as billing address</label>
					</div>
					<div class="item-billing">
						<input type="checkbox" name="billing_terms">
						<label>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
					</div>
					<div class="item-billing">
						<button>Pay Now</button>
					</div>
				</section>
				<section>
					<h1>Cart Summary</h1>
					<h2>Today's Total</h2>
					<div class="cart-total">$<span class="cart_price">100</span></div>
					<div class="cart-item-container">
						<div class="cart-item">
							<img src="dummyimage.com/250x250/000/fff">
							<p class="item-title"><span class="item-count">1x</span> Standard Phone</p>
							<small>Monthly Charges: $13.95</small>
							<div class="item-price">
								Free
							</div>
						</div>
					</div>
					<div class="cart-delivery-option">
						<div class="delivery-choice">
							<label for="">$49 - One-Day Shipping
								<input type="radio" name="radio_delivery" value="one day shipping" checked>
							</label>
						</div>
						<div class="delivery-choice">
							<label for="">$29.99 - Two-Day Shipping
								<input type="radio" name="radio_delivery" value="two day shipping">
							</label>
						</div>
						<div class="delivery-choice">
							<label for="">$9.99 - No-Rush Shipping
								<input type="radio" name="radio_delivery" value="no rush shipping">
							</label>
						</div>
					</div>
					<div class="cart-total-container">
						<p>Monthly Subtotal <span class="cart-subtotal">$13.95</span></p>
					</div>
					<div class="annual-monthly">
						<div class="choice-item">
							<label for="">Monthly Billing
								<input type="radio" name="radio_billing_type" value="monthly billing" checked>
							</label>
							<label for="">Annual Billing
								<input type="radio" name="radio_billing_type" value="annual billing">
							</label>
						</div>
					</div>
				</section>
			</form>
			<?php
		}

	}

 ?>