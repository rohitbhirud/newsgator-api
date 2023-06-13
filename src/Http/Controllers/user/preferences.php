<?php

use Core\Session;
use Core\App;
use Core\Database;

class PreferencesController
{
    public function preferences()
    {
        $user = Session::get('user');

        if (!$user) {
            return jsonResponse('Unauthorized', null, null, 403);
        }

        $db = App::resolve(Database::class);

        $pref = $db->get(
            'preferences',
            ['sources', 'categories', 'authors']
            ,
            ['user_id' => $user['id']]
        );

        if (!$pref) {
            return jsonResponse('No preferences found', null, null, 404);
        }

        return jsonResponse('success', $pref);
    }

    public function savePreferences()
    {
        $user = Session::get('user');

        if (!$user) {
            return jsonResponse('Unauthorized', null, null, 403);
        }

        $db = App::resolve(Database::class);

        // Retrieve the preferences data from the request
        $sources = $_POST['sources'] ?? null;
        $categories = $_POST['categories'] ?? null;
        $authors = $_POST['authors'] ?? null;

        // Prepare the preferences data
        $preferences = [
            'user_id' => $user['id'],
            'sources' => $sources,
            'categories' => $categories,
            'authors' => $authors
        ];

        // Save the preferences to the database
        $db->insert('preferences', $preferences);

        return jsonResponse('Preferences saved');
    }
}

return new PreferencesController();