<?php
function list_entries(array $facilities,$list_entries)
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
		echo "<td>{$facilities[$facility_id]->address}</td>";
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

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2 style="color:#337ab7;">Wo gibt es Spenden, die wir benötigen?</h2>
        </div>
        <div class="col-sm-3">
            <button type="button" class="btn btn-primary btn-lg btn-lg" style="width: 100%;"> <i class="fa fa-print"></i> Ausdrucken</button>
        </div>
    </div>
</div>
  
<div class="row">
    <div class="col-sm-12 text-left">
      <p>Diese Hilfsgruppen brauchen noch spenden, die ihr zuviel habt!</p>
        <table class="table">
            <thead>
            <tr>
                <th><h4>Hilfsgruppe</h4></th>
                <th><h4>Ueberschuss</h4></th>
				<th><h4>Telefon</h4></th>
				<th><h4>Adresse</h4></th>
            </tr>
            </thead>
            <tbody>
            <?php list_entries($facilities,$demand) ?>
            </tbody>
        </table>
    </div>
  </div>


<hr>


<!-- lower row -->
  <div class="row">
    <div class="col-sm-12 text-left">
      <h2 style="color:#337ab7;">Wer braucht etwas, das ich habe?</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 text-left">
      <p>Diese Hilfsgruppen brauchen noch spenden, die ihr zuviel habt!</p>
        <table class="table">
            <thead>
            <tr>
                <th>Hilfsgruppe</th>
                <th>Ueberschuss</th>
				<th>Telefon</th>
				<th>Adresse</th>
            </tr>
            </thead>
            <tbody>
            <?php list_entries($facilities,$offers) ?>
            </tbody>
        </table>
    </div>
  </div>

</div>
