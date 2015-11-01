<?php
function list_entries(array $facilities, $list_entries)
{
    // group by facility id
    $group = [];
    foreach ($list_entries as $entry) {
        $group[$entry['facility_id']][] = $entry;
    }

    foreach ($group as $facility_id => $entries) {
        echo "<tr>";
        echo "<td>{$facilities[$facility_id]->name}</td>";
        echo "<td>" . implode(', ', array_column($entries, 'name')) . "</td>";
        echo "<td>{$facilities[$facility_id]->phone}</td>";
        echo "</tr>";
    }
}
?>

<div class="container">

<!-- <div class="row" style="margin:20px 0px;">
  <div class="col-sm-4 col-sm-offset-4">
    <button type="button" class="btn btn-success btn-lg" style="width:100%;"> <i class="fa fa-print"></i> Ausdrucken</button>
  </div>
</div> -->


  <div class="row">
    <div class="col-sm-12 text-center">
      <h2 style="color:#337ab7;">Wo gibt es Spenden, die wir benötigen?</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 text-center">
      <p>Diese Hilfsgruppen können Euch dabei helfen Euren Bedarf zu decken.</p>
    </div>
  </div>
  <div class="row">
      <table>
          <thead>
          <tr>
              <th>facility</th>
              <th>demand</th>
              <th>phone</th>
          </tr>
          </thead>
          <tbody>
            <?php list_entries($facilities, $demand) ?>
          </tbody>
      </table>
  </div>


<hr>


<!-- lower row -->
  <div class="row">
    <div class="col-sm-12 text-center">
      <h2 style="color:red;">Wer braucht etwas, das ich habe?</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 pull-left">
      <p>Diese Hilfsgruppen brauchen noch spenden, die ihr zuviel habt!</p>
        <table>
            <thead>
            <tr>
                <th>facility</th>
                <th>demand</th>
            </tr>
            </thead>
            <tbody>
            <?php list_entries($facilities, $offers) ?>
            </tbody>
        </table>
    </div>
  </div>

</div>
