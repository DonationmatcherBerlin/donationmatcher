<?php
function list_entries($list_entries)
{
    foreach ($list_entries as $facility => $categories) {
        echo "<h3>$facility</h3>";
        foreach ($categories as $category => $entries) {
            echo '<div class="pull-left well" style="margin: 10px;">';
            echo "<h4>$category</h4>";
            echo "<ul>";
            foreach ($entries as $name) {
                echo "<li><strong>$name</strong></li>";
            }
            echo "</ul>";
            echo "</div>";
        }
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
    <div class="col-sm-12">
      <?php list_entries($demand) ?>
    </div>
  </div>


<hr>


<!-- lower row -->
  <div class="row">
    <div class="col-sm-12 pull-left">
      <h2 style="color:red;">Wer braucht etwas, das ich habe?</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 pull-left">
      <p>Diese Hilfsgruppen brauchen noch spenden, die ihr zuviel habt!</p>
      <?php list_entries($offers) ?>
    </div>
  </div>

</div>
