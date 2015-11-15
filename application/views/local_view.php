<div class="container" style="min-height: 100%;">
  <?php echo form_open('/stocklist'); ?>

    <div class="row">
        <div class="col-sm-12 text-center" >
            <h1>Bearbeitung Ihrer lokalen Bedarfsliste</h1>
        </div>
    </div>

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
                <h4><b>E-Mail:</b> <?=$facility->email?></h4>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <h4><b>Telefon:</b> <?=$facility->phone?></h4>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <h4 style="color: #558ED8; margin-top: 30px;"><b>Letztes Update der Bedarfsliste:</b> <?= $stocklist->updated_at ? $stocklist->updated_at->format('d.m.Y H:i') : $stocklist->created_at->format('d.m.Y H:i'); ?> Uhr</h4>
              </div>
            </div>
              <div class="row">
                  <div class="col-sm-12">
                      <p style="color: #558ED8; text-align: center;">Sie müssen Änderungen immer mit dem Knopf "Speichern" bestätigen.</p>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- table -->
    <div class="row" style="margin-top: 20px; margin-bottom: 100px;">
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-12 text-center">
            <a class="btn btn-primary btn-lg btn-lg" href="<?= site_url('stocklist/public_pdf/'.$facility->facility_id);?>" style="min-width: 300px; margin: 35px auto;" target="_blank">Link Bedarfsliste</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center">
            <a class="btn btn-primary btn-lg btn-lg" href="<?= site_url('stocklist/pdf/'.$facility->facility_id); ?>" style="min-width: 300px;" target="_blank">Interne Liste drucken</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <h3>Springe direkt zur Kategorie:</h3>
          <?php foreach(array_column($entries, 'name') as $category) : ?>
            <a href="#cat_<?= $category ?>" class="btn btn-default" style="margin: 5px;"><?= $category ?></a>
          <?php endforeach ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <table class="table table-hover stickytable localTable">
        <thead>
          <tr>
            <th><input type="submit" class="btn btn-success btn-sm" value="Speichern">Bezeichnung</th>
            <th class="text-center">Bedarf</th>
            <th class="text-center">OK</th>
            <th class="text-center">Überschuss</th>
            <th class="text-center responsive-invisibility">Anzahl (optional)</th>
            <th class="text-center responsive-invisibility">Kommentar (optional)</th>
          </tr>
        </thead>
        <tbody class="text-center">
        <?php foreach ($entries as $category) : ?>
            <tr>
                <td colspan="4" id="cat_<?= $category['name'] ?>">
                    <h3 style="text-align: left; text-decoration: underline;"><?= $category['name'] ?></h3>
                </td>
            </tr>
            <?php foreach ($category['entries'] as $entry) : ?>
                <?php $checked = $entry['demand']; ?>
                <tr>
                    <th class="entryname "><?=$entry['name']?></th>
                    <td class="">
                        <div class="radio">
                            <label><input <?php if($checked=='-1'){echo 'checked="checked"';};?> value="-1" type="radio" name="demand[<?=$entry['stock_list_entry_id']?>]"></label>
                        </div>
                    </td>
                    <td class="">
                        <div class="radio" >
                            <label><input <?php if($checked=='0'){echo 'checked="checked"';};?> value="0" type="radio" name="demand[<?=$entry['stock_list_entry_id']?>]"></label>
                        </div>
                    </td>
                    <td class="">
                        <div class="radio" >
                            <label><input <?php if($checked=='1'){echo 'checked="checked"';};?> value="1" type="radio" name="demand[<?=$entry['stock_list_entry_id']?>]"></label>
                        </div>
                    </td>
                    <td class="responsive-invisibility">

                      <div class="input-group" style="max-width:150px; margin-left: 125px;">
                          <input value="<?=$entry['count']?>" name="count[<?=$entry['stock_list_entry_id']?>]" type="number" class="form-control" placeholder="(optional)">
                          <div class="input-group-addon">Stück</div>
                      </div>

                    </td>
                    <td class="responsive-invisibility">
                        <div class="form-group">
                            <textarea class="form-control" name="comment[<?=$entry['stock_list_entry_id']?>]" style="max-width: 275px; min-width: 100px; margin-top: 10px;"><?=$entry['comment']?></textarea>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <tr>
          <td colspan="6">
              <input type="submit" class="btn btn-success btn-lg btn-block" value="Speichern" style="margin: 40px 0px;">
          </td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">

  function showCountInput(id){
    var buttonID = "#" + id;
    $( buttonID ).addClass( "hidden" );

    var inputGroupName = "#inputGroup" + id;
    $(inputGroupName).removeClass('hidden');
  }

  function hideCountInput(id){
    var buttonID = "#" + id;
    $( buttonID ).removeClass( "hidden" );

    var inputGroupName = "#inputGroup" + id;
    $(inputGroupName).addClass('hidden');
  }


</script>