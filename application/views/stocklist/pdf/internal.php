<html>
<head>
    <style>
        body { font-family: helvetica, sans-serif; }
        h1 { margin-bottom: 0; }
        .stocklist {
            margin-top: 20px;
        }
        .stocklist table {
            margin-top: 5px;
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        .stocklist tr {
            padding: 5px 0;
        }
        .stocklist td {
            border: 1px solid black;
            padding: 5px 2;
        }
        .facility {
            margin-top: 20px;
        }
        .demand1 {
            background-color: lightseagreen;
        }
        .demand-1 {
            background-color: lightblue;
        }

        @page { margin: 0px 50px 50px; }
        #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px; text-align: right; }
        #footer .page:after { content: counter(page, decimal); }

    </style>
</head>
<body>

    <h1>Bedarfsliste</h1>
    <span>
        Stand: <?= date('d.m.Y H:i'); ?><br />
        Letztes Update: <?= $stock_list->updated_at ?  date('d.m.Y H:i', $stock_list->updated_at) : ' - '; ?>
    </span>

    <div class="facility">
        <?= $facility->name; ?><br />
        <?= $facility->organisation; ?><br />
        <?= $facility->address . ', ' .$facility->zip . ' ' . $facility->city; ?><br />
        Öffnungszeiten: <?= opening_hours($facility->opening_hours); ?><br />
        <?= $facility->phone; ?><br />
        <?= $facility->email; ?><br />
    </div>

    <?php foreach($grouped_stock_list as $category): ?>
        <div class="stocklist">
            <strong><?= $category['name']; ?></strong>
            <table>
                <?php foreach($category['entries'] as $entry): ?>
                    <tr>
                        <td style="width: 75%">
                            <?= $entry['name']; ?><?= $entry['comment'] ? ': ' . $entry['comment'] : ''; ?>
                        </td>
                        <td style="width: 10%">
                            <?= $entry['count'] ? $entry['count'] : ''; ?>
                        </td>
                        <td style="width: 15%" class="demand<?= $entry['demand']; ?>">
                            <?= isset($demand_label[$entry['demand']]) ? $demand_label[$entry['demand']] : ''; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endforeach; ?>

    <div id="footer">
        <p class="page">Seite </p>
    </div>
</body>

</html>