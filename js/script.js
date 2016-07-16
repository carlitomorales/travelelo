$(function(){
	
	var note = $('#note');
	var d = new Date();
	var n = d.getSeconds();
	ts = (new Date()).getTime() + 30*1000;
		newYear = false;
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(seconds){
			var message = "";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
		}
	});
	
});
