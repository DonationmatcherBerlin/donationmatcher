<?php
function list_entries(array $facilities)
{
  foreach ($facilities as $facility => $entry) {
    echo '<tr>';
    echo '<td>'.$entry["name"].'</td>';
	echo '<td>Bedarfsliste.</td>';
    echo '<td>Spenden zuviel</td>';
    echo '<td>Spenden benötigt.</td>';
	echo '<td>'.$entry["phone"].'</td>';
    echo '<td>'.$entry["address"].' '.$entry["zip"].' '. $entry["city"].'</td>';
    echo '</tr>';
  }
}
?>

<head>
  <style>
    #map {
      height: 400px;
    }
  </style>
</head>

<body>


<div class="container" style="min-height:800px">
<h2 class="headline">Liste der Hilfsgruppen in Berlin</h2>
<div class="row">
		<div class="col-sm-12 text-left">
			<div class="table-responsive">
				<table class="table table-striped table-condensed">
					<thead>
						<tr>
							<th>Hilfsgruppenname</th>
							<th>Bedarfsliste</th>
							<th>Spenden zuviel</th>
							<th>Spenden benötigt</th>
							<th>Telefon</th>
							<th>Adresse</th>
						</tr>
					</thead>
					<tbody>
		
						<?php list_entries($facilities)?>

					</tbody>
				</table>
			</div>
  		</div>
	</div>
<div class="col-sm-12 text-left" style="min-height: 450px; margin-top: 20px;">
    <div id="map">
    <script>

        function initMap() {
            var facilities = <?= json_encode($facilities); ?>;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: 52.515830, lng: 13.414600}
            });

            $.each(facilities, function(idx, facility) {
                var marker = new google.maps.Marker({
                    position: { lat: facility.lat, lng: facility.lon },
                    map: map,
                    url: facility.url,
                    title: facility.name,
                });

                google.maps.event.addListener(marker, 'click', function() {
                    window.location.href = this.url;  //changed from markers[i] to this
                });
            });
        }

    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ1d7DryuY_ypyZ-NIZvwla-XfJ9EiTmE&signed_in=true&callback=initMap"></script>
	</div>
	</div>
</div> <!-- container -->