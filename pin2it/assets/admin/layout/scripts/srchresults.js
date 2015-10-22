$(function() {
	var oTable;
	
	oTable = $("#searchresultsTable").DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
		"bFilter": false
    });
	
	
	$("#srchButton").click(function (e) 
	{
		srchresults();
	});
	
	$("#srchButtonTag").click(function (e) 
	{
		srchresultsTag();
	});
	
	$("#searchKey").bind("keypress", {}, verifyAndSearch);
	
	$("#searchKeyTag").bind("keypress", {}, verifyAndSearchTag);
	
	
	function verifyAndSearch(e)
	{
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) 
		{ //Enter keycode                        
			e.preventDefault();
			srchresults();
		}
	}
	
	function verifyAndSearchTag(e)
	{
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) 
		{ //Enter keycode                        
			e.preventDefault();
			srchresultsTag();
		}
	}
	
	function srchresultsTag()
	{
		//alert($("#searchKeyTag").val());
		var srchKeyTag = $("#searchKeyTag").val();
		
		request = $.ajax({
							url: "searchmekeyTag.php",
							type: "post",
							data: {key: srchKeyTag.trim()}
						});

		request.done(function (response, textStatus, jqXHR)
		{
			//console.log('here');
			//console.log(response);
			var jsonencoded = JSON.parse(response.trim());
			
			var url;
			
			var divContent = '';
			
			for(i=0;i<jsonencoded.length;i++)
			{
				url = jsonencoded[i];
				console.log(url);
				var categoryImage = '<div class="col-md-3 col-sm-4 mix category_1 mix_all" style="  display: block; opacity: 1;"><div class="mix-inner"><img class="img-responsive" src="' + url + '" alt=""></div></div>';
				
				
				divContent = divContent + categoryImage;
			}	
			
			$('#searchresults').empty();
			
			$('#searchresults').html(divContent);
		});
				
		request.fail(function (jqXHR, textStatus, errorThrown)
		{
			alert("Error posting like. If Problem persists, contact support");
		});
		
		
	}
	
	function srchresults()
	{
		var srchKey = $("#searchKey").val();
		
		request = $.ajax({
							url: "searchmekey.php",
							type: "post",
							data: {key: srchKey.trim()}
						});

		request.done(function (response, textStatus, jqXHR)
		{
			var jsonencoded = JSON.parse(response.trim());
			
			//console.log(jsonencoded);
			
			var username;
			var usernamedLink;
			var firsname;
			var lastname;
			
			oTable.clear();
			for(i=0;i<jsonencoded.length;i++)
			{
				username = jsonencoded[i][0];
				usernamedLink = '<a href="otherprofile.php?otheruser=' + username + '">' + username + '</a>';
				console.log(usernamedLink);
				firstname = jsonencoded[i][1];
				lastname = jsonencoded[i][2];
				
				oTable.row.add([
					usernamedLink,
					firstname,
					lastname
				]).draw();
			
			}	
			
			
		});
				
		request.fail(function (jqXHR, textStatus, errorThrown)
		{
			alert("Error posting like. If Problem persists, contact support");
		});
		
		
	}
});