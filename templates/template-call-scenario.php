<?php 
	$item = "";
	if ( isset($data->serialize_data) ) {
		$item = $data->serialize_data;
		$item = unserialize($item);
	}
	global $woocommerce;
    $items_session= $woocommerce->session;
	
	$scenario_key_session = $items_session->get_session_cookie()[3];
	
	$ring_options = ( isset($data->ring_option) ) ? $data->ring_option : array();
		
	
	/*  echo "<pre>";
 	 print_r($data->ring_option);
	 echo "</pre>";  */
	 
	 
 ?>

<form method="post" action="" id="univoxx-call-scenario-form">
	
	<div class="call-scenario clearfix">
		<input type="radio" name="scenario-type" class="sidebar-choice" id="basic" checked>
		<input type="radio" name="scenario-type" class="sidebar-choice" id="team"<?= ( $item !== "" && $item["selectedForm"] == "team" ) ? " checked" : "" ?>>
		<input type="radio" name="scenario-type" class="sidebar-choice" id="auto-attendant"<?= ( $item !== "" && $item["selectedForm"] == "auto-attendant" ) ? " checked" : "" ?>>
		<input type="radio" name="scenario-type" class="sidebar-choice" id="advanced"<?= ( $item !== "" && $item["selectedForm"] == "advanced" ) ? " checked" : "" ?>>
		<div class="sidebar">
			<p>Select a Call Scenario of your choice</p>

			<ul> 
				<li class="fa basic"><label  for="basic">Basic</label></li>
				<li  class="fa team"><label for="team">Team</label></li>
				<li  class="fa auto-attendant"><label  for="auto-attendant">Auto Attendant</label></li>
				<li  class="fa advanced"><label for="advanced">Advanced</label></li>
			</ul>
		</div>
		<div class="scenario-content">
			<div class="basic" id="setting-form" data-form-name="basic">
				<?php 
					 include(UNINVOXX_PATH."/templates/scenario-forms/basic-scenario-form.php");
				?>
			</div>
			<div class="team" id="setting-form" data-form-name="team">
				<?php 
					 include(UNINVOXX_PATH."/templates/scenario-forms/team-scenario-form.php");
				?>
			</div>
			<div class="auto-attendant t-parent" id="setting-form" data-form-name="attendant">
				<?php 
					 include(UNINVOXX_PATH."/templates/scenario-forms/auto-attendant-form.php");
				?>
			</div>
			<div class="advanced t-parent" id="setting-form" data-form-name="advanced_scenario">
				<?php 
					 include(UNINVOXX_PATH."/templates/scenario-forms/advance-scenario-form.php");
				?>
			</div>
		</div>
	</div>
	
</form>
<script>
	
	(function($){
	"use strict";
	/* 62119 - Call scenario Section*/
		var businessHours = []
		var scenarioForm = $("#univoxx-call-scenario-form");
		var timeout = null;
		var prevent_trigger_update = true;
		
		
		
		$("select.advace-greeting-speech , select.advace-announcements-speech , select.advace-voicemail-speech , select.auto-greeting-speech , select.auto-announcements-speech , select.auto-voicemail-speech").change(function(){
	

			var option = $('option:selected', this).attr('data-text');
			$(this).closest(".type-content").find("textarea").val(option);
			
				
		})
		
		
		
		$("#univoxx-call-scenario-form .auto-attendant .num_list").on("click", "li", function(){
			
			var dataVal = $(this).attr("data-loaded");
			var res = dataVal.split("|")
			console.log(dataVal);
			console.log(res);

			var scenarioFormAttendant = scenarioForm.find(".auto-attendant");
			var configForm = scenarioFormAttendant.find(".config-form");

			if( res[0] == "Greetings" ){
				console.log(res);
				scenarioFormAttendant.find(".config-form").find(".config-content.greetings #file-attachment").html("");
				if(res[1] == "Upload File"){
					
					
					var fileNameIndex = res[2].lastIndexOf("/") + 1;
					var filename = res[2].substr(fileNameIndex);
					
					configForm.find(".config-content.greetings").find('input#auto-mp3').prop("checked", "checked");
					
					var form_mp3 = scenarioFormAttendant.find(".config-content.greetings #file-attachment");	
					form_mp3.html("<a href='/wp-content/uploads/univoxx_core/'"+res[2]+">"+filename+"</a>");
				}
				else{
					
					
					configForm.find(".config-content.greetings").find('input#auto-text').prop("checked", "checked");
					
					if( res[2] == "Male" ){
						configForm.find(".config-content.greetings").find('#auto-male').prop("checked", "checked");
					}else{
						configForm.find(".config-content.greetings").find('#auto-female').prop("checked", "checked");
					}
					
					
					/* configForm.find(".config-content.greetings").find("option").each(function(){
						if ($(this).val() == res[2]) {
							$(this).prop("selected", "selected");
						}
					}); */
					
					configForm.find(".config-content.greetings").find("select").val(res[3]);
					configForm.find(".config-content.greetings").find("textarea").val(res[4]);
				}
			}else if( res[0] == "Ring-One" ){

				// configForm.find(".config-content.main").find(".Ring-One").find('#auto-'+res[1]).prop("checked", "checked");
				configForm.find(".config-content.main").find(".Ring-One").find( "input[value='"+res[1]+"']" ).prop("checked", "checked");

			}else if ( res[0] == "Announcements" ){
				
				scenarioFormAttendant.find(".config-form").find(".Announcements textarea").html("");
				scenarioFormAttendant.find(".config-form").find(".Announcements #file-attachment").html("");
				if(res[1] == "Upload File"){
					
					
					var fileNameIndex = res[2].lastIndexOf("/") + 1;
					var filename = res[2].substr(fileNameIndex);
					configForm.find(".config-content.main").find(".Announcements").find('input#announcements-mp3').prop("checked", "checked");
					
					var form_mp3 = scenarioFormAttendant.find(".config-form").find(".Announcements #file-attachment");	
					form_mp3.html("<a href='/wp-content/uploads/univoxx_core/'"+res[2]+">"+filename+"</a>");
					console.log("fasdfasdfasdfasdfasdfads");
				}
				else{
					configForm.find(".config-content.main").find(".Announcements").find('input#announcements-text').prop("checked", "checked");
					if( res[2] == "Male" ){
						configForm.find(".config-content.main").find(".Announcements").find('input#attendant-announcements-male').prop("checked", "checked");
					}else{
						configForm.find(".config-content.main").find(".Announcements").find('input#attendant-announcements-female').prop("checked", "checked");
					}
					
					configForm.find(".config-content.main").find(".Announcements").find("select").val(res[3]);
					configForm.find(".config-content.main").find(".Announcements").find("textarea").val(res[4]);
				}
				
				
				
				
				
				
				
				
				
			}else if ( res[0] == "Voicemail" ){
				
				
				prevent_trigger_update = true;
				
				console.log("Voicemail Toohhhhhhhhh!!!");
				scenarioFormAttendant.find(".config-form").find(".Voicemail textarea").html("");
				scenarioFormAttendant.find(".config-form").find(".Voicemail #file-attachment").html("");
				
				configForm.find(".config-content.main").find(".Voicemail").find('[name="voice-email"]').val(res[3]);
				if(res[1] == "Upload File"){
					
					
					var fileNameIndex = res[2].lastIndexOf("/") + 1;
					var filename = res[2].substr(fileNameIndex);
					configForm.find(".config-content.main").find(".Voicemail").find('input#voicemail-mp3').prop("checked", "checked");
					
					var form_mp3 = scenarioFormAttendant.find(".config-form").find(".Voicemail #file-attachment");	
					form_mp3.html("<a href='/wp-content/uploads/univoxx_core/'"+res[2]+">"+filename+"</a>");
					
				}
				else{
					console.log("else");
					
					
					
					if( res[2] == "Male" ){
						configForm.find(".config-content.main").find(".Voicemail").find('#voicemail-male').prop("checked", "checked")
					}else{
						configForm.find(".config-content.main").find(".Voicemail").find('#voicemail-female').prop("checked", "checked")
					}
					
					
					configForm.find(".config-content.main").find(".Voicemail").find("select").val(res[3]);
					configForm.find(".config-content.main").find(".Voicemail").find("input[type='email']").val(res[5]);
					
					configForm.find(".config-content.main").find(".Voicemail").find("textarea").val(res[4]);
					
					configForm.find(".config-content.main").find(".Voicemail").find('input#voicemail-text').prop("checked", "checked");
					
				
					
				}
			}
			else if ( res[0] == "Ring-Group" ){
				
				configForm.find(".config-content.main").find(".Ring-Group").find('input[type="checkbox"]').prop("checked", "");
				
				/* configForm.find(".config-content.main").find(".Ring-Group").find("input[name='advanced-seq']").prop("checked", "");
				 */
				var ring_checked = JSON.parse(res[2]);
				console.log(ring_checked);
				if(res[1] == "Sequential Ring"){
					
					configForm.find(".config-content.main").find(".Ring-Group").find('input#auto-sequential').prop("checked", "checked");
					
					
					
				$.each(ring_checked , function(key , value){
						configForm.find(".config-content.main").find(".Ring-Group").find("input[value='"+value+"']").prop("checked", "checked");
					});
				}
				else{
					configForm.find(".config-content.main").find(".Ring-Group").find('input#auto-simultaneous').prop("checked", "checked");
					
					jQuery("input[value='"+ring_checked[0]+"']").prop("checked", "checked");
				}
				configForm.find(".config-content.main").find(".Ring-Group").find('input.rings').val(res[3]);
				configForm.find(".config-content.main").find(".Ring-Group").find('select#auto-user-voicemail').val(res[4]);
			}
		});
		
		
		
		/* Basic */
		$("#univoxx-call-scenario-form .basic select, #univoxx-call-scenario-form .basic button, #univoxx-call-scenario-form .basic input, #univoxx-call-scenario-form .basic a").on( "change click", function(e){
			if( $(this).attr("type") !== "radio" ){
				e.preventDefault();
			}
			clearTimeout(timeout);

			var scenarioFormBasic = scenarioForm.find(".basic");


			var busHrs = {};
			timeout = setTimeout(function(){
				scenarioFormBasic.find("ul.busHrs li").each(function(index){
					if( $(this).find("p").text() !== "" ){
						busHrs[index] = $(this).find("p").text();
						busHrs[index] += ',' + $(this).find("a").attr("data-targetid");
					}
				});
				var userToRing = scenarioFormBasic.find('[name="basic_user"]:checked').val();
				var ringCount = scenarioFormBasic.find('[name="rings-missed"]').val();

				var data = {
					'action' 		: 'handle_call_scenario_form_submit',
					'busHrs'		: busHrs,
					'userToRing'	: userToRing,
					'ringCount'		: ringCount,
					'selectedForm'	: 'basic'
				}
				console.log(data);				

				$.post(the_ajax_object.ajax_url, data, function(response) {
					response		=	$.trim(response);
					response		=	$.parseJSON( response);
					
					console.log(response);

				}); // End of ajax

			}, 2000);
		});
		/* Team */
		$("#univoxx-call-scenario-form .team select, #univoxx-call-scenario-form .team button, #univoxx-call-scenario-form .team input, #univoxx-call-scenario-form .team a").on( "change click", function(e){
			if( $(this).attr("type") !== "radio" && $(this).attr("type") !== "checkbox" ){
				e.preventDefault();
			}
			clearTimeout(timeout);

			var scenarioFormTeam = scenarioForm.find(".team");

			var busHrs = {};
			timeout = setTimeout(function(){
				scenarioFormTeam.find("ul.busHrs li").each(function(index){
					if( $(this).find("p").text() !== "" ){
						busHrs[index] = $(this).find("p").text();
						busHrs[index] += ',' + $(this).find("a").attr("data-targetid");
					}
				});
				var ringType = '';
				var userToRing = {};
				if( scenarioFormTeam.find("#team-simultaneous").prop("checked") ){

					ringType = "Simultaneous Ring";
					userToRing[0] = scenarioFormTeam.find('[name="team_sim_ring"]:checked').val();

				}else{

					ringType = "Sequential Ring";
					$. each($("input[name='team-seq-ring']:checked"), function(index){
						
						userToRing[index] = $(this).val();

					});

				}
				var ringCount = scenarioFormTeam.find('[name="team-rings-missed"]').val();

				var data = {
					'action' 		: 'handle_call_scenario_form_submit',
					'busHrs'		: busHrs,
					'userToRing'	: userToRing,
					'ringType'		: ringType,
					'ringCount'		: ringCount,
					'selectedForm'	: 'team'
				}
				console.log(data);

				$.post(the_ajax_object.ajax_url, data, function(response) {
					response		=	$.trim(response);
					response		=	$.parseJSON( response);
					console.log(response);

				}); // End of ajax

			}, 2000);
		});
		/* Auto Attendant */
		$("#univoxx-call-scenario-form .auto-attendant select, #univoxx-call-scenario-form .auto-attendant button, #univoxx-call-scenario-form .auto-attendant input, #univoxx-call-scenario-form .auto-attendant textarea").on( "change keyup click paste", function(e){
			
			
				
			if( $(this).attr("type") !== "radio" && $(this).attr("type") !== "file" && $(this).attr("type") !== "checkbox" ){
				e.preventDefault();
			}
			clearTimeout(timeout);
			var scenarioFormAttendant = scenarioForm.find(".auto-attendant");
			var configForm = scenarioFormAttendant.find(".config-form");
			var attendant = {};
			var activeSet = scenarioFormAttendant.find("li.active");
			var greetVisible = configForm.find(".config-content.greetings").attr("style");
			var mainVisible = configForm.find(".config-content.main").attr("style");
			var dataVal = {};
			
			if( greetVisible == "display: block;" ){
				/*  */
				
				var configForm = scenarioFormAttendant.find(".config-form");
				if(configForm.find(".config-content.greetings").find("#auto-mp3").prop("checked")){
					
					var index_number = $(".num_list ul li.active").attr("data-attendant-index");
					var data_key_id = $(this).attr("data-key-id")+"_attendant_"+index_number;
					if(data_key_id !== "undefined"){
						var audio_upload = e.target.files[0];
						/* if (audio_upload){
						  console.log(audio_upload.name);
						} */
						var obj = attendant;
						
						dataVal = "Greetings|";
						var d = new Date();
						var month = (d.getMonth()+1).toString().padStart(2, "0");
						var getFullYear = d.getFullYear();
						
						dataVal += "Upload File";
						dataVal += "|"+data_key_id + "/" + getFullYear +"/"+month +"/"+ audio_upload.name;
						
						var formData = new FormData(); 
						formData.append('action', 'handle_call_scenario_upload');
						formData.append('audio_upload', audio_upload);
						formData.append('data_cart_id', data_key_id);
						formData.append('is_scenario_upload', true);
						formData.append('selectedForm', 'auto-attendant');
							
						$.ajax({
							url: the_ajax_object.ajax_url,
							type: 'POST',
							data: formData,
							cache: false,
							dataType: 'json',
							processData: false,
							contentType: false,
							//enctype: 'multipart/form-data',
							success: function (data) {
								// console.log(data);
								
								var form_mp3 = scenarioFormAttendant.find(".config-form").find(".config-content.greetings #file-attachment");	
								form_mp3.html("<a href='"+data["file_path"]+"'>" + data["filename"] +"</a>")
									
								var data_form_mp3 = data["filename"] +"|"+data["file_path"];
								//activeSet.attr("data-uploaded", data_form_mp3);
							}
						});
					}
					
					// console.log("waahhahwahwahwhhwhawhbefgojrheftbgriaewtbhouibr");
					activeSet.attr("data-loaded", dataVal);
					
				}
				else{
					dataVal = "Greetings";
					dataVal += '|' + "Text to Speech";
					dataVal += '|' +configForm.find(".config-content.greetings").find('[name="auto-gender"]').val();
					dataVal += '|' + configForm.find(".config-content.greetings").find("select").val();
					dataVal += '|' + configForm.find(".config-content.greetings").find("textarea").val();
					activeSet.attr("data-loaded", dataVal);
				}
				
				
				

			}else if( mainVisible == "display: block;" ){
				
				if( configForm.find(".config-content.main").find(".Ring-One").attr("style") == "display: block;" ){
					dataVal = "Ring-One";
					dataVal += "|" +configForm.find(".config-content.main").find(".Ring-One").find('[name="auto-user"]:checked').val();
					activeSet.attr("data-loaded", dataVal);

				}
				else if ( configForm.find(".config-content.main").find(".Announcements").attr("style") == "display: block;" ){
				
				var configForm = scenarioFormAttendant.find(".config-form");
				if(configForm.find(".config-content.main").find(".Announcements").find("#announcements-mp3").prop("checked")){
					
					var index_number = $(".num_list ul li.active").attr("data-attendant-index");
					var data_key_id = $(this).attr("data-key-id")+"_attendant_"+index_number;
					if(data_key_id !== "undefined"){
						var audio_upload = e.target.files[0];
						/* if (audio_upload){
						  console.log(audio_upload.name);
						} */
						var obj = attendant;
						dataVal = "Announcements|";
						var d = new Date();
						var month = (d.getMonth()+1).toString().padStart(2, "0");
						var getFullYear = d.getFullYear();
						
						dataVal += "Upload File";
						dataVal += "|"+data_key_id + "/" + getFullYear +"/"+month +"/"+ audio_upload.name;
						
						var formData = new FormData(); 
						formData.append('action', 'handle_call_scenario_upload');
						formData.append('audio_upload', audio_upload);
						formData.append('data_cart_id', data_key_id);
						formData.append('is_scenario_upload', true);
						formData.append('selectedForm', 'auto-attendant');
							
						$.ajax({
							url: the_ajax_object.ajax_url,
							type: 'POST',
							data: formData,
							cache: false,
							dataType: 'json',
							processData: false,
							contentType: false,
							//enctype: 'multipart/form-data',
							success: function (data) {
								// console.log(data);
								
								var form_mp3 = scenarioFormAttendant.find(".config-form").find(".Announcements #file-attachment");	
								form_mp3.html("<a href='"+data["file_path"]+"'>" + data["filename"] +"</a>")
									
								var data_form_mp3 = data["filename"] +"|"+data["file_path"];
								//activeSet.attr("data-uploaded", data_form_mp3);
							}
						});
					}
					
					// console.log("waahhahwahwahwhhwhawhbefgojrheftbgriaewtbhouibr");
					activeSet.attr("data-loaded", dataVal);
					
				}
				else{
					if(!prevent_trigger_update){
						dataVal =  "Announcements";
						dataVal += '|'+"Text to Speech";
						dataVal += '|' +configForm.find(".config-content.main").find(".Announcements").find('[name="attendant-announcements-gender"]:checked').val();
						dataVal += '|' + configForm.find(".config-content.main").find(".Announcements").find("select").val();
						dataVal += '|' + configForm.find(".config-content.main").find(".Announcements").find("textarea").val();
						
						activeSet.attr("data-loaded", dataVal); 
					}
					prevent_trigger_update = false; 
				}
				

				}else if ( configForm.find(".config-content.main").find(".Voicemail").attr("style") == "display: block;" ){
					
					var configForm = scenarioFormAttendant.find(".config-form");
					if(configForm.find(".config-content.main").find(".Voicemail").find("#voicemail-mp3").prop("checked")){
					
					var index_number = $(".num_list ul li.active").attr("data-attendant-index");
					var data_key_id = $(this).attr("data-key-id")+"_attendant_"+index_number;
					if(data_key_id !== "undefined"){
							var audio_upload = e.target.files[0];
							/* if (audio_upload){
							  console.log(audio_upload.name);
							} */
							var obj = attendant;
						
							dataVal = "Voicemail|";
							var d = new Date();
							var month = (d.getMonth()+1).toString().padStart(2, "0");
							var getFullYear = d.getFullYear();
							
							dataVal += "Upload File";
							dataVal += "|"+data_key_id + "/" + getFullYear +"/"+month +"/"+ audio_upload.name;
							
							var formData = new FormData(); 
							formData.append('action', 'handle_call_scenario_upload');
							formData.append('audio_upload', audio_upload);
							formData.append('data_cart_id', data_key_id);
							formData.append('is_scenario_upload', true);
							formData.append('selectedForm', 'auto-attendant');
								
							$.ajax({
								url: the_ajax_object.ajax_url,
								type: 'POST',
								data: formData,
								cache: false,
								dataType: 'json',
								processData: false,
								contentType: false,
								//enctype: 'multipart/form-data',
								success: function (data) {
									// console.log(data);
									
									var form_mp3 = scenarioFormAttendant.find(".config-form").find(".Voicemail #file-attachment");	
									form_mp3.html("<a href='"+data["file_path"]+"'>" + data["filename"] +"</a>")
										
									var data_form_mp3 = data["filename"] +"|"+data["file_path"];
									//activeSet.attr("data-uploaded", data_form_mp3);
								}
							});
						}
						dataVal += "|"+configForm.find(".config-content.main").find(".Voicemail").find('[name="voice-email"]').val();
						// console.log("waahhahwahwahwhhwhawhbefgojrheftbgriaewtbhouibr");
						activeSet.attr("data-loaded", dataVal);
					
					}
					else{
						console.log(prevent_trigger_update);
						if(prevent_trigger_update == false){
							dataVal =  "Voicemail";
							dataVal += '|'+"Text to Speech";
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find('[name="voicemail-gender"]:checked').val();
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find("select").val();
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find("textarea").val();
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find('[name="voice-email"]').val();
							
							activeSet.attr("data-loaded", dataVal);  
						}
						prevent_trigger_update = false; 
					}
					
					
					
					

				}else if ( configForm.find(".config-content.main").find(".Ring-Group").attr("style") == "display: block;" ){

					var ringType = '';
					var userToRing = {};
					if( configForm.find(".config-content.main").find(".Ring-Group").find("#auto-simultaneous").prop("checked") ){

						ringType = "Simultaneous Ring";
						userToRing[0] = configForm.find(".config-content.main").find(".Ring-Group").find('[name="auto-user"]:checked').val();

					}else{

						ringType = "Sequential Ring";
						$.each($(".auto-attendant").find(".config-form").find(".config-content.main").find(".Ring-Group").find(".user_list.seq input[type='checkbox']:checked"), function(index){
							
							userToRing[index] = $(this).val();

						});

					}
					
					var ringCount = configForm.find(".config-content.main").find(".Ring-Group").find('[type="number"]').val();
					var userSelect = configForm.find(".config-content.main").find(".Ring-Group").find('select').val();
					dataVal = "Ring-Group";
					dataVal += "|"+ringType + '|' + JSON.stringify(userToRing) + '|' + ringCount + '|' + userSelect;
					activeSet.attr("data-loaded", dataVal);

				}
			}

			timeout = setTimeout(function() {
				
			
				scenarioFormAttendant.find(".num_list li").each(function( index ){
					if($(this).find("span.type").text() !== "" || $(this).attr("data-loaded") !== undefined ){
						
						var is_type_ready = $(this).attr("data-loaded").split("|").filter(function( element ) {
                               return element !==  "undefined";
                            });;
						var type = $(this).find("span.type").text();
						
						if(  is_type_ready[0] ==  "No-Configuration" ||  is_type_ready[0] ==  "Ring-One" ||  is_type_ready[0] ==  "Ring-Group" ||  is_type_ready[0] ==  "Announcements" ||  is_type_ready[0] ==  "Voicemail" || is_type_ready[0] ==  "Greetings" ){
							
							attendant[index] = "";
						}
						else{
							attendant[index] = type;
						}

						if ($(this).attr("data-loaded") !== undefined &&  $(this).attr("data-loaded").split("|")[0] !==  "undefined" &&  $(this).attr("data-loaded").split("|")[0] !==  " " ) {
						
							attendant[index] += '|' +  $(this).attr("data-loaded");

						}else{
							attendant[index] += "";
							
						}
						
                    }

				});
				
				var data = {
					'action' 		: 'handle_call_scenario_form_submit',
					'form_values'	: attendant,
					'selectedForm'	: 'auto-attendant'
				}
				console.log(data);

				$.post(the_ajax_object.ajax_url, data, function(response) {
					response		=	$.trim(response);
					response		=	$.parseJSON( response);
					console.log(response);

				}); // End of ajax

			}, 2000);
			
		
		});
		/* Advanced */
		$("#univoxx-call-scenario-form .advanced select, #univoxx-call-scenario-form .advanced button, #univoxx-call-scenario-form .advanced input, #univoxx-call-scenario-form .advanced textarea").on( "change keyup click paste", function(e){
			if( $(this).attr("type") !== "radio" && $(this).attr("type") !== "file" && $(this).attr("type") !== "checkbox" ){
				e.preventDefault();
			}
			clearTimeout(timeout);
			var scenarioFormAdvanced = scenarioForm.find(".advanced");
			var configForm = scenarioFormAdvanced.find(".config-form");
			var advance = {};
			var activeSet = scenarioFormAdvanced.find("li.active");
			var greetVisible = configForm.find(".config-content.greetings").attr("style");
			var mainVisible = configForm.find(".config-content.main").attr("style");
			var dataVal = {};
			var busHrs = {};
				
			if( greetVisible == "display: block;" ){
				
				var configForm = scenarioFormAdvanced.find(".config-form");
				if(configForm.find(".config-content.greetings").find("#advanced-mp3").prop("checked")){
					
					var index_number = $(".num_list ul li.active").attr("data-advance-index");
					var data_key_id = $(this).attr("data-key-id")+"_advanced_"+index_number;
					if(data_key_id !== "undefined"){
						var audio_upload = e.target.files[0];
						/* if (audio_upload){
						  console.log(audio_upload.name);
						} */
						var obj = advance;
						
						dataVal = "Greetings|";
						var d = new Date();
						var month = (d.getMonth()+1).toString().padStart(2, "0");
						var getFullYear = d.getFullYear();
						
						dataVal += "Upload File";
						dataVal += "|"+data_key_id + "/" + getFullYear +"/"+month +"/"+ audio_upload.name;
						
						var formData = new FormData(); 
						formData.append('action', 'handle_call_scenario_upload');
						formData.append('audio_upload', audio_upload);
						formData.append('data_cart_id', data_key_id);
						formData.append('is_scenario_upload', true);
						formData.append('selectedForm', 'advanced');
							
						$.ajax({
							url: the_ajax_object.ajax_url,
							type: 'POST',
							data: formData,
							cache: false,
							dataType: 'json',
							processData: false,
							contentType: false,
							//enctype: 'multipart/form-data',
							success: function (data) {
								// console.log(data);
								
								var form_mp3 = scenarioFormAdvanced.find(".config-form").find(".config-content.greetings #file-attachment");	
								form_mp3.html("<a href='"+data["file_path"]+"'>" + data["filename"] +"</a>")
									
								var data_form_mp3 = data["filename"] +"|"+data["file_path"];
								//activeSet.attr("data-uploaded", data_form_mp3);
							}
						});
					}
					
					// console.log("waahhahwahwahwhhwhawhbefgojrheftbgriaewtbhouibr");
					activeSet.attr("data-loaded", dataVal);
					
				}
				else{
					/* dataVal = configForm.find(".config-content.greetings").find('[name="advanced-gender"]').val();
					dataVal += '|' + configForm.find(".config-content.greetings").find("select").val();
					activeSet.attr("data-loaded", dataVal); */


					dataVal =  "Greetings";
					dataVal += '|'+"Text to Speech";
					dataVal += '|' +configForm.find(".config-content.greetings").find('[name="advanced-gender"]:checked').val();
					dataVal += '|' + configForm.find(".config-content.greetings").find("select").val();
					dataVal += '|' + configForm.find(".config-content.greetings").find("textarea").val();

					activeSet.attr("data-loaded", dataVal);
				}
				/* else{
					console.log("sadfample");
					dataVal = configForm.find(".config-content.greetings").find('[name="auto-gender"]').val();
					dataVal += '|' + configForm.find(".config-content.greetings").find("select").val();
					activeSet.attr("data-loaded", dataVal);
				} */

				

			}else if( mainVisible == "display: block;" ){
				if( configForm.find(".config-content.main").find(".Ring-One").attr("style") == "display: block;" ){
					dataVal = "Ring-One|";
					dataVal += configForm.find(".config-content.main").find(".Ring-One").find('[name="advanced-user"]').val();
					activeSet.attr("data-loaded", dataVal);

				}
				else if ( configForm.find(".config-content.main").find(".Announcements").attr("style") == "display: block;" ){
					
					
					var configForm = scenarioFormAdvanced.find(".config-form");
					if(configForm.find(".config-content.main").find(".Announcements").find("#advanced-announcements-mp3").prop("checked")){
						
						var index_number = $(".advanced .num_list ul li.active").attr("data-advance-index");
						var data_key_id = $(this).attr("data-key-id")+"_advanced_"+index_number;
						if(data_key_id !== "undefined"){
							var audio_upload = e.target.files[0];
							/* if (audio_upload){
							  console.log(audio_upload.name);
							} */
							
							
							dataVal = "Announcements|";
							var d = new Date();
							var month = (d.getMonth()+1).toString().padStart(2, "0");
							var getFullYear = d.getFullYear();
							
							dataVal += "Upload File";
							dataVal += "|"+data_key_id + "/" + getFullYear +"/"+month +"/"+ audio_upload.name;
							
							var formData = new FormData(); 
							formData.append('action', 'handle_call_scenario_upload');
							formData.append('audio_upload', audio_upload);
							formData.append('data_cart_id', data_key_id);
							formData.append('is_scenario_upload', true);
							formData.append('selectedForm', 'advanced');
								
							$.ajax({
								url: the_ajax_object.ajax_url,
								type: 'POST',
								data: formData,
								cache: false,
								dataType: 'json',
								processData: false,
								contentType: false,
								//enctype: 'multipart/form-data',
								success: function (data) {
									 console.log(data);
									
									var form_mp3 = scenarioFormAdvanced.find(".config-form").find(".Announcements #file-attachment");	
									form_mp3.html("<a href='"+data["file_path"]+"'>" + data["filename"] +"</a>")
										
									var data_form_mp3 = data["filename"] +"|"+data["file_path"];
									//activeSet.attr("data-uploaded", data_form_mp3);
								}
							});
						}
						activeSet.attr("data-loaded", dataVal);
					}else{
						/* dataVal = configForm.find(".config-content.main").find(".Announcements").find('[name="advanced-announcements-gender"]').val();
						dataVal += '|' + configForm.find(".config-content.main").find(".Announcements").find("select").val();
						activeSet.attr("data-loaded", dataVal); */
						

						if(!prevent_trigger_update){
							dataVal =  "Announcements";
							dataVal += '|'+"Text to Speech";
							dataVal += '|' +configForm.find(".config-content.main").find(".Announcements").find('[name="advanced-announcements-gender"]:checked').val();
							dataVal += '|' + configForm.find(".config-content.main").find(".Announcements").find("select").val();
							dataVal += '|' + configForm.find(".config-content.main").find(".Announcements").find("textarea[name='text_to_speech']").val();
							
							activeSet.attr("data-loaded", dataVal); 



						}
						prevent_trigger_update = false; 
					}	
					
				}
				else if ( configForm.find(".config-content.main").find(".Voicemail").attr("style") == "display: block;" ){
					
					var configForm = scenarioFormAdvanced.find(".config-form");
					if(configForm.find(".config-content.main").find(".Voicemail").find("#advanced-voicemail-mp3").prop("checked")){
						
						var index_number = $(".advanced .num_list ul li.active").attr("data-advance-index");
						var data_key_id = $(this).attr("data-key-id")+"_advanced_"+index_number;
						if(data_key_id !== "undefined"){
							var audio_upload = e.target.files[0];
							/* if (audio_upload){
							  console.log(audio_upload.name);
							} */
							var obj = advance;
							
							dataVal = "Voicemail|";
							var d = new Date();
							var month = (d.getMonth()+1).toString().padStart(2, "0");
							var getFullYear = d.getFullYear();
							
							dataVal += "Upload File";
							dataVal += "|"+data_key_id + "/" + getFullYear +"/"+month +"/"+ audio_upload.name;
							
							var formData = new FormData(); 
							formData.append('action', 'handle_call_scenario_upload');
							formData.append('audio_upload', audio_upload);
							formData.append('data_cart_id', data_key_id);
							formData.append('is_scenario_upload', true);
							formData.append('selectedForm', 'advanced');
								
							$.ajax({
								url: the_ajax_object.ajax_url,
								type: 'POST',
								data: formData,
								cache: false,
								dataType: 'json',
								processData: false,
								contentType: false,
								//enctype: 'multipart/form-data',
								success: function (data) {
									// console.log(data);
									
									var form_mp3 = scenarioFormAdvanced.find(".config-form").find(".Voicemail #file-attachment");	
									form_mp3.html("<a href='"+data["file_path"]+"'>" + data["filename"] +"</a>")
										
									var data_form_mp3 = data["filename"] +"|"+data["file_path"];
									//activeSet.attr("data-uploaded", data_form_mp3);
								}
							});
						}
						dataVal += "|"+configForm.find(".config-content.main").find(".Voicemail").find('input[name="advanced-voice-email"]').val();
						// console.log("waahhahwahwahwhhwhawhbefgojrheftbgriaewtbhouibr");
						activeSet.attr("data-loaded", dataVal);
						
					}
					else{
						console.log(prevent_trigger_update);
						if(prevent_trigger_update == false){
							dataVal =  "Voicemail";
							dataVal += '|'+"Text to Speech";
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find('[name="advanced-voicemail-gender"]:checked').val();
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find("select").val();
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find("textarea[name='voice_text_to_speech']").val();
							
							dataVal += '|' + configForm.find(".config-content.main").find(".Voicemail").find('[name="advanced-voice-email"]').val();
							
							activeSet.attr("data-loaded", dataVal);  
						}
						prevent_trigger_update = false; 
					}

				}
				else if ( configForm.find(".config-content.main").find(".Ring-Group").attr("style") == "display: block;" ){

					var ringType = '';
					var userToRing = {};
					if( configForm.find(".config-content.main").find(".Ring-Group").find("#advanced-group-simultaneous").prop("checked") ){

						ringType = "Simultaneous Ring";
						userToRing[0] = configForm.find(".config-content.main").find(".Ring-Group").find('[name="advanced-user"]:checked').val();

					}else{

						ringType = "Sequential Ring";
						$. each($(".user_list.seq input[name='advanced-seq']:checked"), function(index){
							
							userToRing[index] = $(this).val();

						});

					}
					var ringCount = configForm.find(".config-content.main").find(".Ring-Group").find('[type="number"]').val();
					var userSelect = configForm.find(".config-content.main").find(".Ring-Group").find('select').val();
					dataVal = "Ring-Group";
					dataVal += "|"+ringType + '|' + JSON.stringify(userToRing) + '|' + ringCount + '|' + userSelect;
					activeSet.attr("data-loaded", dataVal);

				}
			}

			timeout = setTimeout(function() {
				
				scenarioFormAdvanced.find("ul.busHrs li").each(function(index){
					if( $(this).find("p").text() !== "" ){
						busHrs[index] = $(this).find("p").text();
						busHrs[index] += ',' + $(this).find("a").attr("data-targetid");
					}
				});
				var ringType = '';
				var userToRing = {};
				if( scenarioFormAdvanced.find("#advanced-simultaneous").prop("checked") ){

					ringType = "Simultaneous Ring";
					userToRing[0] = scenarioFormAdvanced.find('[name="advanced-radio-sim"]:checked').val();

				}else{

					ringType = "Sequential Ring";
					$. each($("input[name='advanced-radio-seq']:checked"), function(index){
						
						userToRing[index] = $(this).val();

					});

				}
				//var userToRing = scenarioFormAdvanced.find('[name="advanced-user"]').val();
				var ringCount = scenarioFormAdvanced.find('[name="advance-ring-missed"]').val();
			
				scenarioFormAdvanced.find(".num_list li").each(function( index ){
					if($(this).find("span.type").text() !== "" || $(this).attr("data-loaded") !== undefined ){
						
						var is_type_ready = $(this).attr("data-loaded").split("|").filter(function( element ) {
                               return element !==  "undefined";
                            });;
						var type = $(this).find("span.type").text();
						
						if(  is_type_ready[0] ==  "No-Configuration" ||  is_type_ready[0] ==  "Ring-One" ||  is_type_ready[0] ==  "Ring-Group" ||  is_type_ready[0] ==  "Announcements" ||  is_type_ready[0] ==  "Voicemail" || is_type_ready[0] ==  "Greetings" ){
							
							advance[index] = "";
						}
						else{
							advance[index] = type;
						}

						if ($(this).attr("data-loaded") !== undefined &&  $(this).attr("data-loaded").split("|")[0] !==  "undefined" &&  $(this).attr("data-loaded").split("|")[0] !==  " " ) {
						
							advance[index] += '|' +  $(this).attr("data-loaded");

						}else{
							advance[index] += "";
							
						}
						
                    }

				});
				
				var data = {
					'action' 		: 'handle_call_scenario_form_submit',
					'busHrs'		: busHrs,
					'userToRing'	: userToRing,
					'ringType'		: ringType,
					'ringCount'		: ringCount,
					'form_values'	: advance,
					'selectedForm'	: 'advanced'
				}

				console.log(data);
				$.post(the_ajax_object.ajax_url, data, function(response) {
					response		=	$.trim(response);
					response		=	$.parseJSON( response);
					console.log(response);

				}); // End of ajax

			}, 2000);
			

		});
		
		
		
		
		$("#univoxx-call-scenario-form .advanced .num_list").on("click", "li", function(){
			var dataVal = $(this).attr("data-loaded");
			var res = dataVal.split("|");
			console.log(dataVal);
			console.log(res);

			var scenarioFormAvanced = scenarioForm.find(".advanced");
			var configForm = scenarioFormAvanced.find(".config-form");

			if( res[0] == "Greetings" ){
				console.log(res);
				scenarioFormAvanced.find(".config-form").find(".config-content.greetings #file-attachment").html("");
				if(res[1] == "Upload File"){
					var fileNameIndex = res[2].lastIndexOf("/") + 1;
					var filename = res[2].substr(fileNameIndex);
					
					configForm.find(".config-content.greetings").find('input#advanced-mp3').prop("checked", "checked");
					
					var form_mp3 = scenarioFormAvanced.find(".config-content.greetings #file-attachment");	
					form_mp3.html("<a href='/wp-content/uploads/univoxx_core/'"+res[2]+">"+filename+"</a>");
				}
				else{
					if( res[2] == "Male" ){
					configForm.find(".config-content.greetings").find('#advanced-male').prop("checked", "checked");
					}else{
						configForm.find(".config-content.greetings").find('#advanced-female').prop("checked", "checked");
					}
					configForm.find(".config-content.greetings").find("select").val(res[3]);

/* .find("option").each(function(){
						if ($(this).val() == res[2]) {
							$(this).prop("selected", "selected");
						}
					}); */
					configForm.find(".config-content.greetings").find("textarea").text(res[4]);
				}
				
				

				
				

			}else if( res[0] == "Ring-One" ){

				configForm.find(".config-content.main").find(".Ring-One").find( "input[value='"+res[1]+"']" ).prop("checked", "checked");

			}else if ( res[0] == "Announcements" ){
				
				scenarioFormAvanced.find(".config-form").find(".Announcements textarea").html("");
				scenarioFormAvanced.find(".config-form").find(".Announcements #file-attachment").html("");
				if(res[1] == "Upload File"){
					
					
					var fileNameIndex = res[2].lastIndexOf("/") + 1;
					var filename = res[2].substr(fileNameIndex);
					configForm.find(".config-content.main").find(".Announcements").find('input#advanced-announcements-mp3').prop("checked", "checked");
					
					var form_mp3 = scenarioFormAvanced.find(".config-form").find(".Announcements #file-attachment");	
					form_mp3.html("<a href='/wp-content/uploads/univoxx_core/'"+res[2]+">"+filename+"</a>");
			
				}
				else{
					if( res[2] == "Male" ){
						configForm.find(".config-content.main").find(".Announcements").find('#advanced-announcements-male').prop("checked", "checked");
					}else{
						configForm.find(".config-content.main").find(".Announcements").find('#advanced-announcements-female').prop("checked", "checked");
					}
					configForm.find(".config-content.main").find(".Announcements").find("select").val(res[3]);
					configForm.find(".config-content.main").find(".Announcements").find("textarea").text(res[4]);
					configForm.find(".config-content.main").find(".Announcements").find('input#advanced-announcements-text').prop("checked", "checked");
				}

			}else if ( res[0] == "Voicemail" ){

				scenarioFormAvanced.find(".config-form").find(".Voicemail textarea").html("");
				scenarioFormAvanced.find(".config-form").find(".Voicemail #file-attachment").html("");
				
				configForm.find(".config-content.main").find(".Voicemail").find('[name="voice-email"]').val(res[3]);
				if(res[1] == "Upload File"){
					
					
					var fileNameIndex = res[2].lastIndexOf("/") + 1;
					var filename = res[2].substr(fileNameIndex);
					
					configForm.find(".config-content.main").find(".Voicemail").find('input#advanced-voicemail-mp3').prop("checked", "checked");
					
					var form_mp3 = scenarioFormAvanced.find(".config-form").find(".Voicemail #file-attachment");	
					form_mp3.html("<a href='/wp-content/uploads/univoxx_core/'"+res[2]+">"+filename+"</a>");
					console.log("fasdfasdfasdfasdfasdfads");
				}
				else{
				
				


					configForm.find(".config-content.main").find(".Voicemail").find('input#advanced-voicemail-text').prop("checked", "checked");
					if( res[2] == "Male" ){
						configForm.find(".config-content.main").find(".Voicemail").find('#voicemail-male').prop("checked", "checked")
					}else{
						configForm.find(".config-content.main").find(".Voicemail").find('#voicemail-female').prop("checked", "checked")
					}
					configForm.find(".config-content.main").find(".Voicemail").find("select").val(res[3]);
					configForm.find(".config-content.main").find(".Voicemail").find("textarea").text(res[4]);

					configForm.find(".config-content.main").find(".Voicemail").find('[name="advanced-voice-email"]').val(res[5]);
				}
			}
			else if ( res[0] == "Ring-Group" ){
				configForm.find(".config-content.main").find(".Ring-Group").find("input[name='advanced-seq']").prop("checked", "");
				var ring_checked = JSON.parse(res[2]);
				console.log(ring_checked);
				if(res[1] == "Sequential Ring"){
					
					
					
					configForm.find(".config-content.main").find(".Ring-Group").find('input#advanced-group-sequential').prop("checked", "checked");
					
					
					$.each(ring_checked , function(key , value){
						configForm.find(".config-content.main").find(".Ring-Group").find("input[value='"+value+"']").prop("checked", "checked");
					});
				}
				else{
					configForm.find(".config-content.main").find(".Ring-Group").find('input#advanced-group-simultaneous').prop("checked", "checked");
					
					jQuery("input[value='"+ring_checked[0]+"']").prop("checked", "checked");
				}
				configForm.find(".config-content.main").find(".Ring-Group").find('input.rings').val(res[3]);
				configForm.find(".config-content.main").find(".Ring-Group").find('select#advance-user-voicemail').val(res[4]);
			}
		});

		/* 62119 - End of Call scenario Section*/

	/*$('body').on('click','.subnum , .addnum',function(){
	   $("input.rings").change();
	});*/
	
	$('body').on('change','.config-content .auto-options',function(){
	var configName = $(this).find('option:checked').val();
	if(configName == "No-Configuration"){
		$(this).parents('.t-parent').find('.config-form .form-title span').html('Extension');
	}else{
		$(this).parents('.t-parent').find('.config-form .form-title span').html(configName);
	}
	$('.num_list li.active a span.type').html(configName);
	$('.num_list li.active').attr('data-type',configName).find('a').click();

});
	
	
	
	$(document).ready(function(){
		$("li.active").click();
	})
	
	
	
	
})(this.jQuery);
	
</script>

<script>

	jQuery(document).ready(function(){
		jQuery( document ).data( "ring_options" , <?=json_encode($ring_options)?>);
		
		//console.log($( document).data( "ring_options"));
	})

</script>