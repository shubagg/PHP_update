
<?php
 
class GCM {
 
    //put your code here
    // constructor
    function __construct() {
         
    }
 
    /**
     * Sending Push Notification
     */
    public function send_notification($registatoin_ids, $message) {
        // include config
       
 
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
 
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
 //print_r($fields);
        $headers = array(
                            //   AIzaSyDTEgZfq8Qg48y5kw1QLHPSQDYk0PAyS7c old
                            //AIzaSyDZQmL2LFGiyoHuKVHB27uzCdo1cgi74UM 
                            //AIzaSyCLs5q7ElbOXZ5Xnq04vifzgHPV5f3dSFw
                            //AIzaSyDHgjQNsHsn6ZVpraPZQlfrpK0qkKxI6DM
                            
            'Authorization: key=' . AIzaSyAntWsK_cXFgvhzzNEO4yDdFEkEmZVvZlQ ,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        // Close connection
        curl_close($ch);
        //echo  $result;
      //  echo $result;
    }
 
}
 
?>