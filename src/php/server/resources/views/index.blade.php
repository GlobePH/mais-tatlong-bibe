@extends('layouts.bootstrap')
@section('content')
<div class='container'>
	<div id='map' style='height:800px;width:800px;'>[MAP HERE]</div>
	<div id='weather'></div>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwGGsFldVXHFbIyIC42E2Zo5MQPE1y-EA&callback=init" async defer></script>
	<script type='text/javascript'>
	var init = function() {
		var markers = [];	
		var map = new google.maps.Map(document.getElementById('map'), {
		  	//center: {lat: 14.6091, lng: 121.0223},
		  	center: {lat: 12.8797, lng: 121.7740},
		  	//center: {lat: 121.7740, lng: 12.8797},
		  	zoom: 7
		});

		google.maps.event.addListener(map, 'idle', function() {
	        //alert(map.getBounds());
	        var bb = map.getBounds();
	        var ne = bb.getNorthEast(); // top-left 
	        var sw = bb.getSouthWest(); // bottom-right
	        //console.log(bb);
	        //console.log("min lat:" + ne.lat());
	        //console.log("max lat:" + sw.lat());
	        //console.log("min lng:" + sw.lng());
	        //console.log("max lng:" + ne.lng());

	        //$.get('/api/weather', {'bounds': [ne.lng, ne.lat() - sw.lat(), sw.lng, sw.lat() + ne.lat()]}, function(response) {
	        $.get('/api/weather', {'bounds': [sw.lng(), ne.lat(), ne.lng(), sw.lat(), map.getZoom()]}, function(response) {
	        	//return;
	        	//console.debug(response);
	        	//$('#weather').html(response);
	        	$.each(markers, function(i, marker) { marker.setMap(null); });
	        	$.each(response.list, function(i, n) {
	        		//console.debug(n);
	        		var latlng  = new google.maps.LatLng(n.coord.lat, n.coord.lon);
	        		markers.push(new google.maps.Marker({
	        			position: latlng, title: n.name, 
	        			map: map,
	        			icon: 'http://openweathermap.org/img/w/' + n.weather[0].icon + '.png'
	        		}));
	        	});
	        }, 'json');

	    });
	}
	//google.maps.event.addDomListener(window, 'load', init);
	</script>
</div>
@endsection