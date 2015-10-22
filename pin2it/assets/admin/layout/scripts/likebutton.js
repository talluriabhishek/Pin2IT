$(function() {
	$(".likebutton").click(function (e) 
	{
		//alert($(this).attr('id').substring(10));
		var thisId = $(this).attr('id');
		
		var picId = $(this).attr('id').substring(10)
		request = $.ajax({
							url: "sendmelike.php",
							type: "post",
							data: {picId: picId}
						});

		request.done(function (response, textStatus, jqXHR)
		{
			$('#' + thisId).prop('disabled', true);
			var likesCounterId = '#numberOfLikes' + picId;
			$(likesCounterId).html(response.trim());
			
		});
				
		request.fail(function (jqXHR, textStatus, errorThrown)
		{
			alert("Error posting like. If Problem persists, contact support");
		});
		
		
	});
	
	
	$(".commentfield").bind("keypress", {}, keypressInCommentField);

	function keypressInCommentField(e) 
	{
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) 
		{ 
			//Enter keycode                        
			e.preventDefault();
			
			
			var picId = e.target.id.substring(12);
			
			var boardname = $("#hiddenBoardId").val();
			
			var thisId = e.target.id;
			
			var comment = $('#' + thisId).val();
			
			var otherUser = '';
			
			if(seeIfParamExists())
			{
				otherUser = $('#otherUser').val();
			}
			
			
			request = $.ajax({
							url: "sendmecomment.php",
							type: "post",
							data: {picId: picId, comment: comment, boardname: boardname, otheruser: otherUser}
						});

			request.done(function (response, textStatus, jqXHR)
			{
				//alert(response);
				
				var commentsArray = response.trim().split('||||');
				
				
				var firstComment = '<div class="portlet solid purple">' +
										'<div class="portlet-body">' +
												commentsArray[0] +
										'</div>' +
									'</div>';
				
				var totalComments = firstComment;
				
				
				
				if(commentsArray.length > 1)
				{
					var secondComment = '<div class="portlet solid purple">' +
										'<div class="portlet-body">' +
												commentsArray[1] +
										'</div>' +
									'</div>';
					totalComments = firstComment + secondComment;
				}
				
									
				
				
				
				$("#commentslist" + picId).html(totalComments);
				
				$("#" + thisId).val('');
				
			});
					
			request.fail(function (jqXHR, textStatus, errorThrown)
			{
				alert("Error posting comment. If Problem persists, contact support");
			});
			
		
			//alert(picId);
		}
	}
	
	
	$(".commentfieldHomepage").bind("keypress", {}, keypressInCommentHomeField);

	function keypressInCommentHomeField(e) 
	{
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) 
		{ 
			//Enter keycode                        
			e.preventDefault();
			
			
			var picId = e.target.id.substring(12);
			
			
			var boardname = $("#hiddenBoard" + picId).val();
			
			var thisId = e.target.id;
			
			var comment = $('#' + thisId).val();
			
			var otherUser = '';
			
			if(seeIfParamExists())
			{
				otherUser = $('#otherUser').val();
			}
			
			
			request = $.ajax({
							url: "sendmecomment.php",
							type: "post",
							data: {picId: picId, comment: comment, boardname: boardname, otheruser: otherUser}
						});

			request.done(function (response, textStatus, jqXHR)
			{
				//alert(response);
				
				var commentsArray = response.trim().split('||||');
				
				
				var firstComment = '<div class="portlet solid purple">' +
										'<div class="portlet-body">' +
												commentsArray[0] +
										'</div>' +
									'</div>';
				
				var totalComments = firstComment;
				
				
				
				if(commentsArray.length > 1)
				{
					var secondComment = '<div class="portlet solid purple">' +
										'<div class="portlet-body">' +
												commentsArray[1] +
										'</div>' +
									'</div>';
					totalComments = firstComment + secondComment;
				}
				
									
				
				
				
				$("#commentslist" + picId).html(totalComments);
				
				$("#" + thisId).val('');
				
			});
					
			request.fail(function (jqXHR, textStatus, errorThrown)
			{
				alert("Error posting comment. If Problem persists, contact support");
			});
			
		
			//alert(picId);
		}
	}
	
	
	
	
	
	function seeIfParamExists()
	{
		var field = 'otheruser';
		var url = window.location.href;
		if(url.indexOf('?' + field + '=') != -1)
			return true;
		else if(url.indexOf('&' + field + '=') != -1)
			return true;
		return false;
	}
	
	$(".frenreqbtn").click(function (e) 
	{
		//alert($(this).attr('id').substring(10));
		var thisId = $(this).attr('id');
		
		var otherUser = $(this).attr('id').substring(10)
		request = $.ajax({
							url: "requestvalidation.php",
							type: "post",
							data: {otherUser: otherUser}
						});

		request.done(function (response, textStatus, jqXHR)
		{
			$('#' + thisId).prop('disabled', true);
			alert(response.trim());
			
		});
				
		request.fail(function (jqXHR, textStatus, errorThrown)
		{
			alert("Error posting friend request. If Problem persists, contact support");
		});
		
		
	});
});