<?php
use Illuminate\Database\Eloquent\Model;

class MessageService extends Model
{
    function sendCloudMessase($deviceToken = "", $message = "", $push_data = array())
    {
        $url = 'https://fcm.googleapis.com/fcm/send ';
        $serverKey = "AAAAWWwUUOc:APA91bERejUeAWrpNXBQe6oQhb-uBvD9qUTQcKs-RxlaGEla1Rv4aLvAjiGWKND2NVdfCKaiV95zIFxbGNpdoOyfIOlLlZto79WqXTIPRJGpFGKxGy8PkBbDs4frvQK3oDoD7uV2qf-7";
        $msg = array(
            'message' => $message,
            'data' => $push_data
        );
        $fields = array();
        $fields['data'] = $msg;
        if (is_array($deviceToken)) {
            $fields['registration_ids'] = $deviceToken;
        } else {
            $fields['to'] = $deviceToken;
        }
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $serverKey
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: '  .  curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
    function createTokenDevice()
    {
        // Tạo một kết nối HTTP với API FCM
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/deliveryfood-401305/registrations/DEVICE_ID/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Lấy ID thiết bị từ request
        $deviceId = $_POST['deviceId'];

        // Thực hiện yêu cầu HTTP
        $response = curl_exec($ch);

        // Giải mã phản hồi JSON
        $data = json_decode($response, true);

        // Lấy token device
        $token = $data['token'];

        // Đóng kết nối HTTP
        curl_close($ch);
        return $token;
    }
}
