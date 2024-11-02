// write cookie
function AionianBible_writeCookie(cname, cvalue) {
	var date = new Date();
	date.setTime(date.getTime() + (1000 * 24 * 60 * 60 * 1000));
	document.cookie = cname + "=" + cvalue + ";expires=" + date.toUTCString() + ";SameSite=Strict;path=/";
}
// read cookie
function AionianBible_readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(";");
	for (var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (" "==c.charAt(0)) {
			c = c.substring(1,c.length);
		}
		if (0==c.indexOf(nameEQ)) {
			return c.substring(nameEQ.length,c.length);
		}
	}
	return null;
}
// globals assigned onload, used onclick
var AB_Bookmark = null;
var AB_Bookmark2 = null;
var AB_Accessible = null;
// onload assign globals, write bookmark cookie
window.onload = function() {
	AB_Bookmark = window.location.pathname.replace(/^\/+|\/+$/g,"");
	if (null!==AB_Bookmark && 0===AB_Bookmark.indexOf("Bibles/",0)) {
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark);
	}
	else {
		AB_Bookmark = AionianBible_readCookie("AionianBible.Bookmark");
	}
	AB_Bookmark2 = AionianBible_readCookie("AionianBible.Bookmark2");
	AB_Accessible = document.getElementById("body");
	if (null!==AB_Accessible) {
		AB_Accessible.className = AionianBible_readCookie("AionianBible.Accessible");
	}
	if (true===AB_Collapse) {
		AionianBible_CollapseExpand("ab-lexicon", null);
	}
}
// set and get
function AionianBible_Set() {
	AB_Bookmark2 = window.location.pathname.replace(/^\/+|\/+$/g,"");
	if (null!==AB_Bookmark2) {
		AionianBible_writeCookie("AionianBible.Bookmark2", AB_Bookmark2);
	}
	return false;
}
function AionianBible_Get() {
	if (null!==AB_Bookmark2) {
		window.location.assign("/"+AB_Bookmark2);
	}
	return false;
}
// toggle accessibility
function AionianBible_Accessible() {
	if (null!==AB_Accessible) {
		if ("larger"==AB_Accessible.className) {
			AB_Accessible.className = "";
			AionianBible_writeCookie("AionianBible.Accessible", "");
		}
		else if ("large"!=AB_Accessible.className) {
			AB_Accessible.className = "large";
			AionianBible_writeCookie("AionianBible.Accessible", "large");
		}
		else {
			AB_Accessible.className = "larger";
			AionianBible_writeCookie("AionianBible.Accessible", "larger");
		}
	}
	return false;
}
// goto bookmark
function AionianBible_Bookmark(default_goto) {
	if (null===AB_Bookmark) {
		if (default_goto) {
			window.location.assign(default_goto);
		}
		else {
			return true;
		}
	}
	else {
		window.location.assign("/"+AB_Bookmark);
	}
	return false;
}
// goto mark with bookmark components
function AionianBible_Makemark(default_goto, plus_goto) {
	if (null===AB_Bookmark) {
		return true;
	}
	var search = AB_Bookmark.split("/",2);
	if (null===search || 2>search.length || 0>search[1].length) {
		return true;
	}
	var bible = search[1];
	var parallel = AB_Bookmark.match(/\/parallel-[a-zA-Z0-9-]+/);
	if (null===parallel) {
		var parallel = "";
	}
	if ("undefined"===typeof plus_goto) {
		var plus_goto = "";
	}
	window.location.assign(default_goto+"/"+bible+parallel+plus_goto);
	return false;
}
function ABMM(default_goto, plus_goto) { return AionianBible_Makemark(default_goto, plus_goto); }
// swipe detect from http://www.javascriptkit.com/javatutors/touchevents2.shtml
function AionianBible_SwipeListener(handleswipe) {
	var swipedir, startX, startY, distX, distY, elapsedTime, startTime;
	document.body.addEventListener('touchstart', function(e) {
		var touchobj = e.changedTouches[0];
		swipedir = 'none';
		startX = touchobj.pageX;
		startY = touchobj.pageY;
		startTime = new Date().getTime(); // first contact
	}, false);
	document.body.addEventListener('touchend', function(e){
		var touchobj = e.changedTouches[0];
		distX = touchobj.pageX - startX; // horizontal distance
		distY = touchobj.pageY - startY; // vertical distance
		elapsedTime = new Date().getTime() - startTime; // time elapsed
		if (elapsedTime <= 300 && Math.abs(distX) >= 150 && Math.abs(distY) <= 100) { // time? horizontal? vertical?
			swipedir = (distX < 0)? 'left' : 'right'; // negative if left swipe, otherwise right
		}
		handleswipe(swipedir);
	}, false);
}
function AionianBible_SwipeLinks(prev, next) {
	window.addEventListener('load', function() {
		AionianBible_SwipeListener(function(swipedir) {
			if (swipedir == 'right') {
				window.location.assign((prev ? prev : '/Read'));
			}
			else if (swipedir == 'left') {
				window.location.assign((next ? next : (AB_Bookmark ? '/'+AB_Bookmark : '/Read')));
			}
		} );
	}, false);
}
// Collapse Class and Expand ID, https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
function AionianBible_CollapseExpand(collapse, toggle) {
	var elements = document.getElementsByClassName(collapse);
	var firstdisplay = (elements.length > 0 ? elements[0].style.display : 'block');
	for (var i = 0; i < elements.length; i++) {
		if (elements[i].id === toggle) {
			if ('none' === elements[i].style.display) {
				elements[i].style.display = 'block';
			}
			else {
				elements[i].style.display = 'none';
			}
		}
		else if (null===toggle && firstdisplay=='none') {
			elements[i].style.display = 'block';
		}
		else {
			elements[i].style.display = 'none';
		}
	}
}
// recycle captcha, https://www.allphptricks.com/create-a-simple-captcha-script-using-php/
function AionianBible_RefreshCaptcha() {
    var img = document.images['2captcha_image'];	img.src = img.src.substring(0,img.src.lastIndexOf("/"))+"/2"+"l23"+Math.floor(Math.random() * 10000000000);
    var img = document.images['3captcha_image'];	img.src = img.src.substring(0,img.src.lastIndexOf("/"))+"/3"+"l23"+Math.floor(Math.random() * 10000000000);
}
