<div class="container" style="min-height: 100%;">
  <?php echo form_open('/stocklist'); ?>

    <!-- local contact -->
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
      </div>
    </div>

    <!-- table -->
    <div class="row">
      <div class="col-sm-12" >
        <h1>Bearbeitung Ihrer lokalen Bedarfsliste:</h1>
        <div class="bg-info">
          <h4><b>Letztes Update der Bedarfsliste:</b> <?= $stocklist->updated_at ? $stocklist->updated_at->format('d.m.Y H:i') : $stocklist->created_at->format('d.m.Y H:i'); ?> Uhr</h4>
        </div>
      </div>
      <div class="col-sm-offset-3 col-sm-9">
        <a class="btn btn-primary btn-lg btn-lg" href="<?= site_url('stocklist/public_pdf/'.$facility->facility_id);?>" style="min-width: 300px; margin: 35px auto;" target="_blank">Link Bedarfsliste</a> 
        <a class="btn btn-primary btn-lg btn-lg" href="<?= site_url('stocklist/pdf/'.$facility->facility_id); ?>" style="min-width: 300px;" target="_blank">Interne Liste drucken</a>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-3" id="leftCol">
        <ul class="nav nav-stacked" id="sidebar">
          <li><input type="submit" class="btn btn-success btn-mini btn-block" value="Speichern"></li>
          <?php foreach($entries as $category) : ?>
            <li><a href="#cat_<?= $category['category_id'] ?>" class="btn btn-default btn-mini btn-block"><?= $category['name'] ?></a></li>
          <?php endforeach ?>
          <li><input type="submit" class="btn btn-success btn-mini btn-block" value="Speichern"></li>
        </ul>
      </div>
      <div class="col-sm-9">
        <table class="table table-hover stickytable localTable">
        <thead>
          <tr>
            <th>Bezeichnung</th>
            <th class="text-center">Bedarf</th>
            <th class="text-center">OK</th>
            <th class="text-center">Überschuss</th>
            <th class="text-center responsive-invisibility">Anzahl (optional)</th>
            <th class="text-center responsive-invisibility">Kommentar (optional)</th>
          </tr>
        </thead>
        <tbody class="text-center" id="demandlist-table">
        <?php foreach ($entries as $category) : ?>

            <tr class="toogleCategory">
                <td colspan="6" id="cat_<?= $category['category_id'] ?>">
                    <h3 style="text-align: left; text-decoration: underline;"><?= $category['name'] ?></h3>
                </td>
            </tr>
            <?php foreach ($category['entries'] as $entry) : ?>
                <?php $checked = $entry['demand']; ?>
                <tr style="display:none;">
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

  $(document).ready(function()
   {
      $(".toogleCategory").click(function() { $(this).nextUntil(".toogleCategory").toggle();});

        /* activate sidebar */
        $('#sidebar').affix({
          offset: {
            top: 235
          }
        });

        /* activate scrollspy menu */
        var $body   = $(document.body);
        var navHeight = $('.navbar').outerHeight(true) + 10;

        $body.scrollspy({
          target: '#leftCol',
          offset: navHeight
        });

        /* smooth scrolling sections */
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html,body').animate({
                  scrollTop: target.offset().top - 50
                }, 1000);
                return false;
              }
            }
        });
   });





</script>