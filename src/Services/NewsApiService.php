<?php

namespace Services;

use jcobhams\NewsApi\NewsApi;

class NewsApiService
{
    private $newsAPI;

    public function __construct($config)
    {
        $this->newsAPI = new NewsAPI($config['key']);
    }

    public function getTopHeadlines($params)
    {
        if ($params) {
            return $this->newsAPI->getTopHeadlines(...$params);
        }
    }

    public function searchArticles($query, $params = [])
    {
        $params['q'] = $query;
        return $this->newsAPI->getEverything($params);
    }

    public function filterArticles($category = null, $dateFrom = null, $dateTo = null, $source = null, $params = [])
    {
        if ($category) {
            $params['category'] = $category;
        }

        if ($dateFrom) {
            $params['from'] = $dateFrom;
        }

        if ($dateTo) {
            $params['to'] = $dateTo;
        }

        if ($source) {
            $params['sources'] = $source;
        }

        return $this->newsAPI->getEverything($params);
    }

    public function getSources()
    {
        return $this->newsAPI->getSources(null, 'en');
    }

    public function getCategories()
    {
        return $this->newsAPI->getCategories();
    }

    public function getCountries()
    {
        return $this->newsAPI->getCountries();
    }
}