<?php

class PreferencesController
{
    public function preferences()
    {
        return jsonResponse('Preferences');
    }

    public function savePreferences()
    {
        return jsonResponse('Save Preferences');
    }
}

return new PreferencesController();