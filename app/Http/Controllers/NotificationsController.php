<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationsController extends Controller
{
    public function getNotifsByCommerce(Request $request) {
        try {
            //PROBABLY NEED TO ORDER BY DATE FROM LATEST TO OLDEST
            $notifications = Notification::where('id_commerce', $request->id_commerce)->get();

            return response()->json(['status' => 1, 'res' => $notifications]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function storeNotification(Request $request) {
        try {
            //Store notification
            $notification = new Notification;
            $notification->id_commerce = $request->id_commerce;
            $notification->title = $request->title;
            $notification->body = $request->body;
            $notification->save();

            //Send notification to users
            $url = 'https://fcm.googleapis.com/fcm/send';
            $serverKey = env('FCM_SERVER_KEY');
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];

            $usersToSend = \DB::table('users')
            ->join('favourite_commerce_user', 'users.id', '=', 'favourite_commerce_user.id_user')
            ->where('favourite_commerce_user.id_commerce', $request->id_commerce)
            ->select('users.fcm_token')
            ->get();

            foreach ($usersToSend as $key => $user) {
                $FcmToken = $user->fcm_token;

                $data = [
                    "to" => $FcmToken,
                    "notification" => [
                        "title" => $notification->title,
                        "body" => $notification->body,
                    ]
                ];
                $encodedData = json_encode($data);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                // Disabling SSL Certificate support temporarly
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

                // Execute post
                $result = curl_exec($ch);

                if ($result === FALSE) {
                    die('Curl failed: ' . curl_error($ch));
                }

                // Close connection
                curl_close($ch);
            }

            return response()->json(['status' => 1, 'res' => $notification]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
