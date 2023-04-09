<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a href="/list/server/" class="button button-secondary" id="btn-back">
				<i class="fas fa-arrow-left icon-blue"></i>
				<?= _("Back") ?>
			</a>
			<a href="/list/ip/" class="button button-secondary">
				<i class="fas fa-ethernet icon-blue"></i>
				<?= _("IP") ?>
			</a>
			<?php if (isset($_SESSION["FIREWALL_SYSTEM"]) && !empty($_SESSION["FIREWALL_SYSTEM"])) { ?>
				<a href="/list/firewall/" class="button button-secondary">
					<i class="fas fa-shield-halved icon-red"></i>
					<?= _("Firewall") ?>
				</a>
			<?php } ?>
		</div>
		<div class="toolbar-buttons">
			<button type="submit" class="button" form="vstobjects">
				<i class="fas fa-floppy-disk icon-purple"></i>
				<?= _("Save") ?>
			</button>
		</div>
	</div>
</div>
<!-- End toolbar -->

<!-- Begin form -->
<div class="container animate__animated animate__fadeIn">
	<form
		x-data="{
			hide_docs: '<?= $v_hide_docs ?? "no" ?>',
		}"
		id="vstobjects"
		name="v_configure_server"
		method="post"
	>
		<input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
		<input type="hidden" name="save" value="save">

		<div class="form-container">
			<h1 class="form-title">
				<?= _("White label options") ?>
			</h1>
			<?php show_alert_message($_SESSION); ?>

			<!-- Basic options section -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-gear u-mr15"></i>
					<?= _("General") ?>
				</summary>
				<div class="collapse-content">
					<div class="u-mb10">
						<label for="v_hostname" class="form-label">
							<?= _("Application Name") ?>
						</label>
						<input
							type="text"
							class="form-control"
							name="v_app_name"
							id="v_app_name"
							value="<?= htmlentities(trim($v_app_name, "'")) ?>"
						>
					</div>
					<div class="u-mb10">
						<label for="v_from_name" class="form-label">
							<?= _("Sender name") ?>
						</label>
						<input
							type="text"
							class="form-control"
							name="v_from_name"
							id="v_from_name"
							value="<?= htmlentities(trim($v_from_name, "'")) ?>"
						>
					</div>
					<div class="u-mb10">
						<label for="v_from_email" class="form-label">
							<?= _("Sender email adress") ?>
						</label>
						<input
							type="text"
							class="form-control"
							name="v_form_email"
							id="v_from_email"
							value="<?= htmlentities(trim($v_from_email, "'")) ?>"
						>
					</div>
					<div class="u-mb10">
						<label for="v_timezone" class="form-label">
							<?= _("Hide link to Documentation") ?>
						</label>
						<select x-model="hide_docs" class="form-select" name="v_hide_docs" id="v_hide_docs">
							<option value="yes"><?=_('Hide Documentation Link');?></option>
							<option value="no"><?=_('Display Documentation Link');?></option>

						</select>
					</div>
				</div>
			</details>
			<!-- Logo's options section -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-image u-mr15"></i>
					<?= _("Logos") ?>
				</summary>
				<div class="collapse-content">
					<div class="u-mb10">
						<p><?=sprintf(_("Copy the logos to %s. Please do not overwrite exsitng logo's and specify the full pagh /images/mylogo.png"),'/usr/local/hestia/web/images/');?></p>
					</div>
					<div class="u-mb10">
						<label for="v_logo_header" class="form-label">
							<?= _("Logo Header") ?><span class="optional">54px x 29px</span>
						</label>
						<?php if(!empty($_SESSION['LOGO_HEADER'])){
						?>
						<img src="<?=$_SESSION['LOGO_HEADER'];?>" height="29px" width="54px" style="display:block"/>
						<?php
						}
						?>

						<input
							type="text"
							class="form-control"
							name="v_logo_header"
							id="v_logo_header"
							value="<?= htmlentities(trim($v_logo_header, "'")) ?>"
						>
					</div>
					<div class="u-mb10">
						<label for="v_logo_login" class="form-label">
							<?= _("Logo Login page") ?><span class="optional">100px x 120px</span>
						</label>
						<?php if(!empty($_SESSION['LOGO_LOGIN'])){
						?>
						<img src="<?=$_SESSION['LOGO_LOGIN'];?>" height="120px" width="100px" style="display:block"/>
						<?php
						}
						?>
						<input
							type="text"
							class="form-control"
							name="v_logo_login"
							id="v_logo_login"
							value="<?= htmlentities(trim($v_logo_login, "'")) ?>"
						>
					</div>
				</div>
				<div class="collapse-content">
					<div class="u-mb10">
						<label for="v_logo_favicon" class="form-label">
							<?= _("Favicon") ?>
						</label>
						<?php if(!empty($_SESSION['LOGO_FAVICON'])){
						?>
						<img src="<?=$_SESSION['LOGO_FAVICON'];?>" height="32px" width="32px" style="display:block"/>
						<?php
						}
						?>
						<input
							type="text"
							class="form-control"
							name="v_logo_favicon"
							id="v_logo_favicon"
							value="<?= htmlentities(trim($v_logo_favicon, "'")) ?>"
						>
					</div>
				</div>
			</details>
			<!-- Basic options section -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-gear u-mr15"></i>
					<?= _("Themes") ?>
				</summary>
				<div class="collapse-content">
					<p><?=sprintf(_("Custom themes can be installed in %s"), '/usr/local/hestia/web/css/custom/');?></p>
					<div class="u-mb10">
						<label for="v_hostname" class="form-label">
							<?= _("Enabled themes") ?>
						</label>
						<?php

						?>
					</div>
				</div>
			</details>
		</div>
	</form>
</div>
<!-- End form -->
