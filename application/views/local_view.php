<div class="container">

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
        
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-hover text-center">
        <thead>
          <tr>
            <th class="th-green">Bezeichnung</th>
            <th class="th-green">Bedarf</th>
            <th class="th-green">OK</th>
            <th class="th-green">Überschuss</th>
            <th class="th-green">Anzahl vorhanden (optional)</th>
            <th class="th-green">Kommentar (optional)</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($entries as $category) : ?>
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