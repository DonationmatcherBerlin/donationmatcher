<div class="container">
  <?php echo form_open(); ?>

    <!-- local contact -->
    <div class="row" style="margin: 50px 0;">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="text-center"><?=$facility->name?></h3>
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
            <div class="row">
              <div class="col-sm-12">
                <h4 style="color: #558ED8; margin-top: 30px;"><b>Letztes Update der Bedarfsliste:</b> TODO<!-- TODO: Backend, Date wann das letzte Mal geupdatet wurde --></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- table -->
    <div class="row" style="margin-bottom: 30px;">
      <div class="col-sm-12 text-center" >
        <h2>Bearbeitung Ihrer lokalen Bedarfsliste</h2>
        <p style="color: #558ED8; text-align: center;">Sie müssen Änderungen unten mit dem Knopf "Speichern" bestätigen.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-hover text-center">
        <thead>
          <tr>
            <th>Bezeichnung</th>
            <th>Bedarf</th>
            <th>OK</th>
            <th>Überschuss</th>
            <th>Anzahl vorhanden (optional)</th>
            <th>Kommentar (optional)</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($stocklist as $category) : ?>
            <tr>
                <td colspan="6">
                    <h3 style="text-align: left"><?= $category['name'] ?></h3>
                </td>
            </tr>
            <?php foreach ($category['entries'] as $entry) : ?>
                <?php $checked = $entry['demand']; ?>
                <tr>
                    <th><?=$entry['name']?></th>
                    <td>
                        <div class="radio">
                            <label><input <?php if($checked=='-1'){echo 'checked="checked"';};?> value="-1" type="radio" name="demand[<?=$entry['stock_list_entry_id']?>]"></label>
                        </div>
                    </td>
                    <td>
                        <div class="radio" >
                            <label><input <?php if($checked=='0'){echo 'checked="checked"';};?> value="0" type="radio" name="demand[<?=$entry['stock_list_entry_id']?>]"></label>
                        </div>
                    </td>
                    <td>
                        <div class="radio" >
                            <label><input <?php if($checked=='1'){echo 'checked="checked"';};?> value="1" type="radio" name="demand[<?=$entry['stock_list_entry_id']?>]"></label>
                        </div>
                    </td>
                    <td>
                        <div class="input-group" style="max-width:150px;">
                            <input value="<?=$entry['count']?>" name="count[<?=$entry['stock_list_entry_id']?>]" type="number" class="form-control" placeholder="(optional)">
                            <div class="input-group-addon">Stück</div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea type="text" class="form-control" value="<?=$entry['comment']?>" name="comment[<?=$entry['stock_list_entry_id']?>]" style="max-width: 200px; min-width: 100px;"></textarea>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <tr>
          <td colspan="6">
              <input type="submit" class="btn btn-success btn-lg btn-block" value="Speichern" style="margin-top: 20px;">
          </td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
  </form>
</div>