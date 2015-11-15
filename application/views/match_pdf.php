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
        echo "<td><strong>" . implode(', ', array_column($entries, 'name')) . "</strong></td>";
        echo "<td>{$facilities[$facility_id]->name}</td>";
        echo "<td>{$facilities[$facility_id]->phone}</td>";
        echo "<td>{$facilities[$facility_id]->email}</td>";
        echo "<td>{$facilities[$facility_id]->address},{$facilities[$facility_id]->zip} {$facilities[$facility_id]->city}</td>";
        echo "</tr>";
    }
}
?>

<html>
<head>
    <style>
        body { font-family: helvetica, sans-serif; }
        h1 { margin-bottom: 0; }
        h2 { margin-bottom: 0; }
        .table { width: 100%; }
        a[data-print] { display: none; }

        @page { margin: 50px; }
        #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px; text-align: right; }
        #footer .page:after { content: counter(page, decimal); }

    </style>
</head>
<body>
    <h1>Bedarfsplaner</h1>
    <span>
        Stand: <?= $stock_list->updated_at ?  $stock_list->updated_at->format('d.m.Y H:i') : $stock_list->created_at->format('d.m.Y H:i'); ?> Uhr
    </span>
    <div class="container" style="min-height:800px">
        <div class="row">
            <div class="col-sm-8">
                <h2 style="color:#337ab7;">Wo gibt es Spenden, die wir benötigen?</h2>
            </div>
            <div class="col-sm-3">
                <a data-print class="btn btn-primary btn-lg btn-lg" href="<?= site_url('local/pdf'); ?>" style="width: 100%;" target="_blank"> Planung ausdrucken</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-left">
                <p>Diese Hilfsgruppen brauchen noch spenden, die ihr zuviel habt!</p>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed">
                        <thead>
                        <tr>
                            <th><h4>Bedarf</h4></th>
                            <th><h4>Hilfsgruppe</h4></th>
                            <th><h4>Telefon</h4></th>
                            <th><h4>Email</h4></th>
                            <th><h4>Adresse</h4></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php list_entries($facilities,$demand) ?>
                        </tbody>
                    </table>
                </div>
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
                <div class="table-responsive">
                    <table class="table table-striped table-condensed">
                        <thead>
                        <tr>
                            <th><h4>Überschuss</h4></th>
                            <th><h4>Hilfsgruppe</h4></th>
                            <th><h4>Telefon</h4></th>
                            <th><h4>Email</h4></th>
                            <th><h4>Adresse</h4></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php list_entries($facilities,$offers) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <p class="page">Seite </p>
    </div>
</body>

</html>