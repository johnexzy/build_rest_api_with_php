<?php
namespace Src\Controller\ViewController;


use Src\Layout\Details;
use Src\TableGateways\CarouselGateway;
use Src\TableGateways\NewsGateway;
class ViewController
{
    private $db = null;
    private $short_url = null;
    private $id = null;
    private $root = null;
    private $group = null;
    public function __construct($db, $short_url, $id, $root, $group)
    {
        $this->db = $db;
        $this->short_url = $short_url;
        $this->id = $id;
        $this->root = $root;
        $this->group = $group;
    }

    public function makeRequest()
    {
        /*
         * You can consume this api end point using file_get_contents or using cURL.
         * $res = file_get_contents("http://127.0.0.1:8080/api/$this->group/$this->short_url", true, null);
         * $res = (array) json_decode($res, true);
         * return $res
         **** this should probably be done outside this origin, may on a different domain, scheme, or port
         */
        if ($this->group == 'carousel') {
            $carousel = new CarouselGateway($this->db);
            $res = $carousel->findByUrl($this->short_url);
        }
        elseif ($this->group == 'news') {
            $news = new NewsGateway($this->db);
            $res = $news->findByUrl($this->short_url);
        }
        return $res;
    }
    public function showView() {
        $detail = new Details($this->makeRequest(), $this->root, $this->db);
        return $detail->proccessView($this->group);
        
    }
}

