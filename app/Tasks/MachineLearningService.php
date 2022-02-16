<?php

namespace App\Tasks;

use App\Models\User;
use Database\Seeders\UserSeeder;

class MachineLearningService
{
    public function __invoke()
    {
        $users = User::all();

        $usersArray = array();

        foreach ($users as $user) {

            $userArray = array();
            $userArray['id'] = $user->id;
            $userArray['age'] = $user->age;
            $userArray['ville'] = $user->ville;

            foreach (UserSeeder::$eventTypes as $eventType) {
                $userArray[$eventType] = 0;
            }

            foreach ($user->likedEvents as $event) {
                $tags = explode(';', $event->tags);
                foreach ($tags as $tag) {
                    $userArray[$tag] = $userArray[$tag] + 1;
                }
            }
            array_push($usersArray, $userArray);
        }
        $usersJSON = json_encode($usersArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        dump($usersJSON);
    }
}
