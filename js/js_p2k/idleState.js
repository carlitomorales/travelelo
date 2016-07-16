var idleTime	= 120000;
var logoutTime  = 660000;
var timeOut		= '';
var timeOut2    = '';
var tipe        = 1;

function init() {
	if(tipe==1){
		Event.observe(document.body, 'mousemove', resetIdle, true);
		Event.observe(document.body, 'keydown', resetIdle, true);
		setIdle();
	}
}

function onIdleFunction(t){
	if(t==1){
		
		Lightview.show({
			href: 'images/HR-FasT.jpg',
			rel: 'image',
			title: 'HR FasT - Idle Screen - Tanpa Aktifitas > '+(idleTime/1000)+' detik',
			caption: '<hr>Untuk Keamanan Data Ada,<br>Lakukan Logout sebelum meninggalkan Komputer/PC Anda.',
			options: {
				topclose: false,
				width: 300,	
				height: 300				
			}
		});	
		//callPrompt();
	}else if(t==2){
		alert("Anda Telah Logout Otomatis karena tidak ada aktifitas pada HR FasT selama > "+((logoutTime-idleTime)/60000)+" menit.");
		window.location.href="?op=logout&sys=1";
	}
}

function resetIdle(){	
	//Lightview.hide('divIdle');
	window.clearTimeout( timeOut );
	window.clearTimeout( timeOut2 );
	setIdle();	
}

function setIdle(){
	
	timeOut = window.setTimeout( "onIdleFunction(1)", idleTime );
	timeOut2 = window.setTimeout( "onIdleFunction(2)", logoutTime );
	
}

Event.observe(window, 'load', init, false);