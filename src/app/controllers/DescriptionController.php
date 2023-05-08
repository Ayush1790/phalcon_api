<?php

use Phalcon\Mvc\Controller;

class DescriptionController extends Controller
{
    public function indexAction()
    {
        $isbn = $this->request->get('isbn');
        if ($isbn == 404) {
            echo "<h1>Page Not Found</h1>";
        } else {
            $url = 'https://openlibrary.org/api/books?bibkeys=ISBN:' . $isbn . '&jscmd=details&format=json';
            // Initialize a CURL session.
            $ch = curl_init();
            //grab URL and pass it to the variable.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $res = curl_exec($ch);
            $data = json_decode($res, true);
            $this->view->data = $data;
            $this->view->isbn = $isbn;
        }
    }
}
