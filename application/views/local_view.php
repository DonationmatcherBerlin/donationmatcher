<div class="container">
  <?php echo form_open(); ?>
    <!-- alert panel -->
    <!--
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
      
        <div class="alert alert-danger text-center" style="margin: 50px 0px;" role="alert">
          <b>Hey Name!</b> Deine Bedarfsliste wurde das letzte mal am geupdatet.
        </div>
        
      </div>
    </div>
    -->

    <!-- local contact -->
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title text-center"><?=$facility->name?></h3>
      </div>
      <div class="panel-body text-center">
        <div class="row">
          <div class="col-sm-12">
            <h4><b>Adresse:</b> <?=$facility->address?></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <h4><b>Mail:</b> <?=$facility->email?></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <h4><b>Telefon:</b> <?=$facility->phone?></h4>
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
                $checked = $entry['demand'];
              ?>
                <tr>
                  <th><?=$entry['name']?></th>
                  <td>
                    <div class="radio">
                      <label><input <?php if($checked=='-1'){echo 'checked="checked"';};?> value="-1" type="radio" name="demand[<?=$category['category_id']?>]"></label>
                    </div>
                  </td>
                  <td>
                    <div class="radio" >
                      <label><input <?php if($checked=='0'){echo 'checked="checked"';};?> value="0" type="radio" name="demand[<?=$category['category_id']?>]"></label>
                    </div>
                  </td>
                  <td>
                    <div classin="radio" >
                      <label><input <?php if($checked=='1'){echo 'checked="checked"';};?> value="1" type="radio" name="demand[<?=$category['category_id']?>]"></label>
                    </div>
                  </td>
                  <td>
                    <div class="input-group" style="max-width:150px;">
                      <input value="<?=$entry['count']?>" name="count[<?=$category['category_id']?>]" type="number" class="form-control" placeholder="10">
                      <div class="input-group-addon">Stück</div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?=$entry['comment']?>" name="comment[<?=$category['category_id']?>]">
                    </div>
                  </td>
                </tr>
          <?php
            }
          }
        ?>

        <tr>
          <th>Aktion</th>
          <td colspan="5">
            <div class="form-group">
              <input type="submit" class="form-control btn btn-primary" value="Speichern" >
            </div>
          </td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
  </form>
</div>