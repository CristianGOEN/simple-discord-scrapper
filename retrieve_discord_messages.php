<?php
	if (isset($argv[1])) {
		$ch = curl_init();
		$discord_server_ID = "366690888321073175";
		$channel_ID = "806912795446607922";
		$url = "https://discord.com/api/channels/".$channel_ID."/messages";
		$headers = [
		    'Authorization: '.$argv[1]
		];

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$output = curl_exec($ch);

		curl_close($ch);      

		$json_output = json_decode($output, true);

		echo ScrappCoin($json_output);

		
	}else {
		echo "\n Falta el token de la cuenta de discord";
	}

	function ScrappCoin($output)
	{
		foreach ($output as $output_content) {
			if (preg_match('/we are pumping.*?\$(.*?)\s?\(/is', $output_content['content'], $output_scrapped)) {
				return $output_scrapped[1];
			}
		}
	}
	
?>