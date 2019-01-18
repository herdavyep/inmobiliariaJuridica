<form id="register" class="ajax-auth register-form" method="post">
	<div class="form-title"><?php esc_html_e('Register Here','dreamvilla-multiple-property'); ?></div>
	<p class="status"></p>
    <input id="signonname" type="text" name="signonname" class="required" placeholder="Username" title="<?php esc_html_e( 'Username field is required', 'dreamvilla-multiple-property' ); ?>" >
	<input id="email" type="text" class="required email" name="email" placeholder="Email Address" title="<?php esc_html_e( 'Email ID field is required', 'dreamvilla-multiple-property' ); ?>" >
	<input id="signonpassword" type="password" class="required" name="signonpassword" placeholder="Password" title="<?php esc_html_e( 'Password field is required', 'dreamvilla-multiple-property' ); ?>" >
	<input type="password" id="password2" class="required" name="password2" placeholder="Conform Password" title="<?php esc_html_e( 'Conform Password field is required', 'dreamvilla-multiple-property' ); ?>" >
	<button class="submit_button" type="submit"><?php esc_html_e('Register Now','dreamvilla-multiple-property'); ?></button>
	<p><span><?php esc_html_e('Already an account?','dreamvilla-multiple-property'); ?></span><a href="#" class="login-url"><?php esc_html_e('Login here!','dreamvilla-multiple-property'); ?></a></p>
	<p><a href="#" class="forgot-password-url"><?php esc_html_e('Forgot Password?','dreamvilla-multiple-property'); ?></a></p>
	<?php wp_nonce_field('dreamvilla-ajax-register-nonce', 'register-security'); ?>
</form>