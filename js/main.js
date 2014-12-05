// JavaScript Document
$(document).ready(function(){
	$('div.navbar i, footer i').fadeTo(0, 0.5);
	$('div.navbar-inverse ul.nav a').tooltip({
		placement : 'bottom',
		delay: { show: 700, hide: 400 }
	})
})