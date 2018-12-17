(function(){
	var video = document.getElementById('video'),
		vendorURL = window.URL || window.webkitURL;
		
	navigator.getMedia = navigator.getUserMedia ||
						navigator.webkitGetUserMedia ||
						navigator.mozGetUserMedia ||
						naviagor.msGetUserMedia;
						
	// capture video
	
	navigator.getMedia({
		video: true,
		audio: false
	}, function(stream){
		video.src = vendorURL.createObjectURL(stream);
		video.play();
	}, function(error){
		// An error occured
		//error.code
	});
	
	
})();