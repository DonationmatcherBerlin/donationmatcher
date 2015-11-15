<?php
function list_entries(array $facilities)
{
  foreach ($facilities as $facility => $entry) {
    echo '<tr>';
    echo '<td></td>';
    echo '<td>'.$entry["name"].'</td>';
    echo '<td>'.$entry["url"].'</td>';
    echo '<td>usw.</td>';
    echo '<td>usw.</td>';
    echo '</tr>';
  }
}
?>

<h2 class="headline">Liste der Hilfsgruppen in Berlin</h2>
<div class="table-responsive">
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th></th>
          <th>Hilfsgruppenname</th>
          <th>Bedarfsliste</th>
          <th>Spendenzuviel</th>
          <th>Spenden benötigt</th>
          <th>Telefon</th>
          <th>Adresse</th>
        </tr>
      </thead>
      <tbody>

        <?php list_entries($facilities)?>

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
            var facilities = <?= json_encode($facilities); ?>;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: 52.493830, lng: 13.423598}
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

</div> <!-- container -->