<?php 

// 6 кнопок
if ( $mess == '📈 Каналы' )
{
	$c->SMessage($chatID, 'Открытый новостной канал 
							{Перейти в @VSB_NEWS}',
		array( 
			array('⚡ Пригласить', '🏪 Кабинет'),
			array('📚 Обучение', '📈 Каналы'),
			array('💳 Кошелек', '❓Помощь')
		)
	);
}

if ( $mess == '📚 Обучение' )
{
	$c->SMessage($chatID, '📚 Обучение',
		array( 
			array('📚Обучение по франшизе'),
			array('📚Обучение по ставкам'),
			array('🏈Ссылки на 1xBET'),
			array('⬅ Назад')
		)
	);
}

// потом сделать ссылки!!!
if ( $mess == '🏈Ссылки на 1xBET' )
{

	$c->SMessage($chatID, 'http://refpaewc.host/L?tag=s_82413m_355c_&site=82413&ad=355

		mobile: http://refpaewc.host/L?tag=s_82413m_355c_&site=82413&ad=355&r=mobile',
		array( 
			array('⚡ Пригласить', '🏪 Кабинет'),
			array('📚 Обучение', '📈 Каналы'),
			array('💳 Кошелек', '❓Помощь')
		)
	);

}

if ( $mess == '📚Обучение по франшизе' )
{
	$c->SMessage($chatID, '№1 С чего начать.pdf: https://vk.com/doc257287018_469511673?hash=123dadbc835052c018&dl=3528d0a301d05fe456

		№2 Выйти на новый уровень.pdf: https://vk.com/doc257287018_469511598?hash=3f5fa801b718d12005&dl=98142672d819cf4ff3

		№3 Откуда брать людей.pdf: https://vk.com/doc257287018_469511735?hash=2e7e1f77160bbd5f59&dl=44b816112ffcc07567

		№4 План минимум.pdf: https://vk.com/doc257287018_469511809?hash=6d0632e37cd27b832e&dl=45056c020f70f8c1d9

		№5 Как проводить живые презентации.pdf: https://vk.com/doc257287018_469511888?hash=cdb9423774371d37d6&dl=99688ab868d62e2a03
		',
		array( 
			array('⬅ Назад')
		)
	);
}

if ( $mess == '📚Обучение по ставкам' )
{
	$c->SMessage($chatID, '1. Обучение(pdf)
2. Как делать ставку 
3. Как установить приложение на iOS 
4. Как установить приложение на андроид
---------------------------------------

1) https://vk.com/doc33078943_469111944?hash=476f625015844e219f&dl=37a613bf65d8dd713e
2) https://www.youtube.com/watch?v=a6QEXixoj9o
3) https://www.youtube.com/watch?v=OFGabxNqTqc
4) https://www.youtube.com/watch?v=gU-l1yFRpUQ',
		array( 
			array('⬅ Назад')
		)
	);
}

if ( $mess == '⬅ Назад' )
{
	$c->SMessage($chatID, 'Меню',
		array( 
			array('⚡ Пригласить', '🏪 Кабинет'),
			array('📚 Обучение', '📈 Каналы'),
			array('💳 Кошелек', '❓Помощь')
		)
	);
}

if ( $mess == '⚡ Пригласить' )
{
	$c->SMessage($chatID, "Ваша реферальная ссылка:

		https://t.me/VSB_sig_bot?start=ref$userID

		Отправьте ее человеку, которого хотите пригласить",
		array( 
			array('⚡ Пригласить', '🏪 Кабинет'),
			array('📚 Обучение', '📈 Каналы'),
			array('💳 Кошелек', '❓Помощь')
		)
	);
}

if ( $mess == '🏪 Кабинет' )
{
	$line_one  = $c->ref_line($userID, 'line_one');
	$line_two  = $c->ref_line($userID, 'line_two');
	$line_tree = $c->ref_line($userID, 'line_tree');


	$account = $c->get_account($userID);

	$ref_reg = $c->ref_reg($userID);

	$c->SMessage($chatID, "🚀 Вас пригласил:
							$ref_reg

		Данные личного кабинета:

		💰 Ваш баланс: $account р.

		---------------------

		🔹Людей в 1 линии: $line_one
		🔹Людей в 2 линии: $line_two
		🔹Людей в 3 линии: $line_tree
		",
		array( 
			array('⚡ Пригласить', '🏪 Кабинет'),
			array('📚 Обучение', '📈 Каналы'),
			array('💳 Кошелек', '❓Помощь')
		)
	);
}

if ( $mess == '💳 Кошелек' )
{
	$c->SMessage($chatID, '💳 Кошелек',
		array( 
			array('💳 Заказать выплату'),
			array('💳 Оплатить подписку'),
			array('⬅ Назад')
		)
	);
}

if ( $mess == '💳 Заказать выплату' )
{
	$_SESSION['mess_up']    = $r[$i]['update_id'] + 1;
	$_SESSION['mess_cards'] = $r[$i]['update_id'] + 2;

	$c->SMessage($chatID, 'Сколько вы хотите вывести? Отправьте только число');
}

if ( @$_SESSION['mess_up'] == $r[$i]['update_id'] )
{
	$_SESSION['account'] = $mess;
	$c->check_account($chatID, $userID, $mess);
}

if ( (@$_SESSION['mess_cards'] == $r[$i]['update_id']) and ($mess != '💳 Кошелек') )
{
	$_SESSION['cards'] = $mess;

	$c->support(-1001236515853, $userID, $_SESSION['account'], $_SESSION['cards']);

	$c->SMessage($chatID, 'Тестирование уведомления о заявке на вывод средств
Ваша заявка передана менеджеру', array( array('⬅ Назад') ));
}


if ( $mess == '💳 Оплатить подписку' )
{
	$c->SMessage($chatID, 'Продлите подписку на месяц',
		array( 
			array('Оплатить 7000'),
			array('⬅ Назад')
		)
	);	
}

if ( $mess == '❓Помощь' )
{
	$c->SMessage($chatID, 'Напишите свой вопрос @vsb_support',
		array( 
			array('⚡ Пригласить', '🏪 Кабинет'),
			array('📚 Обучение', '📈 Каналы'),
			array('💳 Кошелек', '❓Помощь')
		)
	);
}



?>