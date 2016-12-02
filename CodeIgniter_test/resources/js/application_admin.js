var App1000 = {
	console:function (text) {
		console.log(text);
	},
	back:function () {
		history.go(-1);
	},
	alert:function (result) {
		alert(result);
	},
	previeFromFile:function($inputImage, $image) {
		if (window.FileReader) {
	       $inputImage.change(function(event){		
				var files = event.target.files;
				if (files && files[0]) {
			        var reader = new FileReader();
			        reader.onload = function (e) {
			            $image.attr('src', e.target.result);
			        }
			        reader.readAsDataURL(files[0]);
			    }
			});
	    } else {
	        $inputImage.addClass("hide");
	    }
	},
	post:function(url, request, callback) {
		$.post(url, request, 
	        function (response) {
				if (response.r == "ok") {
					if (callback != null) callback(response);
				}
				else {
					alert(response.m + "(" + response.c + ")");
				}
			});
	},
	postForm:function(form, callback) {
		
		form.ajaxForm({
	            success: function(response, status){

					if (response.r == "ok") {
						if (callback != null) callback(response);
					}
					else {
						alert(response.m + "(" + response.c + ")");
					}
	            }                           
	        }).submit();
	}
};
