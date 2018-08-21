<?php 

if ( $mess == 'Начать регистрацию' )
{
	$_SESSION['reg_name']  = $r[$i]['update_id'] + 1;
	$_SESSION['reg_email'] = $r[$i]['update_id'] + 3;

	$c->SMessage($chatID, 'Напишите своё Имя:');

}

if ( @$_SESSION['reg_name'] == $r[$i]['update_id'] )
{		
	$_SESSION['name'] = $mess;

	$c->SMessage($chatID, 'Напишите свой номер телефона:');
}

if ( $bot_c == 'phone_number' )
{
	$_SESSION['tel'] = $mess;

	$c->SMessage($chatID, 'Напишите свой e-mail:');
}

if ( @$_SESSION['reg_email'] == $r[$i]['update_id'] )
{
	$_SESSION['email'] = $mess;

	$c->SMessage($chatID, '(Условия пользовательского соглашения)', array( array('✅ Принять') ));
}

if ( $mess == '✅ Принять' )
{
	// регистрация в airtable
	$c->airtable($_SESSION['name'], $_SESSION['tel'], $_SESSION['email'], $userID, $_SESSION['ref']);

	$c->SMessage($chatID, 'Ваш личный кабинет готов. Для активации личного кабинета нажмите кнопку ниже. Вас переведёт на страницу, где Вы сможете оплатить.. (Оплатить 7000)', array(array('Оплатить (7000)')));
}

?>