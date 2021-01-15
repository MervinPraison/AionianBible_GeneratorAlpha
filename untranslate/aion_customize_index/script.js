// write cookie
function AionianBible_writeCookie(cname, cvalue) {
	var date = new Date();
	date.setTime(date.getTime() + (1000 * 24 * 60 * 60 * 1000));
	document.cookie = cname + "=" + cvalue + ";expires=" + date.toUTCString() + ";path=/";
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
	AB_Accessible = document.getElementById("body");
	if (null!==AB_Accessible) {
		AB_Accessible.className = AionianBible_readCookie("AionianBible.Accessible");
	}
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
