<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
    	return view("firebase");
    }

    public function sendNotification(){
    	 $token = "edL4ukAZ4vY:APA91bFgz4DFVeP29MqVayuEUvs-7Qix8buB1vI10mthr2sBahe8t7tFxfJ5ogA6FgNw3Wfyo_HyORDzlpKURPpc4m942LdscyOWloX_2Kn2CR1nwEpMxPLI5kViRIT16t_K1sbPbdZQ";  
        $from = "AAAA8Yd2lC0:APA91bFxM3fhTyZguvi1GKehVZHziuG80wJ9QH4fCUClYMq1gFeU6xNnlg2V2d9d1hr6pH6qLkEHcIY4SL1Er5zLGp9I3XwZShc21rjB69w-vqPOE2JLEpBlA13c_QhZ7kv_vpwCgDIm";
        $msg = array
              (
                'body'  => "Demo 2",
                'title' => "Hi, From Raj",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
    
    }
}
