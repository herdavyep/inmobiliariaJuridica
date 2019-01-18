<form id="reset-password" class="ajax-auth forgot-password-form" method="post">
	<div class="form-title"><?php esc_html_e('Forgot Password','dreamvilla-multiple-property'); ?></div>
	<p class="status"></p>
	<input type="text" name="username" id="signonname" class="required" placeholder="Email/Username" title="<?php esc_html_e( 'Email/Username field is required', 'dreamvilla-multiple-property' ); ?>">
	<button class="submit_button" type="submit"><?php esc_html_e('Submit','dreamvilla-multiple-property'); ?></button>
	<?php wp_nonce_field('dreamvilla-ajax-reset-password-nonce', 'reset-security'); ?>
	<p><span><?php esc_html_e('Need an account?','dreamvilla-multiple-property'); ?></span><a href="#" class="register-url"><?php esc_html_e('Register here!','dreamvilla-multiple-property'); ?></a></p>
	<p><a href="#" class="login-url"><?php esc_html_e('Login here?','dreamvilla-multiple-property'); ?></a></p>
</form>