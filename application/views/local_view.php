<div class="container">

  <!-- alert panel -->
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <div class="alert alert-danger text-center" style="margin: 50px 0px;" role="alert">
        <b>Hey Name!</b> Deine Bedarfsliste wurde das letzte mal am dd.mm.yyyy geupdatet.
      </div>
    </div>
  </div>

  <!-- local contact -->
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title text-center">Moabit Hilft!</h3>
    </div>
    <div class="panel-body text-center">
      <div class="row">
        <div class="col-sm-12">
          <h4><b>Adresse:</b> Testadresse 127</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h4><b>Mail:</b> mail@test.com</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h4><b>Telefon:</b> 030 / 217 27 63</h4>
        </div>
      </div>
    </div>
  </div>

  <!-- table -->
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-hover text-center">
      <thead>
        <tr>
          <th class="th-green">Spende</th>
          <th class="th-green">Wird gebraucht</th>
          <th class="th-green">Nicht gebraucht</th>
          <th class="th-green">Zu viel</th>
          <th class="th-green">Anzahl vorhanden (optional)</th>
          <th class="th-green">Kommentar (optional)</th>
        </tr>
      </thead>
      <tbody>

      <?php
        foreach ($stocklist as $category) {
          foreach ($category['entries'] as $entry) {
              $selected = $entry['demand'];
            ?>
              <tr>
                <th><?=$entry['name']?></th>
                <td>
                  <div class="radio">
                    <label><input <?php if($selected=='-1'){echo 'selected="selected"';};?> type="radio" name="val[<?=$entry['stock_list_entry_id']?>]"></label>
                  </div>
                </td>
                <td>
                  <div class="radio" >
                    <label><input <?php if($selected=='0'){echo 'selected="selected"';};?> type="radio" name="val[<?=$entry['stock_list_entry_id']?>]" checked></label>
                  </div>
                </td>
                <td>
                  <div classin="radio" >
                    <label><input <?php if($selected=='1'){echo 'selected="selected"';};?> type="radio" name="val[<?=$entry['stock_list_entry_id']?>]"></label>
                  </div>
                </td>
                <td>
                  <div class="input-group" style="max-width:150px;">
                    <input type="number" class="form-control" placeholder="10">
                    <div class="input-group-addon">Stück</div>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" class="form-control" id="usr">
                  </div>
                </td>
              </tr>
        <?php
          }
        }
      ?>
      </tbody>
    </table>
    </div>
  </div>
</div>