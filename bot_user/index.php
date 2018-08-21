<?php session_start(); ?>
<pre>
<?php

require 'conn.php';

$r = $c->GetUpdates($c->update_id('r'));


foreach ( $r as $i => $v )
{
	if ( $c->update_id('r') < $r[$i]['update_id'] )
	{
		$c->update_id($r[$i]['update_id']);

		$chatID  = $r[$i]['message']['chat']['id'];
		$name    = $r[$i]['message']['from']['first_name'];
		$userID  = $r[$i]['message']['from']['id'];
		$mess    = $r[$i]['message']['text'];
		@$bot_c  = $r[$i]['message']['entities'][0]['type'];

		$_SESSION['user_id_op'] = $userID;

		$start_ref = mb_strtolower(mb_substr($mess, 0, 6));

		$oplata_true = mb_strtolower(mb_substr($mess, 7, 17));

		$name_user  = mb_strtolower(mb_substr($mess, 0, 4));
		$tel_user   = mb_strtolower(mb_substr($mess, 0, 8));
		$email_user = mb_strtolower(mb_substr($mess, 0, 7));

		require 'start.php';

		require 'reg.php';

		require 'oplata.php';

		require 'menu.php';
	}
}

?>

<a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/17.png"></a>
