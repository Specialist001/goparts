<?php


namespace common\helpers;

use yii\base\Object;
use Yii;
use yii\helpers\ArrayHelper;

class FirebaseNotifications extends Object
{
    public $authKey;
    public $timeout = 50;
    public $sslVerifyHost = false;
    public $sslVerifyPeer = false;
    public $apiUrl = 'https://fcm.googleapis.com/fcm/send';

    public function init()
    {
        if (!$this->authKey) throw new \Exception("Empty authKey");
    }

    public function send($body)
    {
        $headers = [
            "Authorization:key={$this->authKey}",
            'Content-Type: application/json',
            'Expect: ',
        ];
        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_SSL_VERIFYHOST => $this->sslVerifyHost,
            CURLOPT_SSL_VERIFYPEER => $this->sslVerifyPeer,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FRESH_CONNECT  => false,
            CURLOPT_FORBID_REUSE   => false,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_POSTFIELDS     => json_encode($body),
        ]);
        $result = curl_exec($ch);

        if ($result === false) {
            Yii::error('Curl failed: '.curl_error($ch).", with result=$result");
            throw new \Exception("Could not send notification..");
        }
        $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code<200 || $code>=300) {
            Yii::error("got unexpected response code $code with result=$result");
            throw new \Exception("Could not send notification");
        }
        curl_close($ch);
        $result = json_decode($result , true);
        return $result;
    }

    public function sendNotification($tokens = [], $notification, $options = [])
    {
        $body = array(
            'registration_ids' => $tokens,
            'notification' => $notification,
            //array('title' => 'Time of Sports', 'body' => 'Salman Notification'),
            //'data' => array('message' => $notification)
        );
        $body = ArrayHelper::merge($body, $options);
        return $this->send($body);
    }
}