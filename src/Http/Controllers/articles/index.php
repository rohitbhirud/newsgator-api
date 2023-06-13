<?php

class ArticlesController
{
    function index()
    {
        return jsonResponse('Test response');
    }
}

return new ArticlesController();