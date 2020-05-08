<?php
namespace Src\TableGateways;
 

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
                                $comm = $this->getComment->findAllWithTag($res["tag"]);
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
                        WHERE category = ?
                        ORDER BY id DESC;
                ";
                
                try {
                        $result = array();
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array($cat));
                        while ($res = $statement->fetch(\PDO::FETCH_ASSOC)) {
                                $comm = $this->getComment->findAllWithTag($res["tag"]);
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
                                $comm = $this->getComment->findAllWithTag($res["tag"]);
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
                $statement = "
                        INSERT INTO News
                                (headline, uploads, body, tag, Dateofpost, category, Writer)
                        VALUES
                                (:headline, :uploads, :body, :tag, :Dateofpost, :category, :Writer)
                ";
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array(
                                'headline' => $input['headline'],
                                'uploads' => $input['uploads'],
                                'body' => $input['body'],
                                'tag' => $input['tag'],
                                'Dateofpost' => $input['Dateofpost'],
                                'category' => $input['category'],
                                'Writer' => $input['Writer'],
                                
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
                                `headline` = :headline, 
                                `uploads` = :uploads, 
                                `body` = :body 
                        WHERE `News`.`id` = :id;
                ";
                
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array(
                                'id' => (int) $uid,
                                'headline' => $input['headline'],
                                'uploads' => $input['uploads'],
                                'body' => $input['body'],
                        ));
                        return $statement->rowCount();
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function delete($id)
        {
                $statement = "
                        DELETE FROM News
                        WHERE id = :id;
                ";

                try {
                        $statement=$this->db->prepare($statement);
                        $statement->execute(array('id' => $id));
                        return $statement->rowCount();
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
}
