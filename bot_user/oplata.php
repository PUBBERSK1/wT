<?php 

if ( isset($mess) )
{
	if ( $mess == 'Оплатить (7000)' )
	{
	// переход на freekassa
		$oplata = $c->oplata(86530, 7000, $userID, '5gqb44kr');
		$c->SMessage($chatID, "$oplata");

	// $c->SMessage($chatID, 'Готово!', array( array('Я оплатил, что дальше?') ));
	}

	if ( $mess == 'Оплатить 7000' )
	{
	// переход на freekassa
		$oplata = $c->oplata(86530, 7000, $userID, '5gqb44kr');
		$c->SMessage($chatID, "$oplata");
	}

	if ( $oplata_true == 'oplata_true' )
	{
		$c->SMessage($chatID, 'Все прошло успешно', array( array('Я оплатил, что дальше?') ));
	}

	if ( $mess == 'Я оплатил, что дальше?' )
	{
		$c->SMessage($chatID, 'Оплата получена, приветствуем Вас в личном кабинете VSB Victory Sports Betting!',
			array( 
				array('📈 Каналы', '📚 Обучение'),
				array('🏪 Кабинет', '⚡ Пригласить'),
				array('💳 Кошелек', '❓Помощь')
			)
		);
	}
}



?>