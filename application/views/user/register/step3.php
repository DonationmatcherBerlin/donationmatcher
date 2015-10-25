<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
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
			<?= form_open() ?>
				<div class="form-group">
					<label for="username">Username</label>
					<input disabled="disabled" type="text" class="form-control" id="username" value="<?php echo set_value('username', $user->username); ?>" name="username">
					<p class="help-block">Der Username kann nicht geändert werden</p>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" value="<?php echo set_value('email', $user->email); ?>" name="email" placeholder="Enter your email">
					<p class="help-block">A valid email address</p>
				</div>
				<div class="form-group">
					<label for="facility_name">Facility Name</label>
					<input type="text" class="form-control" id="facility_name" value="<?php echo set_value('facility_name', $facility->name); ?>" name="facility_name" placeholder="Enter your facility name">
					<p class="help-block">Your name</p>
				</div>
				<div class="form-group">
					<label for="facility_name">Dach Organization (Optional)</label>
					<input type="text" class="form-control" id="facility_name" value="<?php echo set_value('facility_organisation', $facility->organisation); ?>" name="facility_organisation" placeholder="Enter your facility name">
					<p class="help-block">Your name</p>
				</div>
				<div class="form-group">
					<label for="facility_address">Address</label>
					<input type="text" class="form-control" id="facility_address" value="<?php echo set_value('facility_address', $facility->address); ?>" name="facility_address" placeholder="">
					<p class="help-block">Your Address</p>
				</div>
				<div class="form-group">
					<label for="facility_zip">ZIP</label>
					<input type="text" class="form-control" id="facility_zip" value="<?php echo set_value('facility_zip', $facility->zip); ?>" name="facility_zip" placeholder="">
					<p class="help-block">Your ZIP</p>
				</div>
				<div class="form-group">
					<label for="facility_city">City</label>
					<input type="text" class="form-control" id="facility_city" value="<?php echo set_value('facility_city', $facility->city); ?>" name="facility_city" placeholder="">
					<p class="help-block">Your City</p>
				</div>
				<div class="form-group">
					<label for="facility_country">Country</label>
					<input type="text" class="form-control" id="facility_country" value="<?php echo set_value('facility_country', $facility->country); ?>" name="facility_country" placeholder="">
					<p class="help-block">Your Country</p>
				</div>

				<div class="form-group">
					<label for="facility_phone">Telefon</label>
					<input type="text" class="form-control" id="facility_phone" value="<?php echo set_value('facility_phone', $facility->phone); ?>" name="facility_phone" placeholder="">
					<p class="help-block">Your Phone</p>
				</div>
				<div class="form-group">
					<label for="facility_person_in_charge">Verantwortliche Person (Vor- und Nachname)</label>
					<input type="text" class="form-control" id="facility_person_in_charge" value="<?php echo set_value('facility_person_in_charge', $facility->person_in_charge); ?>" name="facility_person_in_charge" placeholder="Enter the name of the responsible person">
					<p class="help-block">Verantworltiche Person</p>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Enter a password">
					<p class="help-block">At least 6 characters - Leer lassen für keine Änderung</p>
				</div>
				<div class="form-group">
					<label for="password_confirm">Confirm password</label>
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password'); ?>" placeholder="Confirm your password">
					<p class="help-block">Must match your password</p>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Speichern">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->