<?php

use Phalcon\Mvc\Controller;

class SearchController extends Controller
{
    public function indexAction()
    {
        $name = $this->request->getPost('search');
        $name = str_replace(" ", "+", $name);
        $url = 'https://openlibrary.org/search.json?q=' . $name . '&mode=ebooks&has_fulltext=true';
        // Initialize a CURL session.
        $ch = curl_init();

        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $res = curl_exec($ch);
        $data = json_decode($res, true);
        $this->view->data = $data;
    }
}
