<div class="container">
    <h2 class="headline">Liste der Hilfsgruppen in Berlin</h2>
    <div class="table-responsive">
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Homepage</th>
                    <th class="text-center">Adresse</th>
                    <th class="text-center">Öffnungszeiten</th>
                    <th class="text-center">Bedarfsliste</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($facilities as $facility): ?>
                    <tr>
                        <td><?= $facility->organisation; ?></td>
                        <td>
                            <?php if($facility->homepage): ?>
                                <a target="_blank" href="<?= $facility->homepage; ?>">Link</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $facility->address; ?><br />
                            <?= $facility->zip; ?> <?= $facility->city; ?>
                        </td>
                        <td><?= opening_hours($facility->opening_hours); ?></td>
                        <td><a href="<?= base_url('/stocklist/public_pdf/' . $facility->facility_id) ?>">Download</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
