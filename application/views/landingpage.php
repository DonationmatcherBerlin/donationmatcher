<!-- TODO: Frontend, remove duplicated header! -->
<head>
	<style>
		#map {
			height: 250px;
		}
	</style>
</head>

<div class="container" style="margin-top: 25px;">

	<div class="row">
		<div class="col-sm-6">

			<div class="row doYouNeed">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2>Braucht ihr noch:<h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="form-group">
							<label for="sel1"></label>
							<select class="form-control" id="sel1">
								<!-- TODO:  Backend, Kategorienabfrage  -->
								<option>Bitte Kategorie wählen</option>
								<option>Schuhe</option>
								<option>Katzen</option>
								<option>Oder</option>
								<option>So</option>
							</select>
						</div>
					</div>
				</div>
			</div>  <!-- /doYouNeedRow -->

			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">

				<!-- TODO: Backend, Antwort auf do you need dynamisch einblenden -->
					<div class="alert alert-success text-center" role="alert">
						<p>Ja, brauchen wir noch.</p>
					</div>
					<div class="alert alert-warning text-center" role="alert">
						<p>Brauchen wir nicht mehr.</p>
					</div>

				</div>
			</div>
		</div> <!-- /col-sm-6 -->

		<div class="col-sm-6">
			<!-- TABLE -->
			<table class="table table-bordered table-striped responsive-utilities topTentable">
				<thead>
					<tr>
						<th class="text-center">
							<h3>Das brauchen wir am meisten:</h3>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Kleidung</td>
					</tr>
					<tr>
						<td>Schuhe</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
					<tr>
						<td>Katzen</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<hr style="margin: 50px 0px;">

	<!-- TODO: Frontend, correct Map -->
	<!-- TODO: Backend, addresses for map -->
	<h2 class="headline text-center">Hier befinden sich alle Unterkünfte</h2>
	<div id="map"></div>

</div> <!-- container -->

		<script>

function initMap() {
	//data from DB
	var addresses = [
		'Hauptstr.13 Berlin Germany',
		'Turmstr.13 Berlin Germany',
		'Eisenacherstr.13 Berlin 10777 Germany' //needed format zipcode important because of double street entries
	];	
	//build new map
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 11,
		center: {lat: 52.493830, lng: 13.423598}
	});
		for (i = 0; i < addresses.length; i++) {
			
		var geocoder = new google.maps.Geocoder();     //new geocoder (needed to get geolocation)
		var address = addresses[i];			 

			geocoder.geocode( { 'address': address }, function(results, status) { //get the geocode
			if ( status == google.maps.GeocoderStatus.OK ){
				var marker = new google.maps.Marker( { 		//build new marker
				position: results[0].geometry.location,     //comes from geocoder
				map: map,      
				title: address
			});
				var contentString = "";			//info which will be shown by click
				var infowindow = new google.maps.InfoWindow( { content: contentString } );
				
				google.maps.event.addListener( marker, 'click', function() { infowindow.open( map, marker ); }); 
				} 
				else     
				alert("Geocode was not successful for the following reason: " + status);        
		});
		}
}

		</script>

		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ1d7DryuY_ypyZ-NIZvwla-XfJ9EiTmE&signed_in=true&callback=initMap"></script>