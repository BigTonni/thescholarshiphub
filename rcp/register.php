<?php
/**
 * Registration Form
 *
 * This template is used to display the registration form with [register_form] If the `id` attribute
 * is passed into the shortcode then register-single.php is used instead.
 * @link http://docs.restrictcontentpro.com/article/1597-registerform
 *
 * For modifying this template, please see: http://docs.restrictcontentpro.com/article/1738-template-files
 *
 * @package     Restrict Content Pro
 * @subpackage  Templates/Register
 * @copyright   Copyright (c) 2017, Restrict Content Pro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

global $rcp_options, $post, $rcp_levels_db, $rcp_register_form_atts;
$discount = ! empty( $_REQUEST['discount'] ) ? sanitize_text_field( $_REQUEST['discount'] ) : '';
?>

<?php if( ! is_user_logged_in() ) { ?>
	<h3 class="rcp_header">
		<!-- <?php echo apply_filters( 'rcp_registration_header_logged_out', $rcp_register_form_atts['logged_out_header'] ); ?> -->
		Your Details
	</h3>
<?php } else { ?>
	<h3 class="rcp_header">
		<?php echo apply_filters( 'rcp_registration_header_logged_in', $rcp_register_form_atts['logged_in_header'] ); ?>
	</h3>
<?php }

// show any error messages after form submission
rcp_show_error_messages( 'register' ); ?>

<form id="rcp_registration_form" class="rcp_form" method="POST" action="<?php echo esc_url( rcp_get_current_url() ); ?>">

	<?php if( ! is_user_logged_in() ) { ?>

	<?php do_action( 'rcp_before_register_form_fields' ); ?>
	<fieldset class="rcp_user_fieldset rcp_user_fieldset_custom">
		<div class="fieldset_wrapper top_part">
			<div class="left-form-part">
				<p id="rcp_user_login_wrap">
					<label for="rcp_user_login"><?php echo apply_filters ( 'rcp_registration_username_label', __( 'Username', 'rcp' ) ); ?></label>
					<input name="rcp_user_login" id="rcp_user_login" tabindex="1" class="required" type="text" <?php if( isset( $_POST['rcp_user_login'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_login'] ) . '"'; } ?>/>
				</p>
				<p id="rcp_user_first_wrap">
					<label for="rcp_user_first"><?php echo apply_filters ( 'rcp_registration_firstname_label', __( 'First Name', 'rcp' ) ); ?></label>
					<input name="rcp_user_first" id="rcp_user_first" tabindex="3" type="text" <?php if( isset( $_POST['rcp_user_first'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_first'] ) . '"'; } ?>/>
				</p>
				<?php do_action( 'rcp_after_first_name_registration_field' ); ?>
				<p id="rcp_password_wrap">
					<label for="rcp_password"><?php echo apply_filters ( 'rcp_registration_password_label', __( 'Password', 'rcp' ) ); ?></label>
					<input name="rcp_user_pass" id="rcp_password" tabindex="7" class="required" type="password"/>
				</p>
			</div>
			<div class="right-form-part">
				<p id="rcp_user_email_wrap">
					<label for="rcp_user_email"><?php echo apply_filters ( 'rcp_registration_email_label', __( 'Email', 'rcp' ) ); ?></label>
					<input name="rcp_user_email" id="rcp_user_email" tabindex="2" class="required" type="text" <?php if( isset( $_POST['rcp_user_email'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_email'] ) . '"'; } ?>/>
				</p>
				<p id="rcp_user_last_wrap">
					<label for="rcp_user_last"><?php echo apply_filters ( 'rcp_registration_lastname_label', __( 'Last Name', 'rcp' ) ); ?></label>
					<input name="rcp_user_last" id="rcp_user_last" tabindex="4" type="text" <?php if( isset( $_POST['rcp_user_last'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_last'] ) . '"'; } ?>/>
				</p>
				<?php do_action( 'rcp_after_last_name_registration_field' ); ?>
				<p id="rcp_password_again_wrap">
					<label for="rcp_password_again"><?php echo apply_filters ( 'rcp_registration_password_again_label', __( 'Password Again', 'rcp' ) ); ?></label>
					<input name="rcp_user_pass_confirm" tabindex="8" id="rcp_password_again" class="required" type="password"/>
				</p>				
			</div>
		</div>
		<div class="fieldset_wrapper bottom_part">
			<?php do_action( 'rcp_after_location_registration_field' ); ?>
		</div>
	</fieldset>
	<?php } ?>



	<?php do_action( 'rcp_before_subscription_form_fields' ); ?>

	<fieldset class="rcp_subscription_fieldset rcp_subscription_fieldset_custom">
	<?php
	$levels = rcp_get_subscription_levels( 'active' );
	$i      = 0;
	if( $levels ) : ?>
		<h3 class="rcp_subscription_message"><?php echo apply_filters ( 'rcp_registration_choose_subscription', __( 'Choose your Subscription Type', 'rcp' ) ); ?></h3>
		<ul id="rcp_subscription_levels">
			<?php foreach( $levels as $key => $level ) : ?>
				<?php if( rcp_show_subscription_level( $level->id ) ) :
					$has_trial = $rcp_levels_db->has_trial( $level->id );
				?>
				<li class="rcp_subscription_level rcp_subscription_level_<?php echo $level->id; ?>">
					<input type="radio" id="rcp_subscription_level_<?php echo $level->id; ?>" class="required rcp_level" <?php if ( $i == 0 || ( isset( $_GET['level'] ) && $_GET['level'] == $level->id ) ) { echo 'checked="checked"'; } ?> name="rcp_level" rel="<?php echo esc_attr( $level->price ); ?>" value="<?php echo esc_attr( absint( $level->id ) ); ?>" <?php if( $level->duration == 0 ) { echo 'data-duration="forever"'; } if ( ! empty( $has_trial ) ) { echo 'data-has-trial="true"'; } ?>/>
					<label for="rcp_subscription_level_<?php echo $level->id; ?>">
						<span class="rcp_subscription_level_name"><?php echo rcp_get_subscription_name( $level->id ); ?></span> (<span class="rcp_price" rel="<?php echo esc_attr( $level->price ); ?>"><?php echo $level->price > 0 ? rcp_currency_filter( $level->price ) : __( 'Free', 'rcp' ); ?></span>
						<span class="rcp_level_duration"><?php echo $level->duration > 0 ? $level->duration_unit.'ly' : ''; ?></span>)
					</label>

				</li>
				<?php $i++; endif; ?>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p><strong><?php _e( 'You have not created any subscription levels yet', 'rcp' ); ?></strong></p>
	<?php endif; ?>
	</fieldset>


	<?php if( rcp_has_discounts() ) : ?>
	<fieldset class="rcp_discounts_fieldset">
		<p id="rcp_discount_code_wrap">
			<label for="rcp_discount_code">
				<?php _e( 'Discount Code', 'rcp' ); ?>
				<span class="rcp_discount_valid" style="display: none;"> - <?php _e( 'Valid', 'rcp' ); ?></span>
				<span class="rcp_discount_invalid" style="display: none;"> - <?php _e( 'Invalid', 'rcp' ); ?></span>
			</label>
			<span class="rcp_discount_code_field_wrap">
				<input type="text" id="rcp_discount_code" name="rcp_discount" class="rcp_discount_code" value="<?php echo esc_attr( $discount ); ?>"/>
				<button class="rcp_button" id="rcp_apply_discount"><?php _e( 'Apply', 'rcp' ); ?></button>
			</span>
		</p>
	</fieldset>
	<?php endif; ?>

	<div class="after_register_form_custom">
		<?php do_action( 'rcp_after_register_form_fields', $levels ); ?>	
	</div>
	

	<div class="rcp_gateway_fields">
		<?php
		$gateways = rcp_get_enabled_payment_gateways();
		if( count( $gateways ) > 1 ) :
			$display = rcp_has_paid_levels() ? '' : ' style="display: none;"';
			$i = 1;
			?>
			<fieldset class="rcp_gateways_fieldset">
				<legend><?php _e( 'Choose Your Payment Method', 'rcp' ); ?></legend>
				<p id="rcp_payment_gateways"<?php echo $display; ?>>
					<?php foreach( $gateways as $key => $gateway ) :
						$recurring = rcp_gateway_supports( $key, 'recurring' ) ? 'yes' : 'no';
						$trial    = rcp_gateway_supports( $key, 'trial' ) ? 'yes' : 'no'; ?>
						<label for="rcp_gateway_<?php echo esc_attr( $key ); ?>" class="rcp_gateway_option_label">
							<input id="rcp_gateway_<?php echo esc_attr( $key );?>" name="rcp_gateway" type="radio" class="rcp_gateway_option_input" value="<?php echo esc_attr( $key ); ?>" data-supports-recurring="<?php echo esc_attr( $recurring ); ?>" data-supports-trial="<?php echo esc_attr( $trial ); ?>" <?php checked( $i, 1 ); ?>>
							<?php echo esc_html( $gateway ); ?>
						</label>
					<?php
					$i++;
					endforeach; ?>
				</p>
			</fieldset>
		<?php else: ?>
			<?php foreach( $gateways as $key => $gateway ) :
				$recurring = rcp_gateway_supports( $key, 'recurring' ) ? 'yes' : 'no';
				$trial = rcp_gateway_supports( $key, 'trial' ) ? 'yes' : 'no';
				?>
				<input type="hidden" name="rcp_gateway" value="<?php echo esc_attr( $key ); ?>" data-supports-recurring="<?php echo esc_attr( $recurring ); ?>" data-supports-trial="<?php echo esc_attr( $trial ); ?>"/>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>

	<?php do_action( 'rcp_after_newsletter_registration_field' ); ?>

	<?php if ( ! empty( $rcp_options['enable_terms'] ) ) : ?>
		<fieldset class="rcp_agree_to_terms_fieldset">
			<p id="rcp_agree_to_terms_wrap">
				<input type="checkbox" id="rcp_agree_to_terms" name="rcp_agree_to_terms" value="1">
				<label for="rcp_agree_to_terms">
					<?php
					if ( ! empty( $rcp_options['terms_link'] ) ) {
						echo '<a href="' . esc_url( $rcp_options['terms_link'] ) . '" target="_blank">';
					}

					if ( ! empty( $rcp_options['terms_label'] ) ) {
						echo $rcp_options['terms_label'];
					} else {
						_e( 'I agree to the terms and conditions', 'rcp' );
					}

					if ( ! empty( $rcp_options['terms_link'] ) ) {
						echo '</a>';
					}
					?>
				</label>
			</p>
		</fieldset>
	<?php endif; ?>

	<?php if ( ! empty( $rcp_options['enable_privacy_policy'] ) ) : ?>
		<fieldset class="rcp_agree_to_privacy_policy_fieldset">
			<p id="rcp_agree_to_privacy_policy_wrap">
				<input type="checkbox" id="rcp_agree_to_privacy_policy" name="rcp_agree_to_privacy_policy" value="1">
				<label for="rcp_agree_to_privacy_policy">
					<?php
					if ( ! empty( $rcp_options['privacy_policy_link'] ) ) {
						echo '<a href="' . esc_url( $rcp_options['privacy_policy_link'] ) . '" target="_blank">';
					}

					if ( ! empty( $rcp_options['privacy_policy_label'] ) ) {
						echo $rcp_options['privacy_policy_label'];
					} else {
						_e( 'I agree to the privacy policy', 'rcp' );
					}

					if ( ! empty( $rcp_options['privacy_policy_link'] ) ) {
						echo '</a>';
					}
					?>
				</label>
			</p>
		</fieldset>
	<?php endif; ?>


	<?php do_action( 'rcp_before_registration_submit_field', $levels ); ?>

	<p id="rcp_submit_wrap">
		<input type="hidden" name="rcp_register_nonce" value="<?php echo wp_create_nonce('rcp-register-nonce' ); ?>"/>
		<input type="submit" name="rcp_submit_registration" id="rcp_submit" value="<?php esc_attr_e( apply_filters ( 'rcp_registration_register_button', __( 'Register', 'rcp' ) ) ); ?>"/>
	</p>
</form>
<!-- subscription form -->
<div id="subscription-constantcontact-form">
	<?php echo do_shortcode('[ctct form="208"]');?>
</div>
