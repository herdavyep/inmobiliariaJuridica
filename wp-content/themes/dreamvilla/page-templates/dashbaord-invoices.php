<?php
/*
  Template Name: Invoices
*/
    get_header();

    $User_ID = get_current_user_id();
    $User_Detail = get_userdata( $User_ID );

    $Current_User_Detail = get_user_meta( $User_ID, 'user_detail', true );    

if(function_exists('dreamvilla_mp_the_breadcrumbs')) dreamvilla_mp_the_breadcrumbs(); ?>

<section>
    <div class="inner-page-frontend-dashboard">
        <div class="container">
            <?php dreamvilla_mp_dashboard_inner_menu(get_the_ID());
            if( is_user_logged_in() ){
                get_template_part('inc/frontend/members/dashboard/invoice/invoice');
            } ?>
        </div>
    </div>
</section>
<?php
if( !is_user_logged_in() ){ ?>
    <div class="login-alert">
        <div class="container">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Login Required</h3>
                </div>
                <div class="panel-body"> You need to login to see your invoices! </div>
            </div>
        </div>
    </div>
<?php }
get_footer();
?>