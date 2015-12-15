<div class="container">
    <h2 class="headline">Top 10 der am dringendsten benötigten Sachspenden</h2>
    <div class="table-responsive">
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Kategorie</th>
                    <th>Artikel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($top_demand as $index => $category): ?>
                    <?php foreach ($category["entries"] as $index => $entry): ?>
                        <tr>
                            <td><?= $category["category"]; ?></td>
                            <td><?= $entry["entry"]; ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>