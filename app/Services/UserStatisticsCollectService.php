<?php

namespace App\Services;

use App\Models\BlogUserStatistic;
use Illuminate\Support\Facades\DB;

class UserStatisticsCollectService
{
    public function saveUserData($ip, $agent, $is_session)
    {

        if (!$is_session) {
           session(['session_start' => 'ok']);
            // запис користувача для кожної нової сессії
            $arr_browsers = ["Firefox", "Chrome", "Safari", "Opera", "MSIE", "Trident", "Edge"];
            $user_browser = '';
            foreach ($arr_browsers as $browser) {
                if (strpos($agent, $browser) !== false) {
                    $user_browser = $browser;
                    break;
                }
            }
            switch ($user_browser) {
                case 'Trident':
                case 'Edge':
                case 'MSIE':
                    $user_browser = 'Internet Explorer';
                    break;
                case '':
                    $user_browser = 'Невідомий';
                    break;
            }
            $userData = new BlogUserStatistic();
            $userData->ip = $ip;
            $userData->browser = $user_browser;
            $userData->save();
        }
    }

}
