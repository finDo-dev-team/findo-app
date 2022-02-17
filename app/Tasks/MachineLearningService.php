<?php

namespace App\Tasks;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Http;

class MachineLearningService
{
    public function __invoke()
    {
        /*
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

        $response = Http::post(config('findoml.api_url'), [
            'user_data' => $usersJSON,
        ]);
        */
        $users_clusters = json_decode(file_get_contents('app/Tasks/raw_response.json'), true);
        foreach ($users_clusters as $user_cluster) {
            $user = User::find($user_cluster['user_id']);
            $user->cluster = $user_cluster['labels'];
            $user->save();
        }
    }
}
