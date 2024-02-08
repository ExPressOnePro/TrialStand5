<?php

namespace App\Services;

use App\Models\User;

class MeetingSchedulesService
{
    public static function processUsersData($data)
    {
        $processedData = [];

        foreach ($data as $key => $items) {
            // Проверяем наличие 'name' и 'value'
            if (!empty($items['name'])) {
                $userId = $items['value'] ?? null;
                if (!User::find($userId)) {
                    $processedValue = [
                        'user_id' => $userId,
                        'user_name' => $items['value'],
                    ];
                } else {
                    $userName = UserService::getUserNameById($userId);

                    // Собираем массив для 'value'
                    $processedValue = [
                        'user_id' => $userId,
                        'user_name' => $userName,
                    ];
                }
                // Добавляем элемент
                $processedData[$key] = [
                    'name' => $items['name'],
                    'value' => $processedValue,
                ];

                // Проверяем наличие 'value_2' и добавляем его, если существует
                if (isset($items['value_2'])) {
                    $userId2 = $items['value_2'] ?? null;
                    $userName2 = UserService::getUserNameById($userId2);

                    $processedData[$key]['value_2'] = [
                        'user_id' => $userId2,
                        'user_name' => $userName2,
                    ];
                }
            }
        }



        return $processedData;
    }





}
