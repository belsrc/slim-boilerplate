<?php namespace Belsrc\Boilerplate\Helper;

class Helpers {
    /**
     * Determines if the base string contains the value.
     * @param  string $base  The base string.
     * @param  string $value The value to search for.
     * @return bool
     */
    public function contains($base, $value) {
        foreach((array)$value as $v) {
            if(!empty($v) && strpos($base, $v) !== false ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Pretty prints data.
     * @param  mixed  $array The data to print.
     * @return void
     */
    public function prettyPrint($data) {
        echo '<pre>';
        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            echo $data;
        }
        echo '</pre>';
    }

    /**
     * Returns a JSON response.
     * @param  Slim\Slim $app    The current Slim app.
     * @param  array     $data   An array of data to return as JSON.
     * @param  int       $status The return HTTP status code.
     * @return void
     */
    public function jsonResponse(\Slim\Slim $app, array $data, $status=200) {;
        $status = intval($status);
        $app->response->status($status);
        $app->response->headers->set('Cache-Control', 'no-cache, must-revalidate');
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->body(json_encode($data));
    }
}
