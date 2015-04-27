(function(){

	// //checkout informing friends when friend request is accepted

	//login bottom message alert
	$('.welcome-alert').fadeIn(300).delay(3500).fadeOut(300);

	//Register and Connect to websocket
	var socket = io.connect('http://localhost:3000');
            
    socket.emit('register', {'userId': userId});

	//Listening to websocket alerts//
 	socket.on(userId, function(data){

 		//Updating chat status
 		if(data.clientcode == 21)
 		{
 			//Update chat status on current user 
 			if(data.relatedToId == userId)
 			{
 				if(data.message == true)
 				{
 					$('#friend-list .wrapper-2').hide();

 					$('#friend-list .wrapper').hide();
 				}
 				else
 				{	
 					$('#friend-list .wrapper-2').hide();

 					$('#friend-list .wrapper').show(); 					
 				}
 			}
 			else
 			{	
 				//Alert/changeStatus on all connected friends of currentuser who changed chat status 
	 			if(data.message == true)
	 			{
	 				console.log(data.relatedToId);
	 				$( "a[data-userid="+data.relatedToId+"]" ).removeClass('disabled');		
	 			}
	 			else
	 			{
	 				console.log(data.relatedToId);
	 				$( "a[data-userid="+data.relatedToId+"]" ).addClass('disabled');	
	 			}

 			} 			
 			
 		}
 		else if(data.clientcode == 22)//Alerting all connected friends that current user has logged in/out
 		{	
 			
 			if(data.message == false)
 			{
 				$( "a[data-userid="+data.relatedToId+"]" ).addClass('disabled');
 			}			

 				
 		}
 		else if(data.clientcode == 23)//Record chat messages sent to current user
 		{
 			//Determine if current user is available to chat
 			var availabilityStatus = $('input[name="chatStatus"]').is(":checked") ? true : false;

 			if(availabilityStatus)
 			{	
	 			//Determine if message sender available to chat
	 			var friendLink = $("a[data-userid = "+data.relatedToId+"]");

	 			if(friendLink.hasClass('disabled'))
	 			{
	 				return false;
	 			}
	 			else
	 			{	 				
	 				//Handle chat messages when both users are available to chat
	 				handleChatMessages({"friendId": data.relatedToId, "message" : data.message});

		 			if($('#chatwithuser'+data.relatedToId).length)
		 			{
		 				$('#chatwithuser'+data.relatedToId).find('ul').append('<li>'+data.message+'</li>');

		 				$('#chatwithuser'+data.relatedToId).show();

		 				console.log('opened already created chat object');	
		 			}
		 			else
		 			{
						var friendProfileImage = friendLink.find('.avatar').attr('src');

						var friendName = friendLink.find('.avatar').attr('alt');

		 				openChatBox({"friendProfileImage": friendProfileImage, "friendName": friendName, "friendId": data.relatedToId});

		 				console.log('created new chat box object');
			 		}

	 			}//End checking if sender is available to chat

 			}
 			else
 			{
 				return availabilityStatus;

 			}//End checking if current user is available to chat 			
 			
 		}
 		else if(data.clientcode == 24)//Alerting connected friend when a user has terminated the friendship with her
 		{
 			if(! data.message)
 			{
 				$('#friend-side-list').hide();
 				
 				$('#friend-list').append('<div id="no-friend-chat-alert" class="alert alert-info" role="alert">'+
 					'<span class="glyphicon glyphicon-info-sign"></span>'+
 					' You don\'t have any friends.</div>');

 				var friendsCount = $('.friends-count').text();

				var actualFriendsCount = parseInt(friendsCount) - 1;

				$('.friends-count').text(actualFriendsCount);

 				if($(location).attr('href') == "/friends")
 				{
 					$('.users-list').hide();

 					$('#center-column').append('<div class="alert alert-info" role="alert">'+
					'<span class="glyphicon glyphicon-info-sign"></span> You don\'t have any friends.</div>');
 			
 				}
 				else if($(location).attr('href') == "/users")
 				{
 					$( "a[data-userid = "+data.relatedToId+"]" ).attr('disabled', 'disabled').text('Removed');
 				}
 				else if($(location).attr('href') == "/users/"+data.relatedToId)
 				{
 					$( "a[data-userid = "+data.relatedToId+"]" ).attr('disabled', 'disabled').text('Removed');
 				}		
 			}
 			else
 			{	
 				var friendsCount = $('.friends-count').text();

				var actualFriendsCount = parseInt(friendsCount) - 1;

				$('.friends-count').text(actualFriendsCount);

 				$( "#chat-list-user-"+data.relatedToId ).hide('slide', {direction : 'right'}, 300);

 				if($(location).attr('href') == "/friends")
 				{
 					$( "a[data-userid = "+data.relatedToId+"]" ).closest('.listed-object-close').hide();
 				}
 				else if($(location).attr('href') == "/users")
 				{
 					$( "a[data-userid = "+data.relatedToId+"]" ).attr('disabled', 'disabled').text('Removed');
 				}
 				else if($(location).attr('href') == "/users/"+data.relatedToId)
 				{
 					$( "a[data-userid = "+data.relatedToId+"]" ).attr('disabled', 'disabled').text('Removed');
 				}

 			} 			

 		}		

	 }); //End listening for socket alerts


	//Handle ajax form submissions

	$('.message-form').submit(handleFormSubmisions);

	$('.message-response-form').submit(handleFormSubmisions);

	$('.feed-form').submit(handleFormSubmisions);	


	function handleFormSubmisions()
	{

		var form = $(this);

		var url = form.prop('action');

		var method = form.find('input[name="_method"]').val() || 'POST';

		var formData = form.serialize();

		$.ajax({

			type: method,
			url: url,
			data: formData
		})

		.done(function(data)
		{
			if(data.response == 'success'){

				switch (form.prop('class')) {				   

					case 'message-form':

			        $('.center-alert').html(data.message).fadeIn(300).delay(2500).fadeOut(300);

			        form.find('textarea').val("");

					break;

					case 'message-response-form':

			        // $('.center-alert').html(data.message).fadeIn(300).delay(2500).fadeOut(300);			       

			        $('.message-response-list').prepend('<div class="media listed-object-close">'+
						'<div class="pull-left"><a href="#"><img class="media-object avatar small-avatar"'+ 
						'src="'+userProfileImage+'" alt="'+userFirstname+'"></a>'+		
						'</div><div class="media-body"><p><span class="text-muted">Just now you wrote:</span>'+
						'<a href="#"><span></span></a></p><div>'+form.find('textarea').val()+'</div></div></div>');

			        form.find('textarea').val("");

					break;

					case 'feed-form':

					var feedsCount = $('.feeds-count').text();

					var actualFeedsCount = parseInt(feedsCount) + 1;

					$('.feeds-count').text(actualFeedsCount);

					$('.feed-list').prepend('<div id="feedid" class="media listed-object">'+
						'<div class="pull-left"><img class="media-object avatar medium-avatar" src="'+data.userProfileImage+'" alt="'+data.userFirstname+'">'+
						'</div><div class="media-body"><h4 class="media-heading">'+data.userFirstname+'</h4><p>Just now</p>'+
						data.feedBody+'</div></div>');

					form.find('textarea').val("");

					$('.no-feeds-info').hide();
				

			       	break;			
								     
				}			

			}
			else if(data.response == 'failed')
			{
				switch (form.prop('class')) {				   

					case 'message-form':

			        	$('.center-alert').html('Your message is empty').fadeIn(300).delay(2000).fadeOut(300);

					break;

					case 'message-response-form':

						 $('.center-alert').html('Your message is empty').fadeIn(300).delay(2000).fadeOut(300);

					break;
				}

		        form.find('textarea').val("");					
			}			
		})

		.fail(function(){

			return alert('something went wrong. Please try again.');

		});

		//end ajax

		return false;

	}//end handle ajax form submissions


	//Handle ajax friend activity

	$('.friend-request-button').click(handleAjaxRequests);

	$('.add-friend-button').click(handleAjaxRequests);

	$('.add-friend-button-2').click(handleAjaxRequests);

	$('.unfriend-button').click(handleAjaxRequests);

	$('.unfriend-button-2').click(handleAjaxRequests);

	$('.unfriend-button-3').click(handleAjaxRequests);

	$('.logout-link').click(handleAjaxRequests);

	function handleAjaxRequests()
	{

		var button = $(this);

		var userId = button.attr('data-userid');

		var url = button.attr('href');

		var method = button.attr('data-method') || 'POST';

		var className = button.attr('class');

		var imgPath = button.closest('.listed-object-close').find('.avatar').attr('src') || button.closest('#profile-card').find('.avatar').attr('src');

		var friendName = button.closest('.listed-object-close').find('.avatar').attr('alt') || button.closest('#profile-card').find('.avatar').attr('alt');


		$.ajax({

			type: method,
			url: url,
			data: {userId: userId}
		})

		.done(function(data){

			if(data.response == 'success')
			{
				switch (className) 
				{
					case 'btn btn-primary friend-request-button btn-sm':
					//Enable if you want the center alert to show
			        // $('.center-alert').html(data.message).fadeIn(300).delay(2500).fadeOut(300);

					button.attr('disabled', 'disabled').text('Requested');

					break;

					case 'btn btn-primary add-friend-button btn-sm':

					//Enable if you want the center alert to show
			        // $('.center-alert').html(data.message).fadeIn(300).delay(2500).fadeOut(300);

					button.attr('disabled', 'disabled').text('Friend added');

		        		$('#no-friend-chat-alert').hide();

						$('#friend-list').append('<div id="friend-side-list" class="list-group">'+
						'<a href="#" class="list-group-item side-list disabled" data-userid = "'+ userId +'">'+						
						'<div class="media"><div class="pull-left">'+
						'<img class="media-object avatar small-avatar" src="'+ imgPath+'" alt="'+ friendName+'">'+        
						'</div><div class="media-body">'+						     	
						''+ friendName +' <span class="glyphicon glyphicon-flash text-success"></span>'+
						'</div></div></a></div>');									        	 	
			        					

					break;

					case 'btn btn-primary add-friend-button-2 btn-sm':

			        button.closest('.listed-object-close').slideUp();

			         if(data.count == 0)
			        {

			        	$('.users-list').append('<div class="alert alert-info" role="alert">'+
						'<span class="glyphicon glyphicon-info-sign"></span> You don\'t have any friend requests.</div>');
			        }			       

			       
	        		$('#no-friend-chat-alert').hide();

					$('#friend-list').append('<div id="friend-side-list" class="list-group">'+
					'<a href="#" class="list-group-item side-list disabled" data-userid = "'+ userId +'">'+						
					'<div class="media"><div class="pull-left">'+
					'<img class="media-object avatar small-avatar" src="'+imgPath+'" alt="'+ friendName+'">'+        
					'</div><div class="media-body">'+						     	
					''+ friendName +' <span class="glyphicon glyphicon-flash text-success"></span>'+
					'</div></div></a></div>');			

		        	var friendsCount = $('.friends-count').text();

					var actualFriendsCount = parseInt(friendsCount) + 1;

					$('.friends-count').text(actualFriendsCount);						

					break;

					case 'btn btn-primary unfriend-button btn-sm':

					 if(data.count == 0)
				       {			        	

				        	$('#friend-side-list').hide();

							$('#friend-list').append('<div id="no-friend-chat-alert" class="alert alert-info" role="alert">'+
			 					'<span class="glyphicon glyphicon-info-sign"></span>'+
			 					' You don\'t have any friends.</div>');
				       }

				    var friendsCount = $('.friends-count').text();

					var actualFriendsCount = parseInt(friendsCount) - 1;

					$('.friends-count').text(actualFriendsCount);

					$( "#chat-list-user-"+userId ).hide('slide', {direction : 'right'}, 300);

					button.attr('disabled', 'disabled').text('Removed');

					break;

					case 'btn btn-primary unfriend-button-2 btn-sm':

			         button.closest('.listed-object-close').slideUp();

			        if(data.count == 0)
			        {			        	
			        	$('.users-list').append('<div class="alert alert-info" role="alert">'+
						'<span class="glyphicon glyphicon-info-sign"></span> You don\'t have any friend requests.</div>');
			        }						

					break;

					case 'btn btn-primary unfriend-button-3 btn-sm':

				        button.closest('.listed-object-close').slideUp();

				        $( "a[data-userid="+button.attr('data-userid')+"]" ).hide('slide', {direction : 'right'}, 300);
				     
				        if(data.count == 0)
				        {			        	
				        	$('.users-list').append('<div class="alert alert-info" role="alert">'+
							'<span class="glyphicon glyphicon-info-sign"></span> You don\'t have any friends.</div>');

				        	$('#friend-side-list').hide();
							$('#friend-list').append('<div class="alert alert-info" role="alert">'+
			 					'<span class="glyphicon glyphicon-info-sign"></span>'+
			 					' You don\'t have any friends.</div>');
				        }

					    var friendsCount = $('.friends-count').text();

						var actualFriendsCount = parseInt(friendsCount) - 1;

						$('.friends-count').text(actualFriendsCount);						

					break;

					case 'logout-link':

						if($('#no-friend-chat-alert').is(":visible"))
						{
							window.location.replace("/");	
						}
						else
						{
							$('.side-list').each(function(){

							var friendListUserId = $(this).attr('data-userid');

							sessionStorage.removeItem('conversation-with-'+friendListUserId);							

							});	

							window.location.replace("/");

						}
										

					break;

				}

			}
			else if(data.response == 'failed')
			{
				$('.center-alert').html(data.message).fadeIn(300).delay(2500).fadeOut(300);
			}
			else
			{
				alert('Something went wrong. Please try again later.');	
			}	
			

		})

		.fail(function(data)
		{
			return alert('something went wrong. Please try again.');
		});

		return false
	}
	//End handle ajax friend activity	


	//Update message open status

	$('.open-message').click(function(){

		var messageResponseId = $(this).attr('data-message-response-id');

		var openValue = 1;

		$.ajax({

			type: "put",
			url: "/message-response",
			data: {openValue : openValue, "messageResponseId": messageResponseId}
		})
		.done(function(data){

			return false
		})
		.fail(function(){

			return alert('something went wrong. Please try again.');

		});

	});//end update message open status


	//Remove message

	$('.delete-message').click(function(){

		$(this).closest($('.listed-object-close')).slideUp();	

		var messageId = $(this).attr('data-message-id');

		$.ajax({

			type: "delete",
			url: "/message-delete",
			data: {messageId: messageId}

		}).done(function(data){

			var messageCount = $('.message-count').text();

			var actualMessageCount = messageCount - 1;

			$('.message-count').text(actualMessageCount);

			if(data.count == 0)
			{
				
				$('.message-list').append('<div class="alert alert-info" role="alert">'+
					'<span class="glyphicon glyphicon-info-sign"></span> Your inbox is empty.</div>');
			}

		})
		.fail(function(){

			return alert('something went wrong. Please try again.');

		});

		return false;

	});//End remove message

	//show message responses

	$('.glyphicon-chevron-down').first().switchClass('glyphicon-chevron-down', 'glyphicon-chevron-up');

	$('.message-body').first().css('display', 'block');


	//Open / close email message

	$('.expand-message').click(function(){

		if($(this).hasClass('glyphicon-chevron-down'))
		{
			$(this).switchClass( "glyphicon-chevron-down", "glyphicon-chevron-up");
		}
		else if($(this).hasClass('glyphicon-chevron-up')) 
		{
			$(this).switchClass( "glyphicon-chevron-up", "glyphicon-chevron-down");
		};

		$(this).closest('.media-body').find($('.message-body')).toggle("slide", { direction: "up"} );


		return false;

	}); //End open / close email message

	
	//Handling chat activity//


	//Update current user's chat status
	var chatStatus = $('input[name="chatStatus"]').bootstrapSwitch();

	chatStatus.on('switchChange.bootstrapSwitch', function(event, state) {

		$.post( "/chatstatus", { chatStatus: Number(state) } );

	});//end Update current user's chat status

	
	//Getting conversation data from session storage
    function getChatConversationData(userId)
    {
    	if (localStorage)
    	{
	    	var conversation = [];

	    	conversation = JSON.parse( sessionStorage.getItem( 'conversation-with-'+userId ) );

	    	return conversation;
    	}
    }

    //Saving messages in session storage
    function handleChatMessages(params)
    {
    	var conversation = getChatConversationData(params.friendId);

    	if(!conversation)
    	{
    		sessionStorage.setItem('conversation-with-'+params.friendId, JSON.stringify({"messages": [params.message]}));  		
    	}
    	else
    	{
    		conversation["messages"].push(params.message);

    		sessionStorage.setItem('conversation-with-'+params.friendId, JSON.stringify(conversation));
    	}
    	
    }


    //Opening chat box when clicking any friends on side list

	$('a', $('#friend-list')).click(function(){

		if(! $(this).hasClass('disabled'))
			{
				var friendProfileImage = $(this).attr('data-profileimage');

				var friendName = $(this).attr('data-firstname');

				var friendId = $(this).attr('data-userid');

				if ($('#chatwithuser'+friendId).length){

					$('#chatwithuser'+ friendId).show();
				}
				else
				{
					openChatBox({"friendProfileImage": friendProfileImage, "friendName": friendName, "friendId": friendId});
				}
				
			}

			return false
	});


    //end handling chat activity


	function openChatBox(params)
	{
		var friendProfileImage = params.friendProfileImage;

		var friendName = params.friendName;

		var friendId = params.friendId;

		var marginLeft = "";
	

		//margin left of newly created form
		if($('.chat-room').length)
		{
			marginLeft = parseInt($('.chat-room' ).last().css('margin-left').slice(0, -2)) + 273;
		}
		else
		{
			marginLeft = 0;
		}				

		//This will not allow a 5th chat window to open
		if(marginLeft < 819)
		{
			$('#chat-container').append(generateChatForm(friendProfileImage, friendName, friendId, marginLeft));
		}	
						

	}//End openChatBox


	function generateChatForm(friendProfileImage, friendName, friendId, marginLeft)
	{

		//create each form element

		var $mainDiv = $("<div></div>").attr("id", "chatwithuser"+friendId).css('margin-left', marginLeft+'.px').addClass("chat-room chat-full col-md-3");

		var $mediaClass = $("<div></div>").addClass("media").appendTo($mainDiv);

		var $mediaLeftClass = $("<div></div>").addClass("media-left").appendTo($mediaClass);


		var $mediaObjectClass = $("<img/>", {

			"class" : "media-object avatar small-avatar",
			"src"	: friendProfileImage,
			"alt"	: friendName

		}).appendTo($mediaLeftClass);

		var $mediaBodyClass = $("<div></div>").addClass("media-body").appendTo($mediaClass);


		var $mediaHeadingClass = $("<p></p>").addClass('media-heading').text(friendName).appendTo($mediaBodyClass);


		var $closeButton = $("<a/>", {

				'href': '#',
				click : function() {

					$(this).closest("#chatwithuser"+friendId).hide();

					return false;
				}

			}).appendTo($mediaHeadingClass);


		var $closeSpan = $("<span></span>").addClass('glyphicon glyphicon-remove').appendTo($closeButton);

		var $minimizeButton = $("<a/>", {

				'href': '#',
				click : function() {

					if($(this).children('span').hasClass('glyphicon-chevron-down'))
					{
						$(this).children('span').switchClass( "glyphicon-chevron-down", "glyphicon-chevron-up");	
					}
					else if($(this).children('span').hasClass('glyphicon-chevron-up'))
					{
						$(this).children('span').switchClass( "glyphicon-chevron-up", "glyphicon-chevron-down");	
					}

					$(this).closest("#chatwithuser"+friendId).find(".chat-body-form").toggle( "slide", { direction: "down"} );

				

					return false;
				}

			}).appendTo($mediaHeadingClass);

		var $minimizeSpan = $("<span></span>").addClass('glyphicon glyphicon-chevron-down').appendTo($minimizeButton);


		var $chatBodyFormClass = $("<div></div>").addClass("chat-body-form").appendTo($mediaBodyClass);


		var $chatBodyClass = $("<div></div>").addClass("chat-body").appendTo($chatBodyFormClass);

		var $messagesClass = $("<ul></lu>").addClass("messages").appendTo($chatBodyClass);


		var chatConversationWithFriend = [];

		chatConversationWithFriend = JSON.parse( sessionStorage.getItem( 'conversation-with-'+friendId ) );


		if(chatConversationWithFriend)
		{
			for(i = 0; i < chatConversationWithFriend['messages'].length; i++)
			{
				var $eachMessage = $("<li></li>").text(chatConversationWithFriend['messages'][i]).appendTo($messagesClass);
			}						
		}				


		var $chatForm = $("<form/>", {

			submit: function(){

				parentDiv = $(this).closest('#chatwithuser'+friendId);

				messageBody = parentDiv.find('ul');

				textField = $(this).find('textarea');

				message = textField.val();

				if(message == ""){

					return false;
				}
				else
				{					
					textField.val('');

					$.ajax({
						type: "POST",
						url: "/chat",
						data: { receiverId: friendId, message: userFirstname+": "+message }
					})

					.done(function(data){

						if(data.availableToChat == true) //Determine the receiver is available to chat
						{
							messageBody.append(($('<li>').text(userFirstname+": "+message)));

							handleChatMessages({"friendId": friendId, "message" : userFirstname+": "+message});
						}
						else
						{
							//user is not available to chat
							messageBody.append(($('<li>').text(friendName+" is offline").css("color", "red")));
						}


					})
					.fail(function() {

						return alert('something went wrong. Please try again.');

					});
					
				}

				return false							

				
			}//end submit

		}).appendTo($chatBodyFormClass);

		var $formGroupClass = $("<div></div>").addClass("form-group form-group-sm").appendTo($chatForm);

		var $formTextArea = $("<textarea></textarea>")
		.addClass("form-control")
		.attr( "placeholder", "Enter message" )
		.attr("rows", "1")
		.attr("name", "body")
		.appendTo($formGroupClass);

		var $formButton = $("<button/>", {

			"type" : "submit",
			"class": "btn btn-default",
			text    : "Submit"

		}).appendTo($chatForm);


		return $mainDiv;

	}//End generate chat form
	

	


	// Loading feeds when scrolling

	if($(location).attr('href') == "http://larasocial.info/feeds")
	{	

		$(window).scroll(function(){

			if ($(window).scrollTop() + $(window).height() >= $(document).height() - 850)
			{
				$('#go-up').show();
			}
			else
			{
				$('#go-up').hide();
			}


			if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300){

				var skipQty = $('.listed-object').length;

				if(skipQty <= 10)
				{
					skipQty = 10;
				}
				
				if(skipQty < $('.feed-list').attr('data-feedcount'))
				{

					$('#loader').fadeIn('slow', function() {


						$.ajax({
							url: "feeds/more",
							data: { 'skipQty' : skipQty}
						})

						.done(function(data)
						{
							$('#loader').fadeOut('slow', function() {

								var feedsHTML = "";

								$.each(data.feeds, function(index, feed){

										if ($('#feedid'+feed.id).length == 0)
										{
											feedsHTML += '<div id="feedid'+feed.id+'" class="media listed-object">'+
											 '<div class="pull-left"><img class="media-object avatar medium-avatar" src="'+feed.poster_profile_image+'"'+
											 ' alt="'+feed.poster_firstname+'"></div><div class="media-body"><h4 class="media-heading">'+feed.poster_firstname+'</h4>'+
											 '<p>'+$.timeago(feed.created_at)+'</p>'+feed.body+'</div></div>';	
										}
										else
										{
											return false
										}				

								
								});

								$('.feed-list').append(feedsHTML);

							}); //Finish fading out loader
							

						})

						.fail(function() {

							return alert('something went wrong. Please try again.');

						});

					});	//Finish showing the loader			

				}
				else
				{
					return false
				}				

			}//end scrolling
		});

	}//End Loading new feeds

	// //scrolling Top		
	$("body").scrollspy({target: "#go-up"});

})();