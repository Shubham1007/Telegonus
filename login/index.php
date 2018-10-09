<?php
$SER_ROOT = "..";
$TITLE = "Login - Telegonus";
$PAGE_ID = "login";

include $SER_ROOT."/modules/header.php";

require_once $SER_ROOT."/service/User.php";

?>
<style type="text/css">
	body, html {
		overflow: hidden;
	}
</style>
<div class="container has-background-danger" style="height: 100%;">
<div class="box is-vertical-center">
	<div>Hello</div>
</div>
<!-- <div class="card is-vertical-center">
	<div class="card-content">
		<div class="media">
			<div class="container">
				<h1 class="has-text-centered has-text-link">
					<b>Login</b>
				</h1>
			</div>
		</div>
		<div class="content">
			<div class="field">
				<label class="label">Username</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" type="text" placeholder="UserName">
					<span class="icon is-small is-left">
						<i class="fas fa-user"></i>
					</span>
				</div>
			</div>
			<div class="field">
				<label class="label">Password</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" type="text" placeholder="UserName">
					<span class="icon is-small is-left">
						<i class="fas fa-key"></i>
					</span>
				</div>
			</div>
			<div class="field is-grouped">
				<div class="control">
					<button class="button is-link">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div> -->
</div>
<?php
include $SER_ROOT."/modules/footer.php";
?>