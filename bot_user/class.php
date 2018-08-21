<?php

require 'Airtable/Airtable.php';
require 'Airtable/Request.php';
require 'Airtable/Response.php';

require 'simpleHtmlDom/simple_html_dom.php';

use \TANIOS\Airtable\Airtable;

class telebot
{
	private $token;

	public function __construct($token)
	{
		$this->token = $token;
	}

	private function get($s)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $s);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$r = curl_exec($ch);

		if ( $r == NULL )
		{
			return "Error: " . curl_errno($ch) . " - " . curl_error($ch);
		} else
		{
			return $r;
		}

	}

	public function log($str)
	{
		file_put_contents('log.txt', "[" . date('M-d-y_M:i:s') ."]" . ":" . $str . "n", FILE_APPEND);
	}

	public function update_id($s)
	{
		switch ($s) {
			case 'r':
			if ( file_exists("update_id.txt") )
			{
				return file_get_contents("update_id.txt");
			} else return 0;
			break;
			
			default:
			file_put_contents("update_id.txt", $s);
			break;
		}
	}

	public function GetUpdates($offset = 0)
	{
		if ( !$this->token ) return 21;

		$r = json_decode($this->get("https://api.telegram.org/bot" . $this->token . "/getupdates?offset" . $offset), true);
		print_r($r);
		return $r['result'];
	}

	public function SMessage($w, $s, $keyboard = true)
	{
		if ( !$this->token ) return 21;

		if ( is_array($keyboard) )
		{
			$reply = json_encode(
				array(
					"keyboard"          => $keyboard,
					"resize_keyboard"   => true,
					"one_time_keyboard" => true
				)
			);

			return $this->get(
				"https://api.telegram.org/bot" . $this->token . "/sendmessage?" . 
				http_build_query(
					array(
						"chat_id" => $w,
						"text" => $s,
						"reply_markup" => $reply
					)
				)
			);
		}
		return $this->get(
			"https://api.telegram.org/bot" . $this->token . "/sendmessage?" . 
			http_build_query(
				array(
					"chat_id" => $w,
					"text" => $s
				)
			)
		);
	}

	public function airtable($name, $phone, $email, $userID, $ref_reg)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));

		$new_contact_details = array(
			'name'       => $name,
			'phone'      => $phone,
			'email'      => $email,
			'account'    => '0',
			'user_id'    => "$userID",
			'ref_link'   => 'ref' . "$userID",
			'line_one'   => '0',
			'line_two'   => '0',
			'line_tree'  => '0',
			'ref_reg'    => $ref_reg,
			'complieted' => '0'
		);
		// Save to Airtable
		$new_contact = $airtable->saveContent("Users", $new_contact_details);
	}

	public function check_account($chatID, $userID, $account)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));

		$request = $airtable->getContent("Users");

		$i = 0;

		do {
		    $response = $request->getResponse();
		    $response = json_decode($response, true);

		    // проверка на то, есть ли достаточно денег
		    if ( $response['records'][$i]['fields']['user_id'] == $userID )
		    {
		    	if ( $response['records'][$i]['fields']['account'] >= $account )
		    	{
		    		$this->SMessage($chatID, 'Укажите данные банковской каты/счета');
		    	} else
		    	{
		    		$this->SMessage($chatID, 'У Вас недостаточно средств', array( array('💳 Кошелек') ));
		    	}
		    }

		    $i++;
		}
		while( @$request = @$response->next() );
	}

	// доделать!!!!!
	public function check_ref($ref)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));	

		$request = $airtable->getContent("Users");
		
		do {
		    $response = $request->getResponse();
		    $response = json_decode($response, true);

		    if ( $ref == $response[ 'records' ][0]['fields']['ref_link'] )
		    {
		    	$line_one = $response[ 'records' ][0]['fields']['line_one'];
		    	
		    	$line_one += 1;

		    	$new_contact = $airtable->saveContent("Users", array('line_one' => $line_one));
		    }
		 

			print_r($response[ 'records' ][0]['fields']['account']);
		}
		while( @$request = @$response->next() );	
	}

	public function get_account($userID)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));

		$request = $airtable->getContent("Users");
		$i = 0;

		do {
		    $response = $request->getResponse();
		    $response = json_decode($response, true);

		    // проверка на то, есть ли достаточно денег
		    if ( $response['records'][$i]['fields']['user_id'] == $userID )
		    {
		    	return $response[ 'records' ][$i]['fields']['account'];
		    }

		    $i++;    
		}
		while( @$request = @$response->next() );	
	}

	public function ref_line($userID, $line)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));

		$request = $airtable->getContent("Users");
		$i = 0;
		do {
		    $response = $request->getResponse();
		    $response = json_decode($response, true);


		    if ( $response['records'][$i]['fields']['user_id'] == $userID )
		    {
		    	return $response['records'][$i]['fields'][$line];
		    }

		    $i++;    
		}
		while( @$request = @$response->next() );
	}

	// public function ref()
	// {

	// }

	public function oplata($id_m, $oa, $o, $secret)
	{
		$s = md5($id_m . ':' . $oa . ':' . $secret . ':' . $o);
		return "http://www.free-kassa.ru/merchant/cash.php?m=$id_m&oa=$oa&o=$o&s=$s";
	}

	public function ref_reg($userID)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));
		
		$request = $airtable->getContent("Users");
		$i = 0;
		do {
		    $response = $request->getResponse();
		    $response = json_decode($response, true);

		    if ( $response['records'][$i]['fields']['user_id'] == $userID )
		    {
		    	if ( @$response['records'][$i]['fields']['ref_reg'] != '' )
		    	{
		    		$result = $response['records'][$i]['fields']['name'] . ' | #' . $response['records'][$i]['fields']['user_id'];

		    		return $result;
		    	} else
		    	{
		    		return 'Вы не регестрировались по реферальной ссылке';
		    	}
		    }

		    $i++;    
		}
		while( @$request = @$response->next() );
	}

	public function oplata_airtable($userID)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));

		$date = date('Y-m-d H:i:s');

		$update_contact_details = array(
			'complieted'  => '1',
			'date_oplata' => "$date"
		);

		$request = $airtable->getContent("Users");
		$i = 0;
		do {
		    $response = $request->getResponse();
		    $response = json_decode($response, true);

		    if ( $response['records'][$i]['fields']['user_id'] == $userID )
		    {
		    	$id = $response['records'][$i]['id'];

		    	$update_contact = $airtable->updateContent("Users/$id", $update_contact_details);

		    	return $update_contact;
		    }

		    $i++;  
		}
		while( @$request = @$response->next() );		
	}

	public function support($chatID, $userID, $account, $cards)
	{
		$airtable = new Airtable(array(
			'api_key' => 'key6ENZShsunjefEq',
			'base'    => 'apptufLXLCGP5qd8O'
		));

		$request = $airtable->getContent("Users");
		$i = 0;
		do {
		    $response = $request->getResponse();
		    $response = json_decode($response, true);

		    if ( $response['records'][$i]['fields']['user_id'] == $userID )
		    {

		    	$account_p = $response['records'][$i]['fields']['account'];

		    	$account_k = $account_p - $account;


		    	$id = $response['records'][$i]['id'];

		    	$update_contact = $airtable->updateContent("Users/$id", array('account' => "$account_k"));

				$this->SMessage($chatID, "$userID: хочет вывести $account рублей. Его реквизиты: $cards");

		    	return $update_contact;
		    }

		    $i++;  
		}
		while( @$request = @$response->next() );
	}
}

	?>