(function($){
"use strict";

	$(document).ready(function(){

		function fireToaster(type, title){
			const Toast = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 3000
			});

			Toast.fire({
			  type: type,
			  title: title
			});
		}

		/* $(".add_to_cart").each( function(){
			let product_id = $(this).attr("href").split("=").pop();
			$(this).attr("data-id", product_id);
			$(this).attr("href", "#");
			$(this).attr("rel", "nofollow");
		} ); */

		$( document ).on( 'click', '.add_to_cart', function(event) {
			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();
			 let thisbutton = $(this);
        	
			let product_url = $(this).attr("href");
			
			let url_string =  window.location.href+product_url; //window.location.href
			let url = new URL(url_string);
			let product_id = url.searchParams.get("add-to-cart");
			let product_qty = 1;
			
			
			let data = {
	            action			: 'univoxx_ajax_add_to_cart',
	            product_id 		: product_id,
	            quantity		: product_qty
	        };
			//console.log(data);
	         //$(document.body).trigger('adding_to_cart', [thisbutton, data]);

	        $.ajax({
	            type: 'POST',
	            url: the_ajax_object.ajax_url,
	            data: data,
	            dataType : "json",
	            beforeSend: function (response) {
	                thisbutton.removeClass('added').addClass('loading');
	            },
	            complete: function (response) {
	                thisbutton.addClass('added').removeClass('loading');
	            },
	            success: function (response) {
					
					console.log(response[0]);
					 

	                if (response[0].error) {
	                    fireToaster("error", "Something went wrong.");
	                } else {
	                	if ( response[0].product_type == "phone_apps" ) {
	                    	
	                    	$(document).find(".selected-phones-row").append(defaultCartLoop(response[0].cart_key, response[0].product_name, response[0].product_image, response[0].product_id));
	                    	fireToaster("success", response[0].product_name+" added successfully");

	                    	/* romano 70919 */
							$( document).data( "ring_options").push("User 1|101|"+response[0].cart_key);
						
							update_input_scenario();
							
							/* end romano 70919 */

	                	}else if ( response[0].product_type == "call_recording" ) {
	                    	
	                    	$(document).find(".selected-phones-row").append(callRecordingCartLoop(response[0].cart_key, response[0].product_name, response[0].product_image, response[0].product_id));
	                    	fireToaster("success", response[0].product_name+" added successfully");

	                	}else if ( response[0].product_type == "conferencing" ) {
	                    	
	                    	$(document).find(".selected-phones-row").append(conferencingCartLoop(response[0].cart_key, response[0].product_name, response[0].product_image, response[0].product_id));
	                    	fireToaster("success", response[0].product_name+" added successfully");

	                	}else if ( response[0].product_type == "online_fax" ) {
	                    	
	                    	$(document).find(".selected-phones-row").append(efaxCartLoop(response[0].cart_key, response[0].product_name, response[0].product_image, response[0].product_id));
	                    	fireToaster("success", response[0].product_name+" added successfully");

	                	}else if ( response[0].product_type == "spam_call_bot" ) {
	                    	
	                    	$(document).find(".selected-phones-row").append(spamCallBotCartLoop(response[0].cart_key, response[0].product_name, response[0].product_image, response[0].product_id));
	                    	fireToaster("success", response[0].product_name+"  added successfully");

	                	}
	                	//  - 70919
	                	extCartItemCount();

	                	if( $("body").find(".loop-item").length == 1 ){
	                		showCheckoutForm();
	                	}
	                	//  - 70919 end

	                	$('body').trigger('update_checkout');
	                    $( ".form-row.phone-setting" ).tabs();
	                }
	            },
	        }); 
		});

		/* romano 70919 */
		function update_input_scenario(){
			var basic_user = "";
			var team_sim_ring = "";
			var team_seq_ring = "";
			
			var auto_ring_one = "";
			var auto_ring_group_simultaneous = "";
			var auto_ring_group_sequential = "";
			var auto_voicemail_option = "";
			
			var advanced_simultaneous = "";
			var advanced_sequential = "";
			
			var advance_ring_one = "";
			var advance_ring_group_simultaneous = "";
			var advance_ring_group_sequential = "";
			var advance_voicemail_option = "";
			
			
		/* 	var team_seq_ring = "";
			var team_seq_ring = ""; */
			
			$.each($( document).data( "ring_options")  , function(key , value){
				//console.log(value);
				var data = value.split("|");
				if(value !== undefined && value !== "undefined" ){
				/* basic_user */
				 basic_user += '<li><input type="radio" name="basic_user" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 /* team_sim_ring */
				 team_sim_ring += '<li><input type="radio" name="team_sim_ring" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 /* team_seq_ring */
				 team_seq_ring += '<li><input type="checkbox" name="team-seq-ring" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 
				 /*  auto_ring_one */
				 auto_ring_one += '<li><input type="radio" name="auto-user" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 
				 /*  auto_ring_group_simultaneous */
				 auto_ring_group_simultaneous += '<li><input type="radio" name="auto-user" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 
				 /*  auto_ring_group_sequential */
				 auto_ring_group_sequential += '<li><input type="checkbox" name="auto-user-seq" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 
				 /*  auto_voicemail_option */
				 auto_voicemail_option += '<option>'+data[0]+'</option>';
				 
				 
				 
			
			
				  
				 /*  advanced_simultaneous */
				 advanced_simultaneous += '<li><input type="radio" name="advanced-radio-sim" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				  /*  advanced_simultaneous */
				 advanced_sequential += '<li><input type="checkbox" name="advanced-radio-seq" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				
				 /*  */
			/* 	 var advance_ring_one = "";
			var advance_ring_group_simultaneous = "";
			var advance_ring_group_sequential = "";
			var advance_voicemail_option = ""; */
				 
				  /*  auto_ring_one */
				 advance_ring_one += '<li><input type="radio" name="advanced-user" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 
				 /*  auto_ring_group_simultaneous */
				 advance_ring_group_simultaneous += '<li><input type="radio" name="advanced-user" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 
				 /*  auto_ring_group_sequential */
				 advance_ring_group_sequential += '<li><input type="checkbox" name="advanced-seq" value="'+value+'" id="'+data[2]+'"><label for="'+data[2]+'">'+data[0]+' - '+data[1]+'</label></li>';
				 
				 
				 /*  auto_voicemail_option */
				 advance_voicemail_option += '<option>'+data[0]+'</option>';
				 
				 
				 
				 }
			});
			$(".call-scenario .basic .user_list.ring_options").html(basic_user);
			$(".call-scenario .team .user_list.sim.ring_options").html(team_sim_ring);
			$(".call-scenario .team .user_list.seq.ring_options").html(team_seq_ring);
			
			
			/* Auto CONFIGURE */
			$(".call-scenario .auto-attendant .Ring-One .user_list.ring_options").html(auto_ring_one);
			
			$(".call-scenario .auto-attendant .Ring-Group .user_list.sim.ring_options").html(auto_ring_group_simultaneous);
			
			$(".call-scenario .auto-attendant .Ring-Group .user_list.seq.ring_options").html(auto_ring_group_sequential);
			
			$(".call-scenario .auto-attendant .Ring-Group select#auto-user-voicemail").html(auto_voicemail_option);
			/* End Auto  CONFIGURE */
			
			
			/* Auto CONFIGURE */
			$(".call-scenario .advanced .user_list.sim.ring_options").html(advanced_simultaneous);
			
			$(".call-scenario .advanced .user_list.seq.ring_options").html(advanced_sequential);
			
	
			$(".call-scenario .advanced .Ring-One .user_list.ring_options").html(advance_ring_one);
			
			$(".call-scenario .advanced .Ring-Group .user_list.sim.ring_options").html(advance_ring_group_simultaneous);
			
			$(".call-scenario .advanced .Ring-Group .user_list.seq.ring_options").html(advance_ring_group_sequential);
			
			$(".call-scenario .advanced .Ring-Group select#advance-user-voicemail").html(advance_voicemail_option);
			/* End Auto  CONFIGURE */
			
		}
		/* end romano 70919 */

		//  - 70919
		extCartItemCount();

		function extCartItemCount(){
			let cartItemCount = 0;
			let firstLoopNum = $(".loop-item:first-child [name='phone_ext']").val();
			$(".loop-item").each(function(){
	    		$(this).find("[name='phone_ext']").val(parseInt(firstLoopNum) + cartItemCount);

	    		$(this).find("[name='phone_ext']")[0].maxLength = 3;
	    		cartItemCount++;

	    	});
	    	$(".loop-item:not(:first-child) [name='phone_ext']").prop("disabled", "disabled").attr("style", "cursor: not-allowed;");
		}

		let eventTimeout;
		$('[name="phone_ext"]').on("keyup paste", function(){
			clearTimeout(eventTimeout);
			eventTimeout = setTimeout(function(){
				extCartItemCount();
			}, 500);
		});

		function showCheckoutForm(){
			let data_cart = {
	            action			: 'univoxx_show_cart'
	        };

        	$.ajax({
	            type: 'POST',
	            url: the_ajax_object.ajax_url,
	            data: data_cart,
	            dataType : "json",
	            success: function (res) {
	            	$(".woocommerce").html(`${res}`);
	            	//$('body').trigger('update_checkout');
	            	$("#place_order").attr("type", "button").addClass("disabled-button");
	        	}
	        });
		}
		//  - 70919 end

		$( document ).on( 'click', '.remove-item', function(event){

			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();

			let removeButton = $(this);

			let cart_item_key = removeButton.parents(".loop-item").find('input.form-control').attr("data-cart-id");;
			
			let data = {
	            action: 'univoxx_remove_item_from_cart',
	            cart_item_key: cart_item_key
	        };


			$.ajax({
		        type: "POST",
		        url: the_ajax_object.ajax_url,
		        data: data,
		        success: function (response) {
		            if (response) {
		            	removeButton.parents(".loop-item").remove();
		            	$('body').trigger('update_checkout');
		                fireToaster("success", "Product removed successfully");
		                //  - 70919
		                extCartItemCount();
		                //  - 70919 end
		                
		                /* romano 70919 */
						var key_ring = key_option_rings(cart_item_key);
						
						$( document).data( "ring_options").pop(key_ring);
						
						update_input_scenario();
						/* end romano 70919 */
		            }else{
		            	fireToaster("error", "Product remove failed");
		            }
		        }
		    });
		} );

		/* romano 70919 */
		function key_option_rings(cart_id){
			var return_key = "";
			$.each($( document).data( "ring_options")  , function(key , value){
				//console.log(value);
				var data = value.split("|");
				var find_key = data.includes(cart_id);
				
				if(find_key){
					return_key = key;
					return false;
				}
			})
			return return_key; 
		}
		/* end romano 70919 */

		function defaultCartLoop(cart_key,product_name, product_image, product_id){
			//70519
			let html = `
			<div class="card col-md-6 loop-item">
				<input type="hidden" name="phone_type">
				  <div class="card-body">
				  	<select name="" class="product-name-option" data-cart-id="${cart_key}">
						<option data-id="16501" value="Standard Phone"${product_name == "Standard Phone" ? " selected" : ""}>Standard Phone</option>
						<option data-id="16507" value="Deluxe Phone"${product_name == "Deluxe Phone" ? " selected" : ""}>Deluxe Phone</option>
						<option data-id="16506" value="Wireless Phone"${product_name == "Wireless Phone" ? " selected" : ""}>Wireless Phone</option>
						<option data-id="16508" value="UniVoxx Online App"${product_name == "UniVoxx Online App" ? " selected" : ""}>UniVoxx Online App</option>
					</select>
				  	<div class="form-row justify-content-between right-panel">
					  	
						<div class="align-items-center">
		
						<a href="?remove_item=${cart_key}&_wpnonce=6de1aaded0" class="remove" aria-label="${cart_key}" data-product_id="${product_id}" ><i class="fa fa-trash fa-2x remove-item"></i></a>
		
						</div>
				  	</div>
				    <hr>
				    <div class="row">
				    	<div class="col-md-12" id="image_cart_thumbnail">
							${product_image}
				    	</div>
						  </div>
						<div class="row">
				    	<div class="col-md-12" >
			    		
						  <div class="form-row">
						<div class="form-group col-md-6">
							<input type="text" class="form-control ${cart_key}" name="first_name" id="first_name_${cart_key}" data-cart-id="${cart_key}" placeholder="First Name">
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control ${cart_key}" name="last_name" id="last_name_${cart_key}" data-cart-id="${cart_key}" placeholder="Last Name">
						</div>
					</div>
					 
					<div class="form-group">
						 <input type="email" class="form-control ${cart_key}" name="phone_email" id="phone_email_${cart_key}" data-cart-id="${cart_key}" placeholder="Email">
					</div>
					<div class="form-row">
					<div class="form-group col-md-6">
						<input type="number" class="form-control ${cart_key}" name="phone_direct_dial" id="phone_direct_dial_${cart_key}" data-cart-id="${cart_key}" placeholder="Direct Dial" style="
    display: flex;
">
						<div id="number_modal"><i class="fas fa-align-center"></i></div>
					</div>
					<div class="form-group col-md-4">
						<input type="text" class="form-control ${cart_key}" name="phone_ext" id="phone_ext_${cart_key}" data-cart-id="${cart_key}" placeholder="101" ></div>
					</div>

					<div class="form-row phone-setting ui-tabs ui-widget ui-widget-content ui-corner-all">
						
						<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
							<li class="ui-state-default ui-corner-top"><a href="#phone-voice-mail" class="ui-tabs-anchor"><span>Voicemail</span></a></li>
							<li class="ui-state-default ui-corner-top"><a href="#phone-call-forwarding" class="ui-tabs-anchor"><span>Call Forwarding</span></a></li>
						</ul>

					<div class="hidden-voicemail col-md-12" id="phone-voice-mail" style="display:none;">

						<h5>Voicemail Settings</h5>
						<p>All <strong>missed calls</strong> go to Voicemail after</p>

						<div class="pt-3">

							<div class="tab-content" id="pills-tabContent">
							  <div class="tab-pane fade show active" id="pills-text-to-speech" role="tabpanel" aria-labelledby="pills-text-to-speech-tab">


								<div class="form-group">
					<select name="voicemail_text_value"  class="form-control mt-3 select-text-value ${cart_key}" id="voicemail_text_value_${cart_key}" data-cart-id="${cart_key}">
						
					</select>

					<button id="insert_text_to_voice"> Insert	</button>
					</div>
					<div class="form-group">
					<textarea class="form-control voice-text ${cart_key}" name="voice_text" id="phone_ext_${cart_key}" data-cart-id="${cart_key}" rows="8" cols="50" placeholder="Text to be played as audio" ></textarea >
								<div id="audio_converted">
								
								</div>
								
							</div>

						  </div>
						  <div class="tab-pane fade" id="pills-upload" role="tabpanel" aria-labelledby="pills-upload-tab">
						  	<div class="custom-file">
							  <input type="file" class="custom-file-input" id="customFile" value="c:/passwords.txt">
							  <label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						  </div>
						  
						 
						</div>
						
					</div>

					 </div>
					 
					 <div class="hidden-call-forwarding col-md-12" id="phone-call-forwarding">
										<h5>Call Forwarding Settings</h5>
										<div class="form-group">
										   
					<input type="text" class="form-control ${cart_key}" name="mobile_number" id="mobile_number_${cart_key}" data-cart-id="${cart_key}" placeholder="Mobile Number">
										</div>
										<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" class="custom-control-input ${cart_key}" name="call_forwarding_option_${cart_key}" id="call_forwarding_option_enable_${cart_key}" data-cart-id="${cart_key}" value="enable"><label class="custom-control-label" for="call_forwarding_option_enable_${cart_key}">Enable</label>
										
										</div>
										<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" class="custom-control-input ${cart_key}" name="call_forwarding_option_${cart_key}" id="call_forwarding_option_disable_${cart_key}" data-cart-id="${cart_key}" value="disable" checked="checked"> <label class="custom-control-label" for="call_forwarding_option_disable_${cart_key}">Disable</label>
										  
										</div>
									</div>
									
									
					</div>
					
			    	</div>
			    <hr>
			   

			  </div>
		</div>
	</div>
			`;

			return html;
		}

		function callRecordingCartLoop(cart_key,product_name, product_image, product_id){
			let html = `
				<div class="card col-md-6 loop-item">
				<input type="hidden" name="phone_type">
				  <div class="card-body">
				  	<h5 class="card-title product-name" data-title="Product">
					${product_name}
					
					</h5>
				  	<div class="form-row justify-content-between right-panel">
					  	
						<div class="align-items-center">
		
						<a href="?remove_item=${cart_key}&_wpnonce=6de1aaded0" class="remove" aria-label="${cart_key}" data-product_id="${product_id}" ><i class="fa fa-trash fa-2x remove-item"></i></a>
		
						</div>
				  	</div>
				    <hr>
				    <div class="row">
				    	<div class="col-md-12" id="image_cart_thumbnail">
							${product_image}
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12" >
							<div class="form-group">
								<input type="email" class="form-control prefix-cart-phone_email" name="phone_email" id="phone_email_${cart_key}" data-cart-id="${cart_key}" placeholder="Email" value="">
							</div>


							<div class="form-row phone-setting">
								
							<h5>Record All Incoming Calls</h5>

								<div class="custom-control custom-radio custom-control-inline">

									<input type="radio" class="custom-control-input prefix-cart-incoming_calls_option" name="incoming_calls_option_${cart_key}" id="incoming_calls_option_yes_${cart_key}" data-cart-id="${cart_key}" value="yes" checked>
									<label class="custom-control-label" for="incoming_calls_option_yes_${cart_key}">Yes</label>

								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input prefix-cart-incoming_calls_option" name="incoming_calls_option_${cart_key}" id="incoming_calls_option_no_${cart_key}" data-cart-id="${cart_key}" value="no"> 
									<label class="custom-control-label" for="incoming_calls_option_no_${cart_key}">No</label>
								</div>

								<h5>Record All Outgoing Calls</h5>

								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input prefix-cart-outgoing_calls_option" name="outgoing_calls_option_${cart_key}" id="outgoing_calls_option_yes_${cart_key}" data-cart-id="${cart_key}" value="yes" checked>
									<label class="custom-control-label" for="outgoing_calls_option_yes_${cart_key}">Yes</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input prefix-cart-outgoing_calls_option" name="outgoing_calls_option_${cart_key}" id="outgoing_calls_option_no_${cart_key}" data-cart-id="${cart_key}" value="no"> 
									<label class="custom-control-label" for="outgoing_calls_option_no_${cart_key}">No</label>
								</div>		
							</div>
				    	</div>
				    </div>
				</div>
			</div>
			`;

			return html;
		}

		function conferencingCartLoop(cart_key,product_name, product_image, product_id){
			let html = `
				<div class="card col-md-6 loop-item">
				<input type="hidden" name="phone_type">
				  <div class="card-body">
				  	<h5 class="card-title product-name" data-title="Product">
					${product_name}
					
					</h5>
				  	<div class="form-row justify-content-between right-panel">
					  	
						<div class="align-items-center">
		
						<a href="?remove_item=${cart_key}&_wpnonce=6de1aaded0" class="remove" aria-label="${cart_key}" data-product_id="${product_id}" ><i class="fa fa-trash fa-2x remove-item"></i></a>
		
						</div>
				  	</div>
				    <hr>
				    <div class="row">
				    	<div class="col-md-12" id="image_cart_thumbnail">
							${product_image}
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12" >
							<div class="form-group">
								<input type="email" class="form-control prefix-cart-phone_email" name="phone_email" id="phone_email_${cart_key}" data-cart-id="${cart_key}" placeholder="Email" value="">
							</div>
							<div class="form-group">
							 <input type="email" class="form-control prefix-cart-phone_email" name="phone_email" id="phone_email_${cart_key}" data-cart-id="${cart_key}" placeholder="Email" value="">
							</div>
				    	</div>
				    </div>
				</div>
			</div>
			`;

			return html;
		}

		function efaxCartLoop(cart_key,product_name, product_image, product_id){
			let html = `
				<div class="card col-md-6 loop-item">
				<input type="hidden" name="phone_type">
				  <div class="card-body">
				  	<h5 class="card-title product-name" data-title="Product">
					${product_name}
					
					</h5>
				  	<div class="form-row justify-content-between right-panel">
					  	
						<div class="align-items-center">
		
						<a href="?remove_item=${cart_key}&_wpnonce=6de1aaded0" class="remove" aria-label="${cart_key}" data-product_id="${product_id}" ><i class="fa fa-trash fa-2x remove-item"></i></a>
		
						</div>
				  	</div>
				    <hr>
				    <div class="row">
				    	<div class="col-md-12" id="image_cart_thumbnail">
							${product_image}
				    	</div>
					</div>
				    <div class="form-group">
						<input type="number" class="form-control prefix-cart-phone_number" name="phone_number" id="phone_number_${cart_key}" data-cart-id="${cart_key}" placeholder="Select Number" value="">
						<div id="number_modal">
							<i class="fas fa-align-center"></i>
						</div>
						<input type="email" class="form-control prefix-cart-phone_email" name="phone_email" id="phone_email_${cart_key}" data-cart-id="${cart_key}" placeholder="Email" value="">
					</div>


					<div class="form-row phone-setting">
						
						<h5>Automatic cover page</h5>
										
						<div class="custom-control custom-radio custom-control-inline">
						 	<input type="radio" class="custom-control-input prefix-cart-automatic_cover" name="automatic_cover_${cart_key}" id="automatic_cover_yes_${cart_key}" data-cart-id="${cart_key}" value="yes" checked>
						 	<label class="custom-control-label" for="automatic_cover_yes_${cart_key}">Yes</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input prefix-cart-automatic_cover" name="automatic_cover_${cart_key}" id="automatic_cover_no_${cart_key}" data-cart-id="${cart_key}" value="no">
							<label class="custom-control-label" for="automatic_cover_no_${cart_key}">No</label>
						</div>
									
							
					</div>
				   </div>
				</div>
			</div>
			`;

			return html;
		}

		function spamCallBotCartLoop(cart_key,product_name, product_image, product_id){
			let html = `
				<div class="card col-md-6 loop-item">
				<input type="hidden" name="phone_type">
				  <div class="card-body">
				  	<h5 class="card-title product-name" data-title="Product">
					${product_name}
					
					</h5>
				  	<div class="form-row justify-content-between right-panel">
					  	
						<div class="align-items-center">
		
						<a href="?remove_item=${cart_key}&_wpnonce=6de1aaded0" class="remove" aria-label="${cart_key}" data-product_id="${product_id}" ><i class="fa fa-trash fa-2x remove-item"></i></a>
		
						</div>
				  	</div>
				    <hr>
				    <div class="row">
				    	<div class="col-md-12" id="image_cart_thumbnail">
							${product_image}
				    	</div>
					</div>
					<div class="form-group">
						<input type="number" class="form-control prefix-cart-ext_number" name="ext_number" id="ext_number_${cart_key}" data-cart-id="${cart_key}" placeholder="501" value="">
					</div>


					<div class="form-row phone-setting">
						
						<h5>Screen all telemarketers</h5>

						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input prefix-cart-screen_telemarketers" name="screen_telemarketers_${cart_key}" id="screen_telemarketers_yes_${cart_key}" data-cart-id="${cart_key}" value="yes" checked>
							<label class="custom-control-label" for="screen_telemarketers_yes_${cart_key}">Yes</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input prefix-cart-screen_telemarketers" name="screen_telemarketers_${cart_key}" id="screen_telemarketers_no_${cart_key}" data-cart-id="${cart_key}" value="no"> <label class="custom-control-label" for="screen_telemarketers_no_${cart_key}">No</label>
						</div>
								
					</div>
				   </div>
				</div>
			</div>
			`;

			return html;
		}

		//70419 - onchange product name option
		$(document).on("change", ".product-name-option", function(){
			let option = $(this);
			let thisParent = option.parents(".loop-item");
			let phone_type = option.val();
			let cart_item_key = option.attr("data-cart-id");
			let product_id = option.find("option:selected").attr("data-id");
			
			let data = {
	            action: 'univoxx_change_phone_type',
	            product_id: product_id,
	            cart_item_key: cart_item_key,
	            phone_type: phone_type
	        };

	        $.ajax({
		        type: "POST",
		        url: the_ajax_object.ajax_url,
		        data: data,
		        success: function (response) {
		            if (response.success) {
		            	thisParent.find(".remove").attr("data-product_id", response.product_id);
		            	thisParent.find("#image_cart_thumbnail").html(response.product_image);
		            	option.find(`option[value="${response.product_name}"]`).prop("selected", true);
		                $('body').trigger('update_checkout');
		                fireToaster("success", "Change successfully");
		            }else{
		            	fireToaster("error", "Product remove failed");
		            }
		        }
		    });
		});

		//70419 - On click of configure button
		$("#userConfig").on("click", function(event){

			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();

			let userCount = $(".form-box").find("#users").val();
			let zipcode = $(".form-box").find("#zipcode").val();
			let email = $(".form-box").find("#email").val();
			//70519
			$(this).parents(".form-box").find("input").each(function(){
				if( $(this).val() == "" ){
					$(this).addClass("input-error");
					return;
				}else if( $(this).attr("type") == "email" && IsEmail($(this).val()) == false ){
					$(this).addClass("input-error");
					return;
				}else{
					$(this).removeClass("input-error");
				}
			});

			let data = {
	            'action'			: 'univoxx_ajax_add_to_cart',
	            'product_id' 		: "16501",
	            'quantity'		: userCount,
	            'template_type'	: "default"
	        };

	        $.ajax({
	            type: 'POST',
	            url: the_ajax_object.ajax_url,
	            data: data,
	            beforeSend: function (response) {
	                //thisbutton.removeClass('added').addClass('loading');
	            },
	            complete: function (response) {
	                //thisbutton.addClass('added').removeClass('loading');
	            },
	            success: function (response) {

	                if (response.error) {
	                    fireToaster("error", "Something went wrong.");
	                } else {
	                	
	                    	for (let i = 0; i < response[0].quantity; i++) {
	                    		$(document).find(".selected-phones-row").append(defaultCartLoop(response[i].cart_key, response[i].product_name, response[i].product_image, response[i].product_id));
	                    	}
	                    	fireToaster("success", response[0].quantity + ' Products added');

	                	
	                    $( ".form-row.phone-setting" ).tabs();
	                    $('body').trigger('update_checkout');
	                    //  - 70919
						extCartItemCount();
						//  - 70919 end
	                }
	            },
	        });

			setTimeout(function(){
				let data2 = {

				'action' 		: 'create_woo_session',
				'userCount'		: userCount,
				'zipcode'		: zipcode,
				'email'			: email,
				'session_name'	: 'configure_system'

			}
				console.log(data);

				$.post(the_ajax_object.ajax_url, data2, function(response) {
					response		=	$.trim(response);
					response		=	$.parseJSON( response);

					if(response.success){
						console.log("success");
					}

				});
			}, 2000);
		});
		
		//70519 - Email Validation
		function IsEmail(email) {
		  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  if(!regex.test(email)) {
		    return false;
		  }else{
		    return true;
		  }
		}

		let initialTime = null;
		$(document).on( "keyup paste", "input[type='email']", function(){
			clearTimeout(initialTime);
			let email = $(this);
			let emailVal = $(this).val();

			initialTime = setTimeout(function(){
				 
				 if ( IsEmail(emailVal) ){
				 	email.removeClass("input-error");
				 }else{
				 	email.addClass("input-error");
				 }

			}, 1000);

		} );

		$("input[name='phone_ext']").inputFilter(function(value) {
		  return /^\d*$/.test(value);
		});

	//  - 70919
	window.setInterval(checkPageInputs, 5000);
	function checkPageInputs() {
	 	//70519
		let haveEmpty = 0;
		jQuery(".selected-phones-row").find("input[type='text'], input[type='email'], input[type='number']").each(function(){
			if( jQuery(this).val() == "" && jQuery(this).attr("name") !== "mobile_number"){
				jQuery(this).addClass("input-error");
				haveEmpty = 1;
			}else{
				jQuery(this).removeClass("input-error");
			}
		});
		let userCount = $(".form-box").find("#users").val();
		let zipcode = $(".form-box").find("#zipcode").val();
		let email = $(".form-box").find("#email").val();
		//70519
		$(".form-box").find("input").each(function(){
			if( $(this).val() == "" || userCount == "0" ){
				$(this).addClass("input-error");
				haveEmpty = 1;
			}else if( $(this).attr("type") == "email" && IsEmail($(this).val()) == false ){
				$(this).addClass("input-error");
				haveEmpty = 1;
			}else{
				$(this).removeClass("input-error");
			}
			if($("body").find(".input-error").length == 0){
				$("#place_order").attr("type", "submit").removeClass("disabled-button");
			}else{
				$("#place_order").attr("type", "button").addClass("disabled-button");
			}
		});
	}
	//  - 70919 end

	}); // End of ready

})(this.jQuery);

// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  };
}(jQuery));