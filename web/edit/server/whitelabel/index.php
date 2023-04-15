<?php
use function Hestiacp\quoteshellarg\quoteshellarg;

$TAB = "SERVER";

// Main include
include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

// Check user
if ($_SESSION["userContext"] != "admin") {
	header("Location: /list/user");
	exit();
}

if (!empty($_POST)) {
	if (!empty($_POST["v_app_name"]) && $_SESSION["APP_NAME"] != $_POST["v_app_name"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value APP_NAME " .
				quoteshellarg($_POST["v_app_name"]),
			$output,
			$return_var,
		);
	}
	if (!empty($_POST["v_hide_docs"]) && $_SESSION["HIDE_DOCS"] != $_POST["v_hide_docs"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value HIDE_DOCS " .
				quoteshellarg($_POST["v_hide_docs"]),
			$output,
			$return_var,
		);
	}
	if (!empty($_POST["v_from_name"]) && $_SESSION["FROM_NAME"] != $_POST["v_from_name"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value FROM_NAME " .
				quoteshellarg($_POST["v_from_name"]),
			$output,
			$return_var,
		);
	}
	if (!empty($_POST["v_from_email"]) && $_SESSION["FROM_EMAIL"] != $_POST["v_from_email"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value FROM_EMAIL " .
				quoteshellarg($_POST["v_from_email"]),
			$output,
			$return_var,
		);
	}
	if (!empty($_POST["v_hide_docs"]) && $_SESSION["HIDE_DOCS"] != $_POST["v_hide_docs"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value HIDE_DOCS " .
				quoteshellarg($_POST["v_hide_docs"]),
			$output,
			$return_var,
		);
	}
	if ($_SESSION["LOGO_LOGIN"] != $_POST["v_logo_login"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value LOGO_LOGIN " .
				quoteshellarg($_POST["v_logo_login"]),
			$output,
			$return_var,
		);
	}
	if ($_SESSION["LOGO_HEADER"] != $_POST["v_logo_header"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value LOGO_HEADER " .
				quoteshellarg($_POST["v_logo_header"]),
			$output,
			$return_var,
		);
	}
	if ($_SESSION["LOGO_FAVICON"] != $_POST["v_logo_favicon"]) {
		exec(
			HESTIA_CMD .
				"v-change-sys-config-value LOGO_FAVICON " .
				quoteshellarg($_POST["v_logo_favicon"]),
			$output,
			$return_var,
		);
	}
}

// Check system configuration
exec(HESTIA_CMD . "v-list-sys-config json", $output, $return_var);
$data = json_decode(implode("", $output), true);
unset($output);

$sys_arr = $data["config"];
foreach ($sys_arr as $key => $value) {
	$_SESSION[$key] = $value;
}

$v_app_name = $_SESSION["APP_NAME"];
$v_hide_docs = $_SESSION["HIDE_DOCS"];
$v_from_name = $_SESSION["FROM_NAME"];
$v_from_email = $_SESSION["FROM_EMAIL"];
$v_logo_header = $_SESSION["LOGO_HEADER"];
$v_logo_login = $_SESSION["LOGO_LOGIN"];
$v_logo_favicon = $_SESSION["LOGO_FAVICON"];
$v_themes_list = $_SESSION["THEMES_LIST"];
// Render page
render_page($user, $TAB, "edit_whitelabel");

// Flush session messages
unset($_SESSION["error_msg"]);
unset($_SESSION["ok_msg"]);
