function openFolder(id) {
	$.ajax({
		url: SITE_URL + "/index.php/files/GetChild/" + id,
		
		}).done(function(data) {
		//alert(data);
		eval('obj=' + data);
		$(".folderHolder #content").html("");
		parentId = id;
		if(obj.length) {
			for(i in obj) {
				if(obj[i]['folder'] == 0)
					$(".folderHolder #content").append("<div class='folderContainer'><a href='javascript:openFolder(" + obj[i]['id'] + ");'><img src='" + SITE_URL + "/uploads/" + obj[i]['name'] + "'><br/>" + obj[i]['name'] + "</a></div>");
				else
					$(".folderHolder #content").append("<div class='folderContainer'><a href='javascript:openFolder(" + obj[i]['id'] + ");'><img src='" + SITE_URL + "/js/src/images/images.jpg'><br/>" + obj[i]['name'] + "</a></div>");
			}
		}
	});
}
function createFolder() {
	//if($(".folderHolder img") != null )
		//$(".folderHolder").html("");
		var $fileName = $("#folderName").val();
		$.post(SITE_URL + '/index.php/files/create', {"Files" : { name: $fileName, parent: parentId, createdBy: 0, folder: 1 }} , function(data) {
			//$(".container").html(data);
			eval('obj=' + data);
			$(".folderHolder #content").append("<div class='folderContainer'><a href='javascript:openFolder(" + obj["id"] + ");'><img src='" + SITE_URL + "/js/src/images/images.jpg'><br/>" + $fileName + "</a></div>");
		});
	$('#folder').trigger('close');
	$('#folder').find('input:first').val("");
}
function popLogin () {
	$("#login").lightbox_me({
        //centered: true, 
        onLoad: function() { 
            $('#login').find('input:first').focus();
            }
        });
}
function login () {
	//var data=$("#login-form").serialize();
	//alert($("#login-form #LoginForm_username").val());
	//alert(data);
	//return true;
	$("#login-form").submit();
}
function popSighnup () {
	$("#sighnUp").lightbox_me({
        //centered: true, 
        onLoad: function() { 
            $('#sighnUp').find('input:first').focus();
            }
        });
}
function sighnUp () {
	//var data=$("#login-form").serialize();
	//alert($("#login-form #LoginForm_username").val());
	//alert(data);
	//return true;
	$("#login-form").submit();
}