<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Sacramento');
	
	.navbar-brand-text {
		font-size: 2rem;
	}

</style>
<nav class="navbar is-transparent is-fixed-top is-dark">
	<div class="navbar-brand">
		<a class="navbar-item" href="<?=$SER_ROOT?>">
			<strong class="navbar-brand-text brand-font">
				Telegonus
			</strong>
		</a>
		<div class="navbar-burger burger" data-target="main-navbar">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>

	<div id="main-navbar" class="navbar-menu">
		<div class="navbar-start">
			<a class="navbar-item" href="<?=$SER_ROOT?>/home" data-option-id="home">
				<span class="icon has-text-danger">
					<i class="fas fa-home"></i>
				</span>
				<span>
					Home
				</span>
			</a>
			<a class="navbar-item" href="<?=$SER_ROOT?>/history" data-option-id="history">
				<span class="icon has-text-link">
					<i class="fas fa-history"></i>
				</span>
				<span>
					History
				</span>
			</a>
		</div>

		<div class="navbar-end">
			<div class="navbar-item">
				<div class="field is-grouped">
					<p class="control">
						<a class="button is-light" href="https://github.com/shrn82256/telegonus">
							<span class="icon">
								<i class="fab fa-lg fa-github-alt has-text-dark"></i>
							</span>
							<!-- <span>Github</span> -->
						</a>
					</p>
				</div>
			</div>
			<div class="navbar-item">
				<div class="field is-grouped">
					<p class="control">
						<a class="button is-info" href="<?=$SER_ROOT?>/fingerprint">
							<span class="icon">
								<i class="fas fa-fingerprint"></i>
							</span>
							<span>Get your fingerprint!</span>
						</a>
					</p>
				</div>
			</div>
			<!-- <div class="navbar-item">
				<div class="field is-grouped">
					<p class="control">
						<a class="button is-danger" href="<?=$SER_ROOT?>/logout.php">
							<span class="icon">
								<i class="fas fa-sign-out-alt"></i>
							</span>
							<span>Logout</span>
						</a>
					</p>
				</div>
			</div> -->
		</div>
	</div>
</nav>
<script type="text/javascript">
	$(document).ready(function() {

		// Check for click events on the navbar burger icon
		$(".navbar-burger").click(function() {

			// Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
			$(".navbar-burger").toggleClass("is-active");
			$(".navbar-menu").toggleClass("is-active");

		});
	});
</script>