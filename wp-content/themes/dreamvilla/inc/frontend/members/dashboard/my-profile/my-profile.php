<?php

$User_ID                = get_current_user_id();
$User_Detail            = get_userdata( $User_ID );
$Current_User_Detail    = get_user_meta( $User_ID ); ?>

<div class="edit-profile inner-page-gallery-two-columns-dimension-detail">
    <div class="container-fluid">
        <form name="edit-profile" id="edit-profile" class="edit-profile-form" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>
                        <?php esc_html_e('Welcome back,','dreamvilla-multiple-property'); ?>
                        <?php 
                        if( isset($Current_User_Detail['fullname'][0]) ){
                            global $current_user; printf( esc_html__('%s !','dreamvilla-multiple-property'),$current_user->display_name);                                
                        } else {
                            esc_html_e('user!','dreamvilla-multiple-property');
                        } ?>
                    </h3>                     
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="profile-image">
                        <div class="profile-img-controls">
                            
                            <div id="selected-profile-image"><?php                            
                                if( isset( $Current_User_Detail['profile_image_id'] ) ) {
                                    $profile_image_id = intval( $Current_User_Detail['profile_image_id'][0] );
                                    if ( $profile_image_id ) {
                                        echo wp_get_attachment_image( $profile_image_id, 'full', false, array( 'class' => 'img-responsive' ) );
                                        echo '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' . $profile_image_id .'"/>';
                                    }
                                } ?>
                            </div>

                            <a href="#" id="user-profile-image" class="uploadImageUrl"><?php esc_html_e("Upload Profile Image","dreamvilla-multiple-property"); ?></a>
                            <?php if( isset( $Current_User_Detail['profile_image_id'] ) ) { ?>
                                <a href="#" class="removeImageUrl"> <i class="glyphicon glyphicon-remove"> </i> </a><?php
                            } else { ?>
                                <a href="#" style="display:none;" class="removeImageUrl"> <i class="glyphicon glyphicon-remove"> </i> </a><?php
                            } ?>
                            <div id="errors-report"></div>
                        </div>                        
                    </div>
                    <p class="profile-image-detail"><?php esc_html_e("*Photo size 270px X 270px.","dreamvilla-multiple-property"); ?></p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <input id="fullname" type="text" name="fullname" class="required" placeholder="<?php esc_html_e("Full Name","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['fullname'][0]) ){ echo esc_attr( $Current_User_Detail['fullname'][0] ); } ?>" title="<?php esc_html_e('Provide Full Name!', 'dreamvilla-multiple-property'); ?>" >
                    <input id="user_email" type="email" name="user_email" class="required email" placeholder="<?php esc_html_e("Email","dreamvilla-multiple-property"); ?>" value="<?php echo esc_attr( $User_Detail->user_email ); ?>" title="<?php esc_html_e('Provide Email Address!', 'dreamvilla-multiple-property'); ?>" >
                    <input id="phone" type="text" name="phone" class="digits" placeholder="<?php esc_html_e("Phone","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['phone'][0]) ){ echo esc_attr( $Current_User_Detail['phone'][0] ); } ?>">
                    <input id="mobile" type="text" name="mobile" class="digits" placeholder="<?php esc_html_e("Mobile","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['mobile'][0]) ){ echo esc_attr( $Current_User_Detail['mobile'][0] ); } ?>">
                    <input id="skype" type="text" name="skype" placeholder="<?php esc_html_e("Skype","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['skype'][0]) ){ echo esc_attr( $Current_User_Detail['skype'][0] ); } ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <input id="facebookurl" class="url" type="text" name="facebookurl" placeholder="<?php esc_html_e("Facebook URL","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['facebookurl'][0]) ){ echo esc_attr( $Current_User_Detail['facebookurl'][0] ); } ?>" >
                    <input id="twitterurl" class="url" type="text" name="twitterurl" placeholder="<?php esc_html_e("Twitter URL","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['twitterurl'][0]) ){ echo esc_attr( $Current_User_Detail['twitterurl'][0] ); } ?>" >
                    <input id="linkedinurl" class="url" type="text" name="linkedinurl" placeholder="<?php esc_html_e("Linkedin URL","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['linkedinurl'][0]) ){ echo esc_attr( $Current_User_Detail['linkedinurl'][0] ); } ?>" >
                    <input id="pinteresturl" class="url" type="text" name="pinteresturl" placeholder="<?php esc_html_e("Pinteres URL","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['pinteresturl'][0]) ){ echo esc_attr( $Current_User_Detail['pinteresturl'][0] ); } ?>" >
                    <input id="websiteurl" class="url" type="text" name="websiteurl" placeholder="<?php esc_html_e("Website Url","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['websiteurl'][0]) ){ echo esc_attr( $Current_User_Detail['websiteurl'][0] ); } ?>" >
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6"> 
                    <input id="titleposition" type="text" name="titleposition" placeholder="<?php esc_html_e("Title/Position","dreamvilla-multiple-property"); ?>" value="<?php if( isset($Current_User_Detail['titleposition'][0]) ){ echo esc_attr( $Current_User_Detail['titleposition'][0] ); } ?>" >
                    <textarea id="aboutme" name="aboutme" placeholder="<?php esc_html_e("About Me","dreamvilla-multiple-property"); ?>"><?php if( isset($Current_User_Detail['aboutme'][0]) ){ echo esc_textarea( $Current_User_Detail['aboutme'][0] ); } ?></textarea>
                </div>
            </div>            
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-2">
                    <input type="submit" value="Update Profile" name="submit">                    
                    <?php wp_nonce_field('dreamvilla-ajax-edit-profile-nonce', 'edit-profile-security'); ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p class="status"></p>
                </div>
            </div>            
        </form>

        <form name="change-password" id="change-password" class="change-password" enctype="multipart/form-data" method="post">
            <div class="change-password-form">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h3><?php esc_html_e("Change Password","dreamvilla-multiple-property"); ?></h3>
                        <p class="profile-image-detail"><?php esc_html_e("*After you change the password you will have to login again.","dreamvilla-multiple-property"); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <input id="oldpassword" type="password" class="required" name="oldpassword" placeholder="<?php esc_html_e("Old Password","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Provide Old Password!', 'dreamvilla-multiple-property'); ?>">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <input id="newpassword" type="password" class="required" name="newpassword" placeholder="<?php esc_html_e("New Password","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Provide New Password!', 'dreamvilla-multiple-property'); ?>">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <input id="confirmpassword" type="password" class="required" name="confirmpassword" placeholder="<?php esc_html_e("Confirm Password","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Provide Confirm New Password!', 'dreamvilla-multiple-property'); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-2">
                        <input type="submit" value="Reset Password" name="submit">
                        <?php wp_nonce_field('dreamvilla-ajax-change-password-nonce', 'change-password-security'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <p class="change_password"></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>