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
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="username">Username</label>
						<input style="max-width: 500px;" disabled="disabled" type="text" class="form-control" id="username" value="<?php echo set_value('username', $user->username); ?>" name="username">
						<small class="help-block" style="color: #337ab7;">Der Username kann nicht geändert werden</small>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input style="max-width: 500px;" type="email" class="form-control" id="email" value="<?php echo set_value('email', $user->email); ?>" name="email" placeholder="Enter your email">
						<small class="help-block" style="color: #337ab7;">A valid email address</small>
					</div>
					<div class="form-group">
						<label for="facility_name">Facility Name</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_name" value="<?php echo set_value('facility_name', $facility->name); ?>" name="facility_name" placeholder="Enter your facility name">
						<small class="help-block" style="color: #337ab7;">Your name</small>
					</div>
					<div class="form-group">
						<label for="facility_name">Dach Organization (Optional)</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_name" value="<?php echo set_value('facility_organisation', $facility->organisation); ?>" name="facility_organisation" placeholder="Enter your facility name">
						<small class="help-block" style="color: #337ab7;">Your name</small>
					</div>
				</div>
				<div class="col-sm-6">
						<div class="form-group">
						<label for="facility_address">Address</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_address" value="<?php echo set_value('facility_address', $facility->address); ?>" name="facility_address" placeholder="">
						<small class="help-block" style="color: #337ab7;">Your Address</small>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label for="facility_zip">ZIP</label>
								<input style="max-width: 200px;" type="text" class="form-control" id="facility_zip" value="<?php echo set_value('facility_zip', $facility->zip); ?>" name="facility_zip" placeholder="">
								<small class="help-block" style="color: #337ab7;">Your ZIP</small>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="facility_city">City</label>
									<input style="max-width: 200px;" type="text" class="form-control" id="facility_city" value="<?php echo set_value('facility_city', $facility->city); ?>" name="facility_city" placeholder="">
									<small class="help-block" style="color: #337ab7;">Your City</small>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="facility_country">Country</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_country" value="<?php echo set_value('facility_country', $facility->country); ?>" name="facility_country" placeholder="">
						<small class="help-block" style="color: #337ab7;">Your Country</small>
					</div>

					<div class="form-group">
						<label for="facility_phone">Telefon</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_phone" value="<?php echo set_value('facility_phone', $facility->phone); ?>" name="facility_phone" placeholder="">
						<small class="help-block" style="color: #337ab7;">Your Phone</small>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="facility_person_in_charge">Verantwortliche Person (Vor- und Nachname)</label>
						<input style="max-width: 500px;" type="text" class="form-control" id="facility_person_in_charge" value="<?php echo set_value('facility_person_in_charge', $facility->person_in_charge); ?>" name="facility_person_in_charge" placeholder="Enter the name of the responsible person">
						<small class="help-block" style="color: #337ab7;">Verantworltiche Person</small>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input style="max-width: 500px;" type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Enter a password">
						<small class="help-block" style="color: #337ab7;">At least 6 characters - Leer lassen für keine Änderung</small>
					</div>
					<div class="form-group">
						<label for="password_confirm">Confirm password</label>
						<input style="max-width: 500px;" type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password'); ?>" placeholder="Confirm your password">
						<small class="help-block" style="color: #337ab7;">Must match your password</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group" style="margin-top: 40%;">
						<input style="max-width: 500px;" type="submit" class="btn btn-success btn-block" value="Speichern" >
					</div>
				</div>
			</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->