<?php
namespace Src\Controller\ViewController;


use Src\Layout\Details;
//use Src\Controller\CarouselController;
class ViewController
{
    private $short_url = null;
    private $id = null;
    private $root = null;
    private $group = null;
    public function __construct($short_url, $id, $root, $group)
    {
        $this->short_url = $short_url;
        $this->id = $id;
        $this->root = $root;
        $this->group = $group;
    }

    public function makeRequest()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8080/api/$this->group/$this->short_url");
        $response = curl_exec($ch);
        curl_close($ch);

        
        $res = (array) json_decode($response, true);
        
        return $res;
    }
    public function showView() {
        $detail = new Details($this->makeRequest(), $this->root);
        return $detail->proccessView($this->group);
        
    }
}

