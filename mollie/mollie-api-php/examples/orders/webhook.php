<?php
namespace _PhpScoper5bf6a941d2ec8;
namespace src;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*
 * Handle an order status change using the Mollie API.
 */
try
{
	/*
	* Initialize the Mollie API library with your API key or OAuth access token.
	*/
	require "../initialize.php";

	/*
	* After your webhook has been called with the order ID in its body, you'd like
	* to handle the order's status change. This is how you can do that.
	*
	* See: https://docs.mollie.com/reference/v2/orders-api/get-order
	*/
	$order = $mollie->payments->get( $_POST[ "id" ] );
	/*
	* Update the order in the database.
	*/
	if ( $order->isPaid() || $order->isAuthorized() )
	{

	}
	elseif ($payment->isOpen())
	{
		/*
		 * The payment is open.
		 */
	}
	elseif ($payment->isPending())
	{
		/*
		 * The payment is pending.
		 */
	}
	elseif ($payment->isFailed())
	{
		/*
		 * The payment has failed.
		 */
	}
	elseif ($payment->isExpired())
	{
		/*
		 * The payment is expired.
		 */
	}
	elseif ($payment->isCanceled())
	{
		/*
		 * The payment has been canceled.
		 */
	}
	elseif ($payment->hasRefunds())
	{
		/*
		 * The payment has been (partially) refunded.
		 * The status of the payment is still "paid"
		 */
	}
	elseif ($payment->hasChargebacks())
	{
		/*
		 * The payment has been (partially) charged back.
		 * The status of the payment is still "paid"
		 */
	}
} 
catch ( \Mollie\ Api\ Exceptions\ ApiException $e )
{
	echo "API call failed: " . \htmlspecialchars( $e->getMessage() );
}
?>