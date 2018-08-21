<?php 

session_start();

require '../conn.php';
require '../oplata.php';

$data = $_GET;

if ( isset($data['MERCHANT_ID']) )
{
	if ( $data['MERCHANT_ID'] == 86530 )
	{
		if ( isset($data['MERCHANT_ORDER_ID']) )
		{
			if ( $data['MERCHANT_ORDER_ID'] == (string)$_SESSION['user_id_op'] )
			{
				// airtable...
				$uc = $c->oplata_airtable($_SESSION['user_id_op']);

				header('Location: https://t.me/VSB_sig_bot?start=oplata_true');
			} else
			{
				echo 'номер неверный!';

			}
		} else
		{
			echo 'Номер заказа не существует!';
		}	
	} else
	{
		echo 'ID магазина неверный!';
	}
} else
{
	echo 'ID магазина не существует!';
}







 ?>