<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use App\Models\ODPEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    private static $eventTypes = [
        'Clubbing',
        'Atelier',
        'Humour',
        'Concert',
        'Musique',
        'Danse',
        'Théâtre',
        'Conférence',
        'Enfants',
        'Sport',
        'Cinéma',
        'Loisirs',
        'Littérature',
        'Spectacle musical',
        'Balade',
        'Histoire',
        'Nature',
        'Art contemporain',
        'Expo',
        'LGBT',
        'Peinture',
        'Photo',
        'Innovation',
        'Cirque',
        'BD',
        'Sciences',
        'Solidarité',
        'Salon',
        'Street-art',
        'Gourmand',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *  Création des requêtes pour chaque types d'événement
         */
        $eventsByType = array();
        foreach (self::$eventTypes as $type) {
            $eventsByType[$type] = ODPEvent::where('tags', 'like', '%' . $type . '%');
        }

        /**
         * Lecture des données users depuis le fichier JSON
         */
        $users = json_decode(file_get_contents('database/seeders/users.json'), true);
        $users = array_slice($users, 0, 1000); // limite à 1000  users

        /**
         * Création des users
         */
        foreach ($users as $userArray) {
            /**
             * Création de l'user dans la base
             */
            $user = NULL;
            try {
                $user = User::create([
                    'name' => $userArray['prenom'] . ' ' . $userArray['nom'],
                    'email' => $userArray['nom'] . '.' . $userArray['prenom'] . '@findo.fr',
                    'age' => $userArray['age'],
                    'ville' => $userArray['ville'],
                    'password' => Hash::make("password"),
                ]);
            } catch (Exception $e) {
                error_log("Un utilisateur possède déjà cet adresse mail, pas de création");
            }

            if ($user == NULL) continue; // Si l'user n'est pas créé, ne pas executer la suite

            /**
             * Suppression des variables inutiles (i.e: les variables qui ne sont pas un couple "typeEvent" => count)
             */
            unset($userArray['id']);
            unset($userArray['prenom']);
            unset($userArray['nom']);
            unset($userArray['age']);
            unset($userArray['ville']);

            /**
             * Pour chaque type d'événements de l'utilisateur
             */
            foreach ($userArray as $type => $count) {
                $eventsToLike = $eventsByType[$type]->inRandomOrder()->limit($count * 2)->get(); // Récupère des événements aléatoire de ce type
                foreach ($eventsToLike as $event) {
                    $user->likedEvents()->attach($event->id); // Fait 'liker" l'événement par l'utilisateur
                }
            }
        }
    }
}
