<?php

function list_entries(array $facilities, $list_entries)
{
	// group by facility id and category
    $group = [];
    foreach ($list_entries as $entry) {
        $group[$entry['facility_id']][$entry['category_name']][] = $entry;
    }
	
    foreach ($group as $facility_id => $categories) {
        $facility = $facilities[$facility_id];
        echo '<div class="well well-lg pull-left" style="margin-right: 20px; max-width: 340px;">';
            echo "<h4 class>{$facility->name}</h4><hr style='margin: 10px;'>";
            echo '<p class="small">';
            echo !empty($facility->phone) ? "{$facility->phone}<br>" : '';
            echo !empty($facility->email) ? "<a href=\"mailto:{$facility->email}\">{$facility->email}</a><br>" : '';
            echo "{$facility->address}<br>{$facility->zip} {$facility->city}";
            echo '</p>';

            echo '<div class="match_list" style="height: 250px; margin-top: 20px; overflow: visible; position: relative; width: 290px;">';
            foreach ($categories as $category => $entries) {
                echo '<div class="ioslist-group-container">';
                    echo "<div class='ioslist-group-header'>$category</div>";
                    echo '<ul>';
                    foreach ($entries as $entry) {
                        echo "<li>{$entry['name']}</li>";
                    }
                    echo '</ul>';
                echo '</div>';
            }
            echo '</div>';
        echo '</div>';
    }
}
?>

<div class="container" style="min-height:800px">
    <div class="row">
        <div class="col-sm-8">
            <h2 style="color:#337ab7;">Wo gibt es Spenden, die wir benötigen?</h2>
        </div>
        <div class="col-sm-3">
            <a data-print class="btn btn-primary btn-lg btn-lg" href="<?= site_url('local/pdf'); ?>" style="width: 100%;" target="_blank"> drucken</a>
        </div>
    </div>
	<div class="row">
		<div class="col-sm-12 text-left">
			<p>Diese Hilfsgruppen können Euch dabei helfen Euren Bedarf zu decken.</p>
            <?php list_entries($facilities, $demand); ?>
        </div>
    </div>
	<hr>


<!-- lower row -->
	<div class="row">
		<div class="col-sm-12 text-left">
			<h2 style="color:#337ab7;">Wo können wir helfen und unsere Lager entlasten?</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-left">
            <p>Diese Hilfsgruppen brauchen Hilfe, um Ihren Bedarf zu decken.</p>
            <?php list_entries($facilities, $offers); ?>
		</div>
	</div>
</div>