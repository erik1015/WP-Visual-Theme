function callPlayer(frame_id, func, args) {
	if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
	var iframe = document.getElementById(frame_id);
	if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
		iframe = iframe.getElementsByTagName('iframe')[0];
	}

	// When the player is not ready yet, add the event to a queue
	// Each frame_id is associated with an own queue.
	// Each queue has three possible states:
	//  undefined = uninitialised / array = queue / 0 = ready
	if (!callPlayer.queue) callPlayer.queue = {};
	var queue = callPlayer.queue[frame_id],
		domReady = document.readyState == 'complete';

	if (domReady && !iframe) {
		// DOM is ready and iframe does not exist. Log a message
		window.console && console.log('callPlayer: Frame not found; id=' + frame_id);	
		if (queue) clearInterval(queue.poller);
	} else if (func === 'listening') {
		// Sending the "listener" message to the frame, to request status updates	
		if (iframe && iframe.contentWindow) {
			func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
			iframe.contentWindow.postMessage(func, '*');
		}
	} else if (!domReady || iframe && (!iframe.contentWindow || queue && !queue.ready)) {
		if (!queue) queue = callPlayer.queue[frame_id] = [];
		queue.push([func, args]);
		if (!('poller' in queue)) {
			// keep polling until the document and frame is ready
			queue.poller = setInterval(function() {
				callPlayer(frame_id, 'listening');
			}, 250);
			// Add a global "message" event listener, to catch status updates:
			messageEvent(1, function runOnceReady(e) {
				var tmp = JSON.parse(e.data);
				if (tmp && tmp.id == frame_id && tmp.event == 'onReady') {
					// YT Player says that they're ready, so mark the player as ready
					clearInterval(queue.poller);
					queue.ready = true;
					messageEvent(0, runOnceReady);
					// .. and release the queue:
					while (tmp = queue.shift()) {
						callPlayer(frame_id, tmp[0], tmp[1]);
					}
				}
			}, false);
		}
	} else if (iframe && iframe.contentWindow) {
		// When a function is supplied, just call it (like "onYouTubePlayerReady")
		if (func.call) return func();
		// Frame exists, send message
		iframe.contentWindow.postMessage(JSON.stringify({
			"event": "command",
			"func": func,
			"args": args || [],
			"id": frame_id
		}), "*");
	}

	/* IE8 does not support addEventListener... */
	function messageEvent(add, listener) {
		var w3 = add ? window.addEventListener : window.removeEventListener;	
		w3 ?
			w3('message', listener, !1)
		:
			(add ? window.attachEvent : window.detachEvent)('onmessage', listener);
	}

}

jQuery(window).load(function() {

	var vimeoPlayers = jQuery('.flexslider').find('iframe'), player;
	
	for (var i = 0, length = vimeoPlayers.length; i < length; i++) { 		    
		player = vimeoPlayers[i]; 		    
		$f(player).addEvent('ready', ready); 		
	}
	
	function addEvent(element, eventName, callback) { 	    	
		if (element.addEventListener) { 		    	
			element.addEventListener(eventName, callback, false) 		    
		} else { 	      		
			element.attachEvent(eventName, callback, false); 	      	
		} 	    
	}
	
	function ready(player_id) { 	    	
		var froogaloop = $f(player_id); 	    	
	}

	// NARROW FEATURED CONTENT SLIDER
	jQuery('#featured').flexslider({
		animation:'slide',
		directionNav:true,
		pauseOnHover:true,
		animationLoop:true,
		slideshow: true,
		slideshowSpeed: 7000,
		useCSS:false,
		smoothHeight:true,
		controlsContainer: '.narrow-slider',
		before: function(slider) {         
			if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0)
				$f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
			if (slider.slides.eq(slider.currentSlide).find('iframe[src*="youtube"]').length !== 0)
				callPlayer(slider.slides.eq(slider.currentSlide).find('iframe[src*="youtube"]').attr('id'), 'pauseVideo');
		}
	});


	// FEATURED PAGES SLIDER
	jQuery('#featured-pages').flexslider({
		animation:'slide',
		animationLoop:true,
		useCSS:false,
		slideshow: true,
		slideshowSpeed: 7000,
		smoothHeight:true,
		directionNav:true,
		pauseOnHover:true,
		controlNav: "thumbnails", 
		controlsContainer: '.pages-slider',
		before: function(slider) {         
			if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0)
				$f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
			if (slider.slides.eq(slider.currentSlide).find('iframe[src*="youtube"]').length !== 0)
				callPlayer(slider.slides.eq(slider.currentSlide).find('iframe[src*="youtube"]').attr('id'), 'pauseVideo');
		}
	});

	jQuery('.youtube-page-custom-controls li').bind("click touchend", function(){
		location.href="#featured-yt-vids-page";
	});

	jQuery('.clone').find('iframe').each(function(i, e){
		jQuery(e).attr('id', jQuery(e).attr('id') + '_clone');
	});

});