	<!-- SIGN IN FANCY MODAL -->
	<script type="text/javascript">
	jQuery(function ($) {
		$('#modal-sign-in').submit(function(e){
			e.preventDefault();
			var action = $(this).attr('action');
			$.post(action, $(this).serialize(), function(response) {
				$('.fancybox-inner').html(response);
			});
		});
	});
	</script>
	<div class="modal-sign-in">
		<h4>Se connecter</h4>
		<form action="" id="modal-sign-in" class="form-horizontal">
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input type="email" name="email" class="form-control" id="exampleInputEmail1" required="required">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Mot de passe</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" required="required">
				<span class="forgot"><a class="forgot-password" href="">Mot de passe oublié</a></span>
			</div>
			<div class="buttons">
				<button class="btn valider" type="submit">Valider</button>
			</div>
			<p>Pas de compte ? <a href="">Inscription</a></p>

		</form>
	</div>
	<!-- SIGN IN FANCY MODAL -->
<?php if (!empty($_POST)){ ?>
<pre><?php print_r($_POST); ?></pre>
<?php } ?>