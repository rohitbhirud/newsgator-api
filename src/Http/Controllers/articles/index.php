<?php

use Core\App;
use Services\NewsApiService;

class ArticlesController
{
    public NewsApiService $newsApi;


    public function __construct()
    {
        $this->newsApi = App::resolve(NewsApiService::class);
    }

    /**
     * Get articles based on provided parameters.
     */
    function index()
    {
        if (!$_GET) {
            return jsonResponse('Provide atleast one of these paramteres : source, category, q, language, country, from, to', null, null, 400);
        }

        $params = [];

        foreach ($_GET as $key => $value) {
            $params[$key] = $value;
        }

        try {
            $articles = $this->newsApi->getTopHeadlines($params);
        } catch (\Throwable $th) {
            return jsonResponse('Error occured', null, json_encode($th));
        }

        return jsonResponse('success', $articles);
    }

    /**
     * Get available categories.
     */
    function getCategories()
    {
        try {
            $cats = $this->newsApi->getCategories();
        } catch (\Throwable $th) {
            return jsonResponse('Error occured', null, json_encode($th));
        }

        return jsonResponse('success', $cats);
    }

    /**
     * Get available sources.
     */
    function getSources()
    {
        try {
            $sources = $this->newsApi->getSources();
        } catch (\Throwable $th) {
            return jsonResponse('Error occured', null, json_encode($th));
        }

        return jsonResponse('success', $sources);
    }

    /**
     * Get available countries.
     */
    function getCountries()
    {
        try {
            $countries = $this->newsApi->getCountries();
        } catch (\Throwable $th) {
            return jsonResponse('Error occured', null, json_encode($th));
        }

        return jsonResponse('success', $countries);
    }
}

return new ArticlesController();