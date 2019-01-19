<?php
function processMessage($update) {
    if($update["queryResult"]["action"] == "sayHello"){
        sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"Hello from webhook",
            "payload" => array(
                "items"=>[
				
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"response from host"
                         )
                    )
                ],
                ),
           
        ));
    }else if($update["queryResult"]["action"] == "convert"){
        if($update["queryResult"]["parameters"]["outputcurrency"] == "USD"){
					$amount =  intval($update["queryResult"]["parameters"]["amountToConverte"]["amount"]);
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "NGN")
						{
								$convertresult = $amount * 360;
						}
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "KWD")
						{
								$convertresult = $amount * 3.298;
						}
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "JOD")
						{
								$convertresult = $amount * 1.41044;
						}
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "EUR")
						{
								$convertresult = $amount * 1.4143;
						}
						
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "GBP")
						{
								$convertresult = $amount * 1.28767;
						}	
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "INR")
						{
								$convertresult = $amount * 0.0140619;
						}	
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "BHD")
						{
								$convertresult = $amount * 2.65957;
						}	
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "AED")
						{
								$convertresult = $amount * 0.272294;
						}	
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "QAR")
						{
								$convertresult = $amount * 0.274725;
						}	
					if ($update["queryResult"]["parameters"]["amountToConverte"]["currency"] == "SAR")
						{
								$convertresult = $amount * 0.266667;
						}	
        }
		
         sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"The conversion result in US Dollar is   ".$convertresult,
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"The conversion result is".$convertresult
                         )
                    )
                ],
                ),
           
        ));
    }else{
        sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"Error",
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"Bad request"
                         )
                    )
                ],
                ),
           
        ));
        
    }
}
 
function sendMessage($parameters) {
    echo json_encode($parameters);
}
 
$update_response = file_get_contents("php://input");
$update = json_decode($update_response, true);
if (isset($update["queryResult"]["action"])) {
    processMessage($update);
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
   fwrite($myfile, $update["queryResult"]["action"]);
    fclose($myfile);
}else{
     sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"Hello from webhook",
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"Bad request"
                         )
                    )
                ],
                ),
           
        ));
}


?>