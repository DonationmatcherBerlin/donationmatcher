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

				<div class="row" style="margin-bottom: 50px;">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="facility_name">Facility Name</label>
							<input type="text" style="max-width: 500px;" class="form-control" id="facility_name" value="<?php echo set_value('facility_name'); ?>" name="facility_name" placeholder="Enter your facility name">
							<small class="help-block" style="color: #337ab7;">Your name</small>
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" style="max-width: 500px;" class="form-control" id="username" value="<?php echo set_value('username'); ?>" name="username" placeholder="Enter a username">
							<small class="help-block" style="color: #337ab7;">At least 4 characters, letters or numbers only</small>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" style="max-width: 500px;" class="form-control" id="email" value="<?php echo set_value('email'); ?>" name="email" placeholder="Enter your email">
							<small class="help-block" style="color: #337ab7;">A valid email address</small>
						</div>
						<div class="form-group">
							<label for="facility_phone">Telefon</label>
							<input type="text" style="max-width: 500px;" class="form-control" id="facility_phone" value="<?php echo set_value('facility_phone'); ?>" name="facility_phone" placeholder="Enter your facility phone numner (optional)">
							<small class="help-block" style="color: #337ab7;">Your Phone</small>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="facility_person_in_charge">Verantwortliche Person (Vor- und Nachname)</label>
							<input type="text" style="max-width: 500px;" class="form-control" id="facility_person_in_charge" value="<?php echo set_value('facility_person_in_charge'); ?>" name="facility_person_in_charge" placeholder="Enter the name of the responsible person">
							<small class="help-block" style="color: #337ab7;">Verantworltiche Person</small>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" style="max-width: 500px;" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Enter a password">
							<small class="help-block" style="color: #337ab7;">At least 6 characters</small>
						</div>
						<div class="form-group">
							<label for="password_confirm">Confirm password</label>
							<input type="password" style="max-width: 500px;" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password'); ?>" placeholder="Confirm your password">
							<small class="help-block" style="color: #337ab7;">Must match your password</small>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-success btn-lg" style="width: 200px; margin-top:20px;" value="Register">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->