  <head>
    <style>
      #map {
        height: 250px;
      }
    </style>
  </head>
<body>

<div class="container">
	<div class="row doYouNeed">
		<div class="col-sm-6 text-right">
			<h2>Braucht ihr eigentlich noch <h2>
		</div>
		<div class="col-sm-3 text-left">
			<div class="form-group">
			  <label for="sel1"></label>
			  <select class="form-control" id="sel1">
			  	<option>...?</option>
			    <option>Schuhe</option>
			    <option>Katzen</option>
			    <option>Oder</option>
			    <option>So</option>
			  </select>
			</div>
		</div>
	</div>

	<hr>

	<!-- TABLE -->
	<h2 class="headline">Das brauchen wir am meisten.</h2>
    <table class="table table-bordered table-striped responsive-utilities topTentable">
      <thead>
        <tr>
          <th>
            <i class="fa fa-trophy"></i> Top 10
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



<hr>


<h2 class="headline">Hier der gesamte Bedarfsplan von Berlin</h2>
<div class="table-responsive">
    <table class="table table-bordered table-striped responsive-utilities">
      <thead>
        <tr>
          <th></th>
          <th>
            Extra small devices
            <small>Phones (&lt;768px)</small>
          </th>
          <th>
            Small devices
            <small>Tablets (≥768px)</small>
          </th>
          <th>
            Medium devices
            <small>Desktops (≥992px)</small>
          </th>
          <th>
            Large devices
            <small>Desktops (≥1200px)</small>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><code>.visible-xs-*</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
        </tr>
        <tr>
          <th scope="row"><code>.visible-sm-*</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
        </tr>
        <tr>
          <th scope="row"><code>.visible-md-*</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
        </tr>
        <tr>
          <th scope="row"><code>.visible-lg-*</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <th scope="row"><code>.hidden-xs</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
        </tr>
        <tr>
          <th scope="row"><code>.hidden-sm</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
        </tr>
        <tr>
          <th scope="row"><code>.hidden-md</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
        </tr>
        <tr>
          <th scope="row"><code>.hidden-lg</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
        </tr>
      </tbody>
    </table>
  </div>
    <div id="map"></div>
    <script>

function initMap() {
	//data from DB
	var addresses = [
    'Hauptstr.1 Berlin 10823 Germany',
    'Turmstr.1 Berlin Germany',
    'Eisenacherstr.1 Berlin 10777 Germany',
	'Hauptstr.20 Berlin 10823 Germany',
    'Turmstr.20 Berlin Germany',
    'Eisenacherstr.70 Berlin 10777 Germany',
	'Hauptstr.30 Berlin 10823 Germany',
    'Turmstr.30 Berlin Germany',
    'Eisenacherstr.30 Berlin 10777 Germany',
	'Hauptstr.40 Berlin 10823 Germany',
	'Hauptstr.70 Berlin 10823 Germany' //needed format zipcode important because of double street entries
	];	
	//build new map
	var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 11,
    center: {lat: 52.493830, lng: 13.423598}
	});		  
	var myFunctions = [];
			function geo(i){
				var geocoder = new google.maps.Geocoder();//new geocoder (needed to get geolocation)
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
			
			for (var i = 0; i < addresses.length; i++) {
				myFunctions[i] = geo(i);
			}
			
			for (var j = 0; j < addresses.length; j++) {
				alert(addresses.length);
				myFunctions[j]();    // and now let's run each one to see

			}

			

}
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ1d7DryuY_ypyZ-NIZvwla-XfJ9EiTmE&signed_in=true&callback=initMap"></script>

</div> <!-- container -->