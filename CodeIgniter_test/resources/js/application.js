var App1000 = {
	callback:null,
	user_agent:'',
	host_url:'',
	was_url:'',
	cdn_url:'',
	fb_client_id:'',
	
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
				if (callback != null) callback(response);
			}).fail(function() {
				callback({"r":"err", "c":0, "m":"서버에러", "d":""});
  			});
	},
	postForm:function(form, callback) {		
		form.ajaxForm({
	            success: function(response, status){
					if (callback != null) callback(response);
	            }                           
	        }).submit();
	},
	
	setCookie:function(key, value, expiredays) {
		var today = new Date();
		today.setDate(today.getDate() + expiredays);
		document.cookie = key + "=" + escape(value) + "; path=/; expires="
		+ today.toGMTString() + ";";
	},

	getCookie:function(key) {
		var cook = document.cookie + ";";
		var idx = cook.indexOf(key, 0);
		var val = "";
	
		if (idx != -1) {
			cook = cook.substring(idx, cook.length);
			begin = cook.indexOf("=", 0) + 1;
			end = cook.indexOf(";", begin);
			val = unescape(cook.substring(begin, end));
		}
	
		// 가져온 쿠키값이 있으면
		if (val != "") return val;
	},
	
	//공유하기
	share_fb_content:function(url, content, picture, title){
		FB.ui({
		    display: 'popup',
		    method: 'share_open_graph',
		    action_type: 'og.shares',
		    action_properties: JSON.stringify({
		        object : {
		           'og:url': url,
		           'og:title': title,
		           'og:description': content,
		           'og:image': picture,
		        }
		    })
		}, function(response){});
	},
	
	share_tw_content:function(url, content){		
		window.open('http://twitter.com/share?url=' + url + '&text=' + content + '&', 'twitterwindow', 'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
	},
	
	// facebook login
	connect_to_fb_for_mobile:function() {
		var facebookUrl = 'https://www.facebook.com/dialog/oauth?client_id=';
        facebookUrl += App1000.fb_client_id;
        facebookUrl += '&redirect_uri=';
        facebookUrl += App1000.host_url+'/callback/member/callback_facebook';
        facebookUrl += '&scope=';
        facebookUrl += 'email,public_profile';
        window.open(facebookUrl, 'loginWindow', 'menubar=no, width=550, height=550, resizable=no, scrollbars=yes');
	},
	
	connected_to_fb_for_code:function(code) {
		
		$.ajax({
			url: 'https://graph.facebook.com/oauth/access_token',
			type:'GET',
			data:{
	           code: code,
	           redirect_uri: App1000.host_url+'/member/callback_facebook',
	           client_id: App1000.fb_client_id, //CLIENT_ID IS REPLACED WITH ACTUAL VALUE IN CODE
	           client_secret: App1000.fb_secret_id //CLIENT_SECRET IS REPLACED WITH ACTUAL VALUE IN CODE
			},
			success: function(accessToken){
			    $.ajax({
					url: 'https://graph.facebook.com/v2.6/me?fields=id,email,name,gender,picture,locale&' + accessToken,
					type:'GET',
					success: function(profile){
						
						var userID = profile.email;
						if (typeof userID == 'undefined' || userID == 'undefined') {
							userID = profile.id;
						}
					
						$.ajax({
							url: 'https://graph.facebook.com/v2.6/me/picture?' + accessToken + '&type=large&redirect=false',
							type:'GET',
							success: function(response){
								
								$.post("/api/member/ajax_signup_for_fb", 
									{"email":userID, "nickname":profile.name, "id":profile.id,
									 "gender":profile.gender, "locale":response.locale, "picture":response.data.url, 
									 "accessToken":accessToken, "signedRequest":"--", "expiresIn":"--" },
									function(json) {
										if (json.r == "ok") {
											App1000.completed_connected(userID, json.m, json.d);
										} else if(json.c == 4) {
											App1000.need_passwd();
										}
										else {
											App1000.handle_error(json.m);
										}
									});
							}
						});
					}
				});
			}
		});
	},
	
	completed_connected:function(userID, msg, forwarding_url) {
		
		if ( forwarding_url == null || forwarding_url == "" || typeof forwarding_url == "undefined"
			|| forwarding_url == "/main/login"
			|| forwarding_url == "/main/signup" ) {

			forwarding_url = "/";
		}
		
		try {
			if (app.callback != null) { 
				app.callback(userID, msg, forwarding_url);
			}	
		}
		catch(e) {
			app.handle_error("알수 없는 에러가 발생했습니다(990)");	
		}
		
	},

	handle_error:function(msg) {
		alert(msg);
	},
	
	//비밀번호 설정
	need_passwd:function() {
		location.href="/main/set_passwd";
	}
};
