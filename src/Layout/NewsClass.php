<?php
namespace Src\Layout;

class NewsClass{
    
    private function getJson(String $cat){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8080/api/news/$cat");
        $response = curl_exec($ch);
        curl_close($ch);

        
        $res = (array) json_decode($response, true);
        
        return $res;
    }
    public function returnNews($cat) {
        $newsLatest = '';
        $newsMain = '';
        $newsSubs = '';
        $response = (array) $this->getJson($cat);
        
        for ($i = 0; $i < count($response); $i++) {
            $newsLatest .= ($i == 0 || $i == 2) ? '
            
                <div class="card border-0 mb-4 box-shadow h-xl-300">
                    <div style="background-image: url('.$response[$i]["post_images"].'); height: 250px;  background-size: cover;    background-repeat: no-repeat;"></div>
                    <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
                        <h2 class="h4 font-weight-bold">
                            <a class="text-dark" href="./article.html">'.$response[$i]["post_title"].'</a>
                        </h2>
                        <p class="card-text">
                           '.substr($response[$i]["post_body"], 0, 22).'
                        </p>
                        <div>
                            <small class="d-block"><a class="text-muted" href="./author.html">'.$response[$i]["author"].'</a></small>
                            <small class="text-muted">Dec 12 &middot; 5 min read</small>
                        </div>
                    </div>
                </div>':'';
           $newsSubs .= ($i !== 0)? '
                    <div class="mb-3 d-flex align-items-center">
                        <img height="80" width="120" src="'.$response[$i]["post_images"].'">
                        <div class="pl-3">
                            <h2 class="mb-2 h6 font-weight-bold">
                                <a class="text-dark" href="./article.html">'.$response[$i]["post_title"].'</a>
                            </h2>
                            <div class="card-text text-muted small">
                                '.$response[$i]["author"].' In '.$response[$i]["post_category"].'
                            </div>
                            <small class="text-muted">Dec 12 &middot; 5 min read</small>
                        </div>
                    </div>':'';
           if($i ==3) break;
            
        }
        $newsMain = '
        <div class="container pt-4 pb-4">
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
}

