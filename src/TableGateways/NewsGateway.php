<?php
namespace Src\TableGateways;

use Src\Logic\MakeImage;
use Src\TableGateWays\CommentsGateway;


class NewsGateway
{
    private $db = null;
    public $getComment = null;
    public function __construct($db)
        {
                $this->db = $db;
                $this->getComment = new CommentsGateway($db);
                
        }
        public function getAll()
        {
                $statement = "
                        SELECT
                                *
                        FROM
                                News
                        ORDER 
                            BY id DESC;
                ";
                
                try {   
                        $result = array();
                        $statement = $this->db->query($statement);
                        while ($res = $statement->fetch(\PDO::FETCH_ASSOC)) {
                                $comm = $this->getComment->findAllWithTag($res["post_key"]);
                                $res += ["comments" => $comm];
                                $result[] = $res;
                        }
                        return $result;
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }

        public function getAllWithCategory($cat)
        {
                $statement = "
                        SELECT * 
                        FROM  News
                        WHERE post_category = ?
                        ORDER BY id DESC;
                ";
                
                try {
                        $result = array();
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array($cat));
                        while ($res = $statement->fetch(\PDO::FETCH_ASSOC)) {
                                $comm = $this->getComment->findAllWithTag($res["post_key"]);
                                $res += ["comments" => $comm];
                                $result[] = $res;
                        }
                        return $result;
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function find($id)
        {
                
                $statement = "
                        SELECT
                                *
                        FROM
                                News
                        WHERE id = ?;
                ";
                try {
                        $result = null;
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array($id));
                        while ($res = $statement->fetch(\PDO::FETCH_ASSOC)) {
                                $comm = $this->getComment->findAllWithTag($res["post_key"]);
                                $res += ["comments" => $comm];
                                $result = $res;
                        }
                        return $result;
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function insert(Array $input)
        {
                $ddd = new MakeImage();
                $statement = "
                        INSERT INTO News
                                (post_title, post_body, post_images, post_key, post_category, author, post_short_url)
                        VALUES
                                (:post_title, :post_body, :post_images, :post_key, :post_category, :author, :post_short_url)
                ";
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array(
                                'post_title' => $input['post_title'],
                                'post_body' => $input['post_body'],
                                'post_images' => $ddd->makeImg($input['post_images']),
                                'post_key' => md5($input['post_title'].rand(123, 2345621)),                            
                                'post_category' => $input['post_category'],
                                'author' => $input['author'],
                                'post_short_url' => str_replace(" ", "-", $input['post_title'])
                                
                        ));
                        return $statement->rowCount();
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function update($uid, Array $input)
        {       $statement = "
                        UPDATE `News` 
                        SET 
                                `post_title` = :post_title, 
                                `post_body` = :post_body,
                                `updated_at` = CURRENT_TIMESTAMP
                        WHERE `News`.`id` = :id;
                ";
                
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array(
                                'id' => (int) $uid,
                                'post_title' => $input['post_title'],
                                'post_body' => $input['post_body']
                        ));
                        return $statement->rowCount();
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function delete($id)
        {
                $statement = "DELETE FROM `news` WHERE `news`.`id` = :id";

                try {
                        $statement=$this->db->prepare($statement);
                        $statement->execute(array('id' => $id));
                        return $statement->rowCount();
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
}
