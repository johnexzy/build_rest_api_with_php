<?php
namespace Src\Layout;
/**
 * This builds a UI 
 * for the NEWS WHERE $cat represents the category, either Politics, Tech or Sports etc. Customisable.
 * 
 */
use Src\TableGateways\NewsGateway;
use Src\Logic\CheckDate;
class NewsClass{
    private  $db = null;
    private $root = null;
    private $activeId = null;
    Public $domain = null;
    public function __construct($db, $root, $id = null) {
        $this->db = $db;
        $this->root = $root;
        $this->activeId = $id;
        $this->domain =  $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
    }
    private function getJson($cat){
        if($cat == null){
            $news = new NewsGateway($this->db);
            $res = $news->getAll();

            return $res;
        }
        /**
        * Decode the response from Json to Array(Assoc)
        * $response looks like:
            [
                {
                    "id": "7",
                    "post_key": "e60e01665de1f1549f48732e5436b520",
                    "post_title": "HEROES VAGUE mschdk ksdjvd sdvdkv kdsvnsdkv ",
                    "post_body": "Lorem ipsum dolor sit am du...",
                    "post_images": "uploads/1589546287.jpg",
                    "post_category": "tech",
                    "author": "Oba John",
                    "post_short_url": "HEROES-VAGUE-mschdk-ksdjvd-sdvdkv-kdsvnsdkv-132424",
                    "created_at": "2020-05-15 13:38:07",
                    "updated_at": "2020-05-15 13:38:07",
                    "comments": []
                },
            ]
        * 
        
        */
        $news = new NewsGateway($this->db);
        $res = $news->getAllWithCategory($cat);
        
        return $res;
    }
    public function returnNews($cat) {
        /**
         * $newsLatest, $newsMain and $newsSubs are component of the NEWS UI
         * $newsLatest builds the Large Card, more like the Latest News.
         * $newsSubs builds Subsequent News after the $newsLatest. 
         * $newsMain is the build up of the UI put together.
         */
        
        $newsLatest = '';
        $newsMain = '';
        $newsSubs = '';
        $response = (array) $this->getJson($cat);
        for ($i = 0; $i < count($response); $i++) {
            $time = new CheckDate(strtotime($response[$i]["created_at"]));
            if($response[$i]["id"] == $this->activeId){
                continue;
            }
            $newsLatest .= ($i == 0) ? '
            
                <div class="card border-0 mb-4 box-shadow h-max-380">
                    <a href="http://'.$this->domain.'/view/news/'.$response[$i]["post_short_url"].
                    '" target="_blank" style="background-image: url('.$this->root.$response[$i]["post_images"].'); height: 250px;  background-size: cover;    background-repeat: no-repeat;">
                    </a>
                    <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
                        <h2 class="h4 font-weight-bold">
                            <a class="text-dark" href="http://'.$domain.'/view/news/'.$response[$i]["post_short_url"].
                            '" target="_blank">'.$response[$i]["post_title"].'</a>
                        </h2>
                        <p class="card-text">
                           '.substr($response[$i]["post_body"], 0, 22).'
                        </p>
                        <div>
                            <small class="d-block"><a class="text-muted" href="./author.html">'.$response[$i]["author"].
                            '</a></small>
                            <small class="text-muted">'.$time->checkDay().' &middot; 5 min read</small>
                        </div>
                    </div>
                </div>':'';
           $newsSubs .= ($i !== 0)? '
                    <div class="mb-3 d-flex align-items-center">
                        <a href="http://'.$this->domain.'/view/news/'.$response[$i]["post_short_url"].'" target="_blank">
                            <img height="80" width="120" src="'.$this->root.$response[$i]["post_images"].'">
                        </a>
                        
                        <div class="pl-3">
                            <h2 class="mb-2 h6 font-weight-bold">
                                <a class="text-dark" href="http://'.$this->domain.'/view/news/'.$response[$i]["post_short_url"].'" target="_blank">'
                                .$response[$i]["post_title"].
                                '</a>
                            </h2>
                            <div class="card-text text-muted small">
                                '.$response[$i]["author"].' In '.$response[$i]["post_category"].'
                            </div>
                            <small class="text-muted">'.$time->checkDay().'</small>
                        </div>
                    </div>':'';

           if($i ==3) break;
            
        }
        $newsMain = '
        <div class="container pt-4 pb-4">
            <h5 class="font-weight-bold spanborder"><span>'. strtoupper($cat).'</span></h5>
            <div class="row">
                <div class="col-lg-6">
                    '.$newsLatest.'
                </div>
                <div class="col-lg-6">
                    <div class="flex-md-row mb-4 box-shadow h-xl-300">
                        '.$newsSubs.'
                    </div>
                </div>
            </div>
        </div>
        ';
        
        return $newsMain;
    }
    public function returnAllNews() {
        $newsLatest = '';
        $newsMain = '';
        $newsSubs = '';
        $response = (array) $this->getJson(null);
        
    }
}

