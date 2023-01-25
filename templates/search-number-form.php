
	<?php
		$phoneNum = unserialize(WC()->session->get( 'primary_phone_number' ));
	?>
<input placeholder="(XXX) XXX-XXXX" type="text" id="primary_phoneNumber" value="<?= ( isset( $phoneNum['phoneNum'] ) && $phoneNum['phoneNum'] !== "" ) ? $phoneNum['phoneNum'] : ''; ?>">

<button id="bring_number">BRING YOUR NUMBER</button >
<button id="btn-modal" data-box-input="primary_phoneNumber">NEW NUMBER</button >



 
  

 
<!-- Modal -->
 <div class="modal-body-block" style="display:none;">
<div class="modal" id="modal-one" aria-hidden="true">


  <div class="modal-dialog">
    <div class="modal-header">
      <h2>Select a new number</h2>
     
    </div>
	
    <div class="modal-body">
		<div class="tab-container">
			<ul>
				<li><a href="#local-number"><span>Local</span></a></li>
				<li><a href="#toll-free-number"><span>Toll Free</span></a></li>
			</ul>
			 <div id="local-number">
							<div class="row form-group">
							<div class="col-12 col-sm-6 mb-2">
							<h6 style="color: #e3411d;margin-bottom: 7px;">1 - Select State &amp; Area Code</h6>
							
							<select id="country_number">
							<?php
								$json_country =json_decode( $univoxx_func->state_option_utility());
								foreach($json_country as $key => $value){
									echo '<option selected="" value="'.$key.'">'.$value.'</option>';
								} 
							?>
								
							</select>
							</div>
							
							<div class="col-12 col-sm-6">
								<div style="font-size: 13px; color: #212529b3;margin-bottom: 7px;"> Sort By <label class="radio-container ml-2 mr-3">
								
									<input name="vehicle" type="radio" class="ng-untouched ng-pristine ng-valid">
									<span class="checkmark"></span>
									<span>Area Code</span>
								
								</label>
								<label class="radio-container">
									<input name="vehicle" type="radio" class="ng-untouched ng-pristine ng-valid">
									<span class="checkmark"></span>
									<span>City</span>
								</label>
								
								</div>
								<select class="form-control">
									<option selected="" value="">All Cities</option>
								</select>
							</div>
							</div>
							<div class="row">
								<div class="col-12"><h6 style="color: #e3411d;margin-top: 22px;">2 - Choose Your Number</h6></div>
								<div class="col-12">
									<div class="numb-input form-group">
										<input class="form-control ng-valid ng-touched ng-dirty search-filter" name="" placeholder="Filter Digits or Terms" type="text" maxlength="10">
									</div>
								</div>
								<div id="inserted-number">
									
								</div>
							</div>
				
			  </div>
			  <div id="toll-free-number">
				
				<div class="row">
					<div class="col-12"><h6 style="color: #e3411d;margin-top: 22px;">Available Prefixes</h6></div>
					<div class="col-12">
						<div id="toll-free-option-number">
						
					</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-12"><h6 style="color: #e3411d;margin-top: 22px;">Choose Your Number</h6></div>
					<div class="col-12">
									<div class="numb-input form-group">
										<input class="form-control ng-valid ng-touched ng-dirty toll-search-filter" name="" placeholder="Filter Digits or Terms" type="text" maxlength="10">
									</div>
								</div>
					<div class="col-12">
						<div id="toll-free-inserted-number">
						
						</div>
					</div>
					
				</div>			 
			</div>
		</div>
    </div>
    <div class="modal-footer">
      <button class="btn-close" type="button">Cancel</button>
	  <button class="btn-update" id="btn-update-number" type="button">Select Number</button>
    </div>
  </div>
  </div>
</div>
<!-- /Modal -->


