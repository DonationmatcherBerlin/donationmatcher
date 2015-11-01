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
				<div class="register">
					<div class="register__row row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="register__label" for="facility_name">
									Name der Hilfsgruppe
								</label>
								<input class="register__input form-control" type="text" id="facility_name" value="<?php echo set_value('facility_name'); ?>" name="facility_name" placeholder="z.B. Meine Hilfsgruppe">
								<span class="register__help">
									Name eures Vereins oder Name der Unterkunft, die ihr unterstützt
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="register__label" for="facility_person_in_charge">
									Ansprechperson in eurer Hilfsgruppe
								</label>
								<input class="register__input form-control" type="text" id="facility_person_in_charge" value="<?php echo set_value('facility_person_in_charge'); ?>" name="facility_person_in_charge" placeholder="z.B. Peter Meier">
								<span class="register__help">
									Name des Ansprechpartners (nur für den Admn von Bedarfsplaner.org sichtbar)
								</span>
							</div>
						</div>
					</div>
					<div class="register__row row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="register__label" for="username">
									Benutzername
								</label>
								<input class="register__input form-control" type="text" id="username" value="<?php echo set_value('username'); ?>" name="username" placeholder="z.B. PeterMeier1960">
								<span class="register__help">
									Euer Benutzername für das Login mit mind. 4 Zeichen
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="register__label" for="email">
									E-Mail
								</label>
								<input class="register__input form-control" type="email" id="email" value="<?php echo set_value('email'); ?>" name="email" placeholder="z.B. pmeier1960@email.de">
								<span class="register__help">
									Eure E-Mailadresse (nur für den Admn von Bedarfsplaner.org sichtbar)
								</span>
							</div>
						</div>
					</div>
					<div class="register__row row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="register__label" for="password">
									Passwort
								</label>
								<input class="register__input form-control" type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="******">
								<span class="register__help">
									Ein Passwort mit min. 6 Zeichen
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="register__label" for="password_confirm">
									Passwort bestätigen
								</label>
								<input class="register__input form-control" type="password" id="password_confirm" name="password_confirm" value="<?php echo set_value('password'); ?>" placeholder="******">
								<span class="register__help">
									Muss identisch zum bereits eingegebenen Passwort sein
								</span>
							</div>
						</div>
					</div>
					<div class="register__row row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="register__label" for="facility_phone">
									Telefon
								</label>
								<input class="register__input form-control" type="text" id="facility_phone" value="<?php echo set_value('facility_phone'); ?>" name="facility_phone" placeholder="030 123456">
								<span class="register__help">
									Eure Telefonnummer (nur für den Admn von Bedarfsplaner.org sichtbar)
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<input class="register__submit btn btn-success btn-lg" type="submit" value="Registrieren">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->