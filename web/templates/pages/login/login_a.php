<div class="login animate__animated animate__zoomIn">
	<a href="/" class="u-block u-mb40">
		<img src="<?php if ( !empty($_SESSION['LOGO_LOGIN'])){ echo $_SESSION['LOGO_LOGIN']; } else{ echo "/images/logo.svg"; } ?>" alt="<?=htmlentities($_SESSION['APP_NAME']);?>" width="100" height="120">
	</a>
	<form id="form_login" method="post" action="/login/">
		<input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
		<input type="hidden" name="murmur" value="" id="murmur">
		<h1 class="login-title">
			<?= sprintf(_("Welcome to %s"),htmlentities($_SESSION['APP_NAME'])) ?>
		</h1>
		<?php show_error_message($error); ?>
		<div class="u-mb10">
			<label for="user" class="form-label"><?= _("Username") ?></label>
			<input type="text" class="form-control" name="user" id="user" required autofocus>
		</div>
		<div class="u-mb20">
			<label for="password" class="form-label u-side-by-side">
				<?= _("Password") ?>
				<?php if ($_SESSION["POLICY_SYSTEM_PASSWORD_RESET"] !== "no") { ?>
					<a class="login-form-link" href="/reset/">
						<?= _("forgot password") ?>
					</a>
				<?php } ?>
			</label>
			<input type="password" class="form-control" name="password" id="password" required autofocus>
		</div>
		<button type="submit" class="button">
			<i class="fas fa-right-to-bracket"></i><?= _("Next") ?>
		</button>
	</form>
</div>

</body>

</html>