<script>
jQuery(document).ready(function(){
var toll_free_option = jQuery("#toll-free-option-number");

	jQuery( ".toll-search-filter" ).on('input' ,function(){
		var value = jQuery(this).val();
		var value_length = jQuery(this).val().length;
		var maxlength = jQuery(this).attr("maxlength");
		var unusedlength = (maxlength - value_length);
		var inserted_number = jQuery("#toll-free-inserted-number");
		inserted_number.html("");
		jQuery.ajax({
			 type : "post",
			 dataType : "json",
			 url : the_ajax_object.ajax_url,
			 data : {action: "univoxx_search_phone_number" , unusedlength : unusedlength , input_number : value },
			 success: function(response) {
				 inserted_number.html("");
				console.log(response);
					
					jQuery.each(response , function(key , value){
							
							
							var formatted = numberWithSpaces(value , '(###) ###-####');
							inserted_number.append("<div class='col-6 col-sm-4'><input type='radio' name='gen_number' value='"+value+"' id='"+value+"'> <label for='"+value+"'>"+formatted+"</label></div>");
					})
			 }
		})  
	})


	jQuery( ".search-filter" ).on('input' ,function(){
		var value = jQuery(this).val();
		var value_length = jQuery(this).val().length;
		var maxlength = jQuery(this).attr("maxlength");
		var unusedlength = (maxlength - value_length);
		var inserted_number = jQuery("#inserted-number");
		inserted_number.html("");
		jQuery.ajax({
			 type : "post",
			 dataType : "json",
			 url : the_ajax_object.ajax_url,
			 data : {action: "univoxx_search_phone_number" , unusedlength : unusedlength , input_number : value },
			 success: function(response) {
				console.log(response);
					inserted_number.html("");
					jQuery.each(response , function(key , value){
							
							
							var formatted = numberWithSpaces(value , '(###) ###-####');
							inserted_number.append("<div class='col-6 col-sm-4'><input type='radio' name='gen_number' value='"+value+"' id='"+value+"'> <label for='"+value+"'>"+formatted+"</label></div>");
					})
			 }
		})  
	})



	jQuery( "button#btn-update-number" ).click(function(){
		
		var gen_number = jQuery("input[name='gen_number']:checked").val();
		// console.log(gen_number);
		var select_element = jQuery(this).closest("div#modal-one").attr("data-input-selector");
		jQuery("#"+select_element).val(gen_number).change().trigger('keyup');
		
		jQuery(".modal-body-block").fadeOut();
	})

	jQuery( "div#toll-free-number input[name='toll_free_number']" ).on( "click",function(){
		var value = jQuery(this).val();
		var toll_free_inserted_option = jQuery("#toll-free-inserted-number");
		toll_free_inserted_option.html("");
		jQuery.ajax({
					 type : "post",
					 dataType : "json",
					 url : the_ajax_object.ajax_url,
					 data : {action: "univoxx_phone_tollfree_number" , "toll_free" : value},
					 success: function(response) {
						console.log(response);
						 jQuery.each(response , function(key , value){
							
							
							var formatted = numberWithSpaces(value , '(###) ###-####');
							toll_free_inserted_option.append("<div class='col-6 col-sm-4'><input type='radio' name='gen_number' value='"+value+"' id='"+value+"'> <label for='"+value+"'>"+formatted+"</label></div>");
						}) 
					 }
				 })  
	})
	
	jQuery.ajax({
		 type : "post",
		 dataType : "json",
		 url : the_ajax_object.ajax_url,
		 data : {action: "option_univoxx_toll_free_number"},
		 success: function(response) {

			jQuery.each(response , function(key , value){
				
				
				var formatted = numberWithSpaces(value , '(###)');
				toll_free_option.append("<div class='col-6 col-sm-4'><input type='radio' name='toll_free_number' value='"+value+"' id='"+value+"'> <label for='"+value+"'>"+formatted+" Number</label></div>"); 
			})
		 }
	}) 
	

jQuery(".modal-body-block").hide();

jQuery(".modal-footer button.btn-close").click(function(){

	jQuery(".modal-body-block").fadeOut();
});
jQuery("button#btn-modal").click(function(){
	jQuery(".modal-body-block").fadeIn();
	var data_box_input = jQuery(this).attr("data-box-input");
	
	
	if(data_box_input !== "undefined")
	
	jQuery(".modal-body-block div#modal-one").attr("data-input-selector" , data_box_input);
	
	
})
		jQuery( "div.tab-container" ).tabs();
		
			jQuery( "select#country_number" ).change(function(){
				var value = jQuery(this).val();
				
				var inserted_number = jQuery("#inserted-number");
			//	console.log(value);
				inserted_number.html("");
				
				jQuery.ajax({
					 type : "post",
					 dataType : "json",
					 url : the_ajax_object.ajax_url,
					 data : {action: "univoxx_new_number"},
					 success: function(response) {
				
						jQuery.each(response , function(key , value){
							
							
							var formatted = numberWithSpaces(value , '(###) ###-####');
							inserted_number.append("<div class='col-6 col-sm-4'><input type='radio' name='gen_number' value='"+value+"' id='"+value+"'> <label for='"+value+"'>"+formatted+"</label></div>");
						})
					 }
				 })  
		})
});
function numberWithSpaces(value, pattern) {
  var i = 0,
    phone = value.toString();
  return pattern.replace(/#/g, _ => phone[i++]);
}

let timeout = null;
jQuery("#primary_phoneNumber").on("keyup paste", function(){

	clearTimeout(timeout);


	timeout = setTimeout(function(){
		
		let phoneNum = jQuery("#primary_phoneNumber").val();

		let data = {
			'action' 		: 'create_woo_session',
			'phoneNum'		: phoneNum,
			'session_name'	: 'primary_phone_number'
		}
		console.log(data);				

		jQuery.post(the_ajax_object.ajax_url, data, function(response) {
			response		=	jQuery.trim(response);
			response		=	jQuery.parseJSON( response);

			if(response.success){
				console.log("success");
			}

		}); // End of ajax


	}, 2000);

});

//70419 - moved to univoxx-cart.js

/*jQuery("#userConfig").on("click", function(e){

	e.preventDefault();

	let userCount = jQuery(".form-box").find("#users").val();
	let zipcode = jQuery(".form-box").find("#zipcode").val();
	let email = jQuery(".form-box").find("#email").val();

	let data = {

		'action' 		: 'create_woo_session',
		'userCount'		: userCount,
		'zipcode'		: zipcode,
		'email'			: email,
		'session_name'	: 'configure_system'

	}
	console.log(data);

	jQuery.post(the_ajax_object.ajax_url, data, function(response) {
		response		=	jQuery.trim(response);
		response		=	jQuery.parseJSON( response);
		console.log(response);
		if(response.success && response.woo-cart-id !== null){
			
		}

	});

});*/


</script>