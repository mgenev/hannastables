<?php
/**
 * Customer invoice email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<?php if ($order->status=='pending') : ?>

	<p><?php printf( __( 'An order has been created for you on %s. To pay for this order please use the following link: %s', 'woocommerce' ), get_bloginfo( 'name' ), '<a href="' . $order->get_checkout_payment_url() . '">' . __( 'pay', 'woocommerce' ) . '</a>' ); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_email_before_order_table', $order, false); ?>

<h2><?php echo __( 'Order:', 'woocommerce' ) . ' ' . $order->get_order_number(); ?> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( woocommerce_date_format(), strtotime( $order->order_date ) ) ); ?>)</h2>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			switch ( $order->status ) {
				case "completed" :
					echo $order->email_order_items_table( $order->is_download_permitted(), false, true );
				break;
				case "processing" :
					echo $order->email_order_items_table( $order->is_download_permitted(), true, true );
				break;
				default :
					echo $order->email_order_items_table( $order->is_download_permitted(), true, false );
				break;
			}
		?>
	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
					</tr><?php
				}
			}
		?>
	</tfoot>
</table>

<?php do_action('woocommerce_email_after_order_table', $order, false); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, false ); ?>

<?php do_action('woocommerce_email_footer'); ?>

<h3>Hello!</h3>

<p>Thank you for booking your next adventure with Hanna Stables and Nabitunich in beautiful Belize. This is your official confirmation email. Please print this out and bring it with you to Belize.</p>

<h3>Remaining Balance Due</h3>

<p>As a reminder, you have only paid a 15% online deposit to reserve your activity with us. Please note that the remaining balance as included in this email must be paid upon arrival. We accept payment via cash (USD or Belize dollars) or credit card.</p>
 
<h3>Transportation</h3>
<p>If you have arranged transportation with us, please look for your driver at the meeting place you specified. Your driver will be holding a sign with your name on it. Ask your driver to call Santiago at +501 661-1536 if they have any questions.</p>
<h3>Directions</h3>
<p>The best way to get to Nabitunich is to take a taxi from either downtown San Ignacio or the Guatemala border. All taxi drivers in the area should know where we are. Simply ask the driver to take you to Nabitunich or Hanna Stables (they are located in the same area).</p>

<p>If you are coming from San Ignacio, drive about 10 miles down the Western Highway. Continue on the highway, passing signs to Black Rock Lodge, Clarissa Falls, and Chaa Creek. Right before you hit a downhill slope leading to the hand cranked ferry to Xunantunich, you should see a stone sign on your right hand sign reading "Nabitunich." Follow the dirt road to the very end where you will see the stables on your left and the cottages straight ahead.</p>

<p>If you are coming form the Guatemala border, drive down the Western Highway until you pass the hand cranked ferry to Xunantunich. After you climb up a hill, be on the lookout for a sign reading "Nabitunich" on your left hand sign. Turn down the dirt road and follow it to the very end.</p>


<h3>IMPORTANT - Please note our Cancellation Policy:</h3>
<p>All bookings must be cancelled with at least 48 hrs notice.<br>
Bookings cancelled with less than 48 hrs notice will be charged the greater of 1 nights stay or 50% of the total amount due.<br>
Bookings cancelled with less than 24 hrs notice, or ‘no show’ guests will be charged the total amount due.<br>
If you should need to cancel, please send us an email immediately at <a href="mailto:info@hannastables.com">info@hannastables.com</a><br>
No guests allowed in any of our rooms that have not been checked in at reception.<br>

<p>*If you run into any issues on the ground, please call Santiago at +501 661-1536 for immediate assistance.<br>
If there is anything you would like to know about Belize, please do not hesitate to get in touch or visit <a href="www.hannastables.com">www.hannastables.com</a> to see our tours & activities page and to read more about us. Please let us know if you need any travel advice prior to your arrival. Our friendly and knowledgeable team are on hand to advise you where to go and what to do, so relax, and know you'll be in good hands when you arrive!</p>
 
<p>Cheers, <br>
Your Hosts at Hanna Stables and Nabitunich <br>
<a href="www.hannastables.com">www.hannastables.com</a></p>
 
<p>Let's connect on Facebook: <a href="https://www.facebook.com/HannaStables">Hanna Stables</a></p>