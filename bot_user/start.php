<?php 
if ( ($start_ref == '/start') and ($mess != '/start oplata_true') )
{
	$_SESSION['ref'] = mb_strtolower(mb_substr($mess, 8, 30));
	
	$c->SMessage($chatID, '👇🏻Ознакомьтесь с видео 👇🏻

		https://youtu.be/DCp3kdpVyco', array( array('✅ Я посмотрел видео') ));
}

if ( $mess == '✅ Я посмотрел видео' )
{
	$c->SMessage($chatID, 'https://vk.com/doc307470201_472367283?hash=5c9a69d763ead7f8c1&dl=56ab0a76e3f46a2d00

		☝ Ознакомьтесь с файлом ☝', array( array('✅ Ознакомился с файлом') ));			
}

if ( $mess == '✅ Ознакомился с файлом' )
{
	$c->SMessage($chatID, '👉🏻Вы можете оплатить франшизу или посмотреть ответы на вопросы:', array( array('💳 Оплатить франшизу'), array('❓ Остались вопросы') ));	

}

if ( $mess == '❓ Остались вопросы' )
{
	$c->SMessage($chatID, '🔹 Почему я должен доверять именно вам свои деньги?
		https://vk.cc/8dSiT5

		🔹 У меня нет денег
		https://vk.cc/8dClcJ

		🔹 Что ждёт VSB в ближайшее время?
		https://vk.cc/8dSjLp

		🔹 Я вообще не разбираюсь в ставках
		https://vk.cc/8dSg5f

		🔹 Я не уверен что мне это подходит
		https://vk.cc/8dSh77

		🔹 Я не умею продавать
		https://vk.cc/8dShnM

		🔹 Я слышал ставки это развод
		https://vk.cc/8dSgyC

		🔹 Я считаю что вы пирамида
		https://vk.cc/8dSgQ0

		🔹 А если при переводе денег вы заблокируете меня?
		https://vk.cc/8dSkjy

		🔹 В чем ваше преимущество перед другими?
		https://vk.cc/8dSimY

		🔹 Зарабатывает только верхушка
		https://vk.cc/8dSfOf

		🔹 Здесь нужно навязываться к людям и уговаривать их
		https://vk.cc/8dSfn0

		🔹 Каким образом компания может выплачивать столько денег рефералам?
		https://vk.cc/8dCmFW

		🔹 Мой друг занимался, у него не получилось
		https://vk.cc/8dCn5b

		🔹Если Вы не нашли ответ на нужный вопрос, напишите в тех поддержку компании @VSB_SUPP', array( array('❓ Остались вопросы'), array('💳 Оплатить франшизу' )));
}

if ( $mess == '💳 Оплатить франшизу' )
{
	$c->SMessage($chatID, '🎉Отлично, Ваш ID: ' . $userID, array( array('Начать регистрацию') ));
}