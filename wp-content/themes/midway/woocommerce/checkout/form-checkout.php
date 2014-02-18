<?php
if (!defined('ABSPATH')) {
	exit;
}

global $woocommerce;
$woocommerce->show_messages();
do_action( 'woocommerce_before_checkout_form', $checkout );
$get_checkout_url=apply_filters('woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url());
$product=reset($woocommerce->cart->get_cart());
$related=ThemexWoo::getRelatedPost($product['product_id'], 'tour');

if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'midway' ) );
	return;
}

if(!empty($related)) {
$query=new WP_Query(array(
	'post__in' => array($related->ID), 
	'post_type' => 'tour',
));
?>
<form name="checkout" method="post" class="checkout tour-checkout clearfix" action="<?php echo esc_url( $get_checkout_url ); ?>">
	<div class="column threecol">
		<?php $query->the_post(); ?>
		<?php get_template_part('content', 'tour-grid'); ?>
	</div>
	<?php if (sizeof($checkout->checkout_fields )>0): ?>		
		<div class="column fourcol">
			<h3><?php _e('Billing Details', 'midway'); ?></h3>
			<div class="billing-details">
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				<?php do_action('woocommerce_before_order_notes', $checkout); ?>
				<?php do_action('woocommerce_after_order_notes', $checkout); ?>
				<?php if (woocommerce_get_page_id('terms')>0) : ?>
				<p class="form-row terms">
					<input type="checkbox" class="input-checkbox" name="terms" <?php if (isset($_POST['terms'])) echo 'checked="checked"'; ?> id="terms" />
					<label for="terms" class="checkbox"><?php _e('I accept the', 'midway'); ?> <a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('terms')) ); ?>" target="_blank"><?php _e('terms &amp; conditions', 'midway'); ?></a></label>
				</p>
				<?php endif; ?>
			</div>			
		</div>
	<?php endif; ?>
	<div class="column fivecol last">
		<h3><?php _e('Payment Methods', 'midway'); ?></h3>
		<div class="tour-checkout">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>		
	</div>	
</form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<?php 
} else if(file_exists(ABSPATH.'wp-content/plugins/woocommerce/templates/checkout/form-checkout.php')) {
	include(ABSPATH.'wp-content/plugins/woocommerce/templates/checkout/form-checkout.php');
}