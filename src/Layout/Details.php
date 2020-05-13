<?php



namespace Src\Layout;

/**
 * Get response detail and Generate View
 *
 * @author JohnOba
 */

use Src\Layout\NavBarClass;
use Src\Layout\FooterClass;
use Src\Layout\ArticleClass;
class Details {
    private $detailArray = null;
    private $root = null;
    public function __construct(Array $detailArray, String $root) {
        $this->detailArray = $detailArray;
        $this->root = $root;
    }
    //Gather all required Components and build up a view
    
    public function proccessView() {
        
        $nav = new NavBarClass($this->root, null);
        $nav = $nav->returnNavLayout();
        $body = new ArticleClass($this->detailArray, $this->root);
        $body = $body->returnLayout();
        $footer = new FooterClass;
        $footer = $footer->returnFooterLayout();
        // echo $nav.$body.$footer;
        return '<!DOCTYPE html>
                <html lang="en">
                '.$nav.$body.$footer.'
                    <script src="'.$this->root.'assets/js/vendor/jquery.min.js" type="text/javascript"></script>
                    <script src="'.$this->root.'assets/js/vendor/popper.min.js" type="text/javascript"></script>
                    <script src="'.$this->root.'assets/js/vendor/bootstrap.min.js" type="text/javascript"></script>
                    <script src="'.$this->root.'assets/js/functions.js" type="text/javascript"></script>
                </body>

                </html>
                
        ';
        
        
    }
}
