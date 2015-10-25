  <head>
    <style>
      #map {
        height: 250px;
      }
    </style>
  </head>
<body>

<h2 class="headline">Liste der Hilfsgruppen in Berlin</h2>
<div class="table-responsive">
    <table class="table table-bordered table-striped responsive-utilities">
      <thead>
        <tr>
          <th></th>
          <th>
            Hilfsgruppenname
          </th>
          <th>
            Bedarfsliste
          </th>
          <th>
           Spendenzuviel
          </th>
          <th>
            Spenden benötigt
          </th>
		  <th>
            Telefon
          </th>
		  <th>
            Adresse
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
    </table>
  </div>
    <div id="map"></div>
    <script>

function initMap() {
	var LocationLat = [
    52.5196530,
    52.493830,
    52.4938300
	];	
	var LocationLng = [
    13.3728780,
    13.423123,
    13.999945
	];	
	var Organisation = [
    'www.google.de',
    'www.facebook.de',
    'www.youtube.de'
	];
	var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 11,
    center: {lat: 52.493830, lng: 13.423598}
	});
	  for (i = 0; i < LocationLat.length; i++) {
	    var myLatLng = {lat: LocationLat[i], lng: LocationLng[i]};
		var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		url: Organisation[i],
		title: 'Hello World!',
		});
		google.maps.event.addListener(marker, 'click', function() {
		window.location.href = this.url;  //changed from markers[i] to this
    });
	  }
}

    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ1d7DryuY_ypyZ-NIZvwla-XfJ9EiTmE&signed_in=true&callback=initMap"></script>

</div> <!-- container -->