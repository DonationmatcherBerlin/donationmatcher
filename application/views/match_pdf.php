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

    <?php $this->load->view('match_view'); ?>


    <div id="footer">
        <p class="page">Seite </p>
    </div>
</body>

</html>