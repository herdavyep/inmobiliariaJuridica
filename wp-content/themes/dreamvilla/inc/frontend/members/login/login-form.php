<form id="login" class="ajax-auth login-form active" method="post">
    <div class="form-title"><?php esc_html_e('Login Here','dreamvilla-multiple-property'); ?></div>
    <p class="status"></p>
    <input type="text" name="username" id="username" class="required" placeholder="Username" title="<?php esc_html_e( 'Username field is required', 'dreamvilla-multiple-property' ); ?>" >
	<input type="password" name="password" id="password" class="required" placeholder="Password" title="<?php esc_html_e( 'Password field is required', 'dreamvilla-multiple-property' ); ?>" >
    <button class="submit_button" type="submit"><?php esc_html_e('Login','dreamvilla-multiple-property'); ?></button>
    <?php wp_nonce_field('dreamvilla-ajax-login-nonce', 'login-security'); ?>
	<p><span><?php esc_html_e('Need an account?','dreamvilla-multiple-property'); ?> </span><a href="#" class="register-url"><?php esc_html_e('Register here!','dreamvilla-multiple-property'); ?></a></p>
	<p><a href="#" class="forgot-password-url"><?php esc_html_e('Forgot Password?','dreamvilla-multiple-property'); ?></a></p>
    <?php if( has_action('wordpress_social_login') ){ do_action( 'wordpress_social_login' ); } ?>
</form>