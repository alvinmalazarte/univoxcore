












var businessHours = [];


(function($){
"use strict";

/* Start scenation setting */
	$(document).ready(function(){ 
	
	

/* End scenation setting */
	




	
								/* Separetor Comment*/	
	
	
	
	


								/* Separetor Comment*/




	
	
	
	
	
	
	
	
	
	

		
/* Additional js*/

	


	

		$('[name="employee_count"]').on('change', function(){
			var employeeCount = $(this).val();
			var theHtml = $(document).find('.loop-phone-box').html();
			var loopCount = $(document).find('.loop-phone-box').length;
			console.log(loopCount);
			if ( employeeCount > 1 ) {
				
				$(document).find('section.loop-phone').append('<div class="loop-phone-box">'+theHtml+'</div>');

			}
		});

		$('.standard-phone').on('click', function(e){
			e.preventDefault();

			var currentPrice = $(document).find('.cart_price').html();
			var totalPrice = parseInt(20) + parseInt(currentPrice);
			console.log(currentPrice);
			$(document).find('.cart_price').html(totalPrice);

		});

		$('.deluxe-phone').on('click', function(e){
			e.preventDefault();

			var currentPrice = $(document).find('.cart_price').html();
			var totalPrice = parseInt(30) + parseInt(currentPrice);
			console.log(currentPrice);
			$(document).find('.cart_price').html(totalPrice);

		});

		$('.wifi-phone').on('click', function(e){
			e.preventDefault();

			var currentPrice = $(document).find('.cart_price').html();
			var totalPrice = parseInt(40) + parseInt(currentPrice);
			console.log(currentPrice);
			$(document).find('.cart_price').html(totalPrice);

		});

		$('.online-phone').on('click', function(e){
			e.preventDefault();

			var currentPrice = $(document).find('.cart_price').html();
			var totalPrice = parseInt(50) + parseInt(currentPrice);
			console.log(currentPrice);
			$(document).find('.cart_price').html(totalPrice);

		});

		var thisValue = $(this).val();
		if (thisValue == 'upload-file') {
			$('.hidden-text-speech').hide();
			$('.hidden-dropzone').show();
		}
		$('[name="item_type"]').on('change', function(){
			var thisValue = $(this).val();
			if (thisValue == 'upload-file') {
				$('.hidden-text-speech').hide();
				$('.hidden-dropzone').show();
			}else{
				$('.hidden-text-speech').show();
				$('.hidden-dropzone').hide();
			}
		});
		$('.hidden-call-forwarding').hide();
		$('#loop-call-forwarding').on('click', function(e){
			e.preventDefault();
			$('.hidden-call-forwarding').show();
			$('.hidden-voicemail').hide();
		});
		$('#loop-voicemail').on('click', function(e){
			e.preventDefault();
			$('.hidden-call-forwarding').hide();
			$('.hidden-voicemail').show();
		});

		var getUrlParameter = function getUrlParameter(sParam) {
		    var sPageURL = window.location.search.substring(1),
		        sURLVariables = sPageURL.split('&'),
		        sParameterName,
		        i;

		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');

		        if (sParameterName[0] === sParam) {
		            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		        }
		    }
		};

		function makeid(length) {
		   var result           = '';
		   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		   var charactersLength = characters.length;
		   for ( var i = 0; i < length; i++ ) {
		      result += characters.charAt(Math.floor(Math.random() * charactersLength));
		   }
		   return result;
		}
		var url_id = getUrlParameter('univoxx_id');

		if ( $('#univoxx-call-scenario-form').length == 1 && window.location.pathname == "/test-page/" && url_id == undefined) {
			var url      = window.location.href; 
			url      = removeLastSlash(window.location.href); 
			var value = url.substring(url.lastIndexOf('/') + 1);
			if(value !== ''){
				window.history.pushState("", "", "?univoxx_id=" + makeid(28));
			}
			
		}

		

		function removeLastSlash(strng){        
		    var n=strng.lastIndexOf("/");
		    var a=strng.substring(0,n) 
		    return a;
		}
		/*$('button').on('click', function(){
			submitFormContent();
		});*/
		function submitFormContent(){
			var items = {};
			//$( '#univoxx_form input' ).on('keyup', function(){
				$('#univoxx_form').find('input').each(function(){
					var dataName = '';
					var dataVal = '';
					if ( $(this).attr('type') == 'text' ){
						console.log($(this).attr('type'));

						dataName = $(this).attr('name');
						dataVal = $(this).val();

					}else if ( $(this).attr('type') == 'radio' ){
						console.log($(this).attr('type'));
						dataName = $(this).attr('name');
						dataVal = $("input[name='"+ dataName +"']:checked").val();

					}
					items[dataName] = dataVal;
				});
				$('#univoxx_form').find('select').each(function(){
					var	dataName = $(this).attr('name');
					var	dataVal = $(this).val();

					items[dataName] = dataVal;
				});
					console.log(items);
				var url      = window.location.href; 
				var value = url.substring(url.lastIndexOf('/') + 1);

				var data = {
					'action' 		: 'save_temp_data',
					'data'			: items,
					'unique_id'		: value
				}

				$.post(the_ajax_object.ajax_url, data, function(response) {
					console.log('success');
				});
			//});
		}

		//61319 - Onclick of tts
		var oneAjaxLoaded = 0;
		$("#insert_text_to_voice").on("click", function(){
			oneAjaxLoaded = 0;
			console.log(oneAjaxLoaded);
		});
		$(document).on("ajaxComplete", function(){
			var audioExist = $("#audio_converted audio").length;
			console.log(oneAjaxLoaded);
			if( audioExist == 1 && oneAjaxLoaded == 0 ){
				var audioData = $("#audio_converted audio").attr("src");

				var data = {
					'action' 			: 'univoxx_save_temp_audio',
					'unique_id'			: makeid(28),
					'base64_audio'		: audioData,
				}

		        $.post(the_ajax_object.ajax_url, data, function(response) {
					response		=	$.trim(response);
					response		=	$.parseJSON( response);
					//console.log(response);
					if(response.success){
						console.log(response);
	                  	oneAjaxLoaded = 1;
					}else{
						console.log(response);
						oneAjaxLoaded = 1;
					}

				});
			}
		}); // End of ajax complete

		// 61419 - On change of file upload
        $('[name="audio_upload"]').change(function(e){
            var data_cart_id = $(this).parents(".loop-item").find("[name='first_name']").attr("data-cart-id");

           	var audio_upload = e.target.files[0];
           	//var formData = new FormData(); formData.append('file', $('input[type=file]')[0].files[0]); data: formData
           	var formData = new FormData(); 
           	formData.append('action', 'univoxx_handle_file_uploads');
           	formData.append('audio_upload', audio_upload);
           	formData.append('data_cart_id', data_cart_id);
           	//data: formData
           	console.log(audio_upload);
           	

            /*var data = {
				'action' 			: 'univoxx_handle_file_uploads',
				'data_cart_id'		: data_cart_id,
				'audio_upload'		: formData,
			}*/

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
	            }
	        });

	        /*$.post(the_ajax_object.ajax_url, data, function(response) {
				response		=	$.trim(response);
				response		=	$.parseJSON( response);
				//console.log(response);
				if(response.success){
					console.log(response);
				}else{
					console.log(response);
				}

			});*/
        });


        /* 61719 - Select Phone System from Live*/
		var businessHours = []
		$("[name=scenario-type]").click(function(){
			businessHours = []
			$("ul.busHrs").empty().append('<li style="background:white;"><span style="color:black">No business hours given.</span></li>')

		})
		$(".addBusHrs").click(function(e){
			e.preventDefault();
			var targetList = $(this).parent().parent().find("ul.busHrs");
			targetList.empty();
			var busDay = $(this).parent().find("select#day option:checked").html();
			var busId = $(this).parent().find("select#day").val();
			var busStart = $(this).parent().find("select#start").val();
			var busEnd = $(this).parent().find("select#end").val();
			updateArray(busId, busDay, busStart, busEnd)
			businessHours.sort(function(obj1,obj2){
				return obj1.id - obj2.id;
			})

			var busLength = businessHours.length;
			for(var i = 0; i < busLength; i++){
				var li_content = '<li>\
						<p>'+businessHours[i].day+' from '+businessHours[i].start+' to '+businessHours[i].end+' <a href="#" data-targetID="'+businessHours[i].id+'">&#10006;</a></p>\
					</li>';
				targetList.append(li_content)
			}

		});

		$('body').on('click','.busHrs a',function(e){
			e.preventDefault();
			console.log("as")
			var targetID = $(this).attr('data-targetID');
			deleteOnArray(targetID,businessHours);
			$('ul.busHrs').empty();
			var busLength = businessHours.length;
			if(busLength == 0){
				$('ul.busHrs').append('<li style="background:white;"><span style="color:black">No business hours given.</span></li>')
				return;
			}
			for(var i = 0; i < busLength; i++){
				var li_content = '<li>\
						<p>'+businessHours[i].day+' from '+businessHours[i].start+' to '+businessHours[i].end+' <a href="#" data-targetID="'+businessHours[i].id+'">&#10006;</a></p>\
					</li>';
				$('ul.busHrs').append(li_content)
			}
		})

		function updateArray( id, day, start, end ) {
		   // SEARCH FOR EXISTING DATA AND UPDATE
		   for (var i in businessHours) {
		     if (businessHours[i].id == id) {
		        businessHours[i].start = start;
		        businessHours[i].end = end;
		        var isFound = true;
		        break; 
		     }else{
		     	var isFound = false
		     }
		   }
		   // IF NO EXISTING DATA, CREATE ONE
		   if(!isFound){
		   		businessHours.push({
					id : id,
					day : day,
					start : start,
					end : end
				})
		   }
		}

		function deleteOnArray(id,arrayName){
			for(var i in arrayName){
				if ( arrayName[i].id == id) {
			     	arrayName.splice(i, 1); 

			   		console.log('loop')
			   	}
			}

		}



		$('body').on('click','.num_list a',function(e){
			e.preventDefault();
			var target = $(this).parent().attr('data-type')
			$(this).parent().parent().find('li.active').removeClass('active');
			$(this).parent().addClass('active');
			toggleForm(target);
			$(this).parents('.t-parent').find('.config-content .auto-options').val(target)
			if(target == "No-Configuration"){
				$(this).parents('.t-parent').find('.config-form .form-title span').html('Extension');
			}else{
				$(this).parents('.t-parent').find('.config-form .form-title span').html(target);
			}
		})

		$('body').on('change','.config-content .auto-options',function(){
			var configName = $(this).find('option:checked').val();
			if(configName == "No-Configuration"){
				$(this).parents('.t-parent').find('.config-form .form-title span').html('Extension');
			}else{
				$(this).parents('.t-parent').find('.config-form .form-title span').html(configName);
			}
			$('.num_list li.active a span.type').html(configName);
			$('.num_list li.active').attr('data-type',configName).find('a').click();

		})

		$('body').on('change','.config-content .advanced-options',function(){
			var configName = $(this).find('option:checked').val();
			if(configName == "No-Configuration"){
				$(this).parents('.t-parent').find('.config-form .form-title span').html('Extension');
			}else{
				$(this).parents('.t-parent').find('.config-form .form-title span').html(configName);

			}
			$('.num_list li.active a span.type').html(configName);
			$('.num_list li.active').attr('data-type',configName).find('a').click();

		})


		function toggleForm(target){
			target.toLowerCase();
			if (target=="Greetings") {
				$('.config-content.main').hide();
				$('.config-content.greetings').show();
			}else{
				$('.config-content.greetings').hide();
				$('.config-content.main').show();
				$('.config-content .form-content').hide();
				$('.config-content .form-content.'+target).show();
			}
		}

		$('body').on('click','.addnum',function(){
		    var rings = parseInt($(this).parent().find(".rings").val())
		    if(rings > 8){return;}
		   $(this).parent().find(".rings").val(rings + 1)
		});
		$('body').on('click','.subnum',function(){
		    var rings = parseInt($(this).parent().find(".rings").val())
		    if(rings < 1){return;}
		    $(this).parent().find(".rings").val(rings - 1)
		});

		/* 61719 - End of Select Phone System from Live*/



	}); //End of ready


	
})(this.jQuery);
/**/
