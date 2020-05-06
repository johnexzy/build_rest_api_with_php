<?php
namespace Src\TableGateWays;

class CommentsGateway
{
        private $db = null;
        public function __construct($db)
        {
                $this->db = $db;
        }
        public function findAllWithTag($tag)
        {
                $statement = "
                        SELECT
                                *
                        FROM
                                comment
                        WHERE tag = ?;
                ";
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array($tag));
                        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
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
                                comment
                        WHERE id = ?;
                ";
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array($id));
                        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
                        return $result;
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function insert(Array $input)
        {
                $statement = "
                        INSERT INTO comment
                                (tag, names, comments)
                        VALUES
                                (:tag, :names, :comments)
                ";
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array(
                                'tag' => $input['tag'],
                                'names' => ($input['names'] == "" || $input['names'] == null) 
                                ? "Anonymous" 
                                : $input['names'],
                                'comments' => $input['comments']
                        ));
                        return $this->findAllWithTag($input['tag']);
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function update($comId, Array $input)
        {
                $statement = "
                        UPDATE comment
                        SET
                            tag = tag,
                            names  = names,
                            comments = comments,
                        WHERE id = :id
                ";
                try {
                        $statement = $this->db->prepare($statement);
                        $statement->execute(array(
                                'id' => (int) $comId,
                                'tag' => $input['tag'],
                                'names' => $input['names'],
                                'comments' => $input['comments']
                        ));
                        return $statement->rowCount();
                } catch (\PDOException $e) {
                        exit($e->getMessage());
                }
        }
        public function delete($id)
        {
                $statement = "
                        DELETE FROM comment
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
