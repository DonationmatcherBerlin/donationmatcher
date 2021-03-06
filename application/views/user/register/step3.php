<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container" style="min-height: 100%;">
	<div class="row">
		<?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="col-md-12">
			<div class="page-header">
				<h1>Register</h1>
			</div>
			<?= form_open('',array('id' => 'profileform')) ?>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="username">Username</label>
						<input style="max-width: 500px;" disabled="disabled" type="text" class="form-control" id="username" value="<?php echo set_value('username', $user->username); ?>" name="username">
						<small class="help-block" style="color: #337ab7;">Der Username kann nicht geändert werden</small>
					</div>
					<div class="form-group">
						<label for="email">Öffentliche Email</label>
						<input style="max-width: 500px;" type="email" class="form-control" id="facility_email" value="<?php echo set_value('facility_email', $facility->email); ?>" name="facility_email" placeholder="E-Mail eingeben">
						<small class="help-block" style="color: #337ab7;">Eine gültige E-Mail Adresse</small>
					</div>
					<div class="form-group">
						<label for="facility_name">Name der Organisation</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_name" value="<?php echo set_value('facility_name', $facility->name); ?>" name="facility_name" placeholder="Name eingeben">
						<small class="help-block" style="color: #337ab7;">Zum Beispiel Notunterkunft oder Annahmestelle</small>
					</div>
					<div class="form-group">
						<label for="facility_name">Dachorganisation (Optional)</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_name" value="<?php echo set_value('facility_organisation', $facility->organisation); ?>" name="facility_organisation" placeholder="Name eingeben">
						<small class="help-block" style="color: #337ab7;">Name der übergeordneten Organisation</small>
					</div>
				</div>
				<div class="col-sm-6">
						<div class="form-group">
						<label for="facility_address">Adresse</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_address" value="<?php echo set_value('facility_address', $facility->address); ?>" name="facility_address" placeholder="">
						<small class="help-block" style="color: #337ab7;">Adresse der Organisation</small>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label for="facility_zip">Postleitzahl</label>
								<input style="max-width: 200px;" type="text" class="form-control" id="facility_zip" value="<?php echo set_value('facility_zip', $facility->zip); ?>" name="facility_zip" placeholder="">
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="facility_city">Stadt</label>
									<input style="max-width: 200px;" type="text" class="form-control" id="facility_city" value="<?php echo set_value('facility_city', $facility->city); ?>" name="facility_city" placeholder="">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="facility_country">Land</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_country" value="<?php echo set_value('facility_country', $facility->country); ?>" name="facility_country" placeholder="">
					</div>

					<div class="form-group">
						<label for="facility_phone">Telefonnummer</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_phone" value="<?php echo set_value('facility_phone', $facility->phone); ?>" name="facility_phone" placeholder="">
						<small class="help-block" style="color: #337ab7;">Telefonnummer der Organisation</small>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<div id="businessHoursContainer"></div>
						<textarea class="hidden" name="businesshours" id="businessHours"><?php echo set_value('businesshours', $facility->opening_hours); ?></textarea>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="facility_person_in_charge">Verantwortliche Person (Vor- und Nachname)</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_person_in_charge" value="<?php echo set_value('facility_person_in_charge', $facility->person_in_charge); ?>" name="facility_person_in_charge" placeholder="Name einer Ansprechsperson">
						<small class="help-block" style="color: #337ab7;">Verantwortliche Person</small>
					</div>
					<div class="form-group">
						<label for="password">Neues Passwort</label>
						<input style="max-width: 500px;" type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Passwort eingeben">
						<small class="help-block" style="color: #337ab7;">Mindestens 6 Zeichen! - Leer lassen für keine Änderung</small>
					</div>
					<div class="form-group">
						<label for="password_confirm">Neues Passwort wiederholen</label>
						<input style="max-width: 500px;" type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password'); ?>" placeholder="Passwort wiederholen">
						<small class="help-block" style="color: #337ab7;">Muss mit dem Passwort übereinstimmen</small>
					</div>
				</div>
				<div class="col-sm-6">


					<div class="form-group">						
					<?php $givenow = $facility->public_givenow==1?TRUE:FALSE; ?>
						<label for="public_givenow"><input type="checkbox" id="public_givenow" name="public_givenow" value="1" <?php echo set_checkbox('public_givenow', "1", $givenow); ?> /> Meine Organisation soll in der GiveNow Liste veröffentlicht werden.</label>
						<small class="help-block" style="color: #337ab7;">GiveNow ist eine einfache App mit der Spender sehen koennen welche Spenden am dringendsten in ihrer Stadt benoetigt werden. Die Sachspenden werden von ihnen zuhause abgeholt und direkt zu den Hilfsorganisationen gebracht. <br><br><a href="http://www.givenow.io/" target="_blank">www.givenow.io</a></small>
					</div>
					<div class="form-group">
					<?php $internal = $facility->public_internal==1?TRUE:FALSE; ?>
						<label for="public_internal"><input type="checkbox" name="public_internal" id="public_internal" value="1" <?php echo set_checkbox('public_internal', "1", $internal); ?> /> Meine Organisation soll in der internen Liste aller Hilfsorganisationen bei Bedarfsplaner aufgeührt werden.</label>
						<small class="help-block" style="color: #337ab7;">Das erleichtert die Kontaktaufnahme.</small>
					</div>

					<div class="form-group" style="">
						<input id="save" style="max-width: 500px;" type="submit" class="btn btn-success btn-block" value="Speichern" >
					</div>
				</div>
			</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->
<script>
       ;(function( $, window, document, undefined ) {
                "use strict";
                $( document ).ready(function() {
                    $('#myTable').DataTable();
                    $('#username').mapUserName('#facility_name');
                    $('.stickytable').stickyTableHeaders();

                    var businessHoursManager = $("#businessHoursContainer").businessHours({operationTime:<?php echo $facility->opening_hours; ?>});

                    $("#save").click(function(e) {
                        // use: businessHoursManager.serialize() to get serialized business hours in JSON
                        $("#businessHours").val(JSON.stringify(businessHoursManager.serialize()));
                        $('#profileform').submit();
                        return true;
                    });

                });
            })( jQuery, window, window.document );
</script>