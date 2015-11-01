<?php
function list_entries($list_entries)
{
    foreach ($list_entries as $facility => $categories) {
        echo "<tr>";
        echo "<td>$facility</td>";
        echo "<td>" . implode(', ', array_column($categories, 'name')) . "</td>";
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
          </tr>
          </thead>
          <tbody>
            <?php list_entries($demand) ?>
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
            <?php list_entries($offers) ?>
            </tbody>
        </table>
    </div>
  </div>

</div>
