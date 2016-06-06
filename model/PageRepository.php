<?php
namespace Model;

class PageRepository
{
    /**
     * @var \PDO
     */
    private $PDO;

    /**
     * PageRepository constructor.
     * @param \PDO $PDO
     */
    public function __construct(\PDO $PDO)
    {
        $this->PDO = $PDO;
    }
    /**
     * @param null $id
     * @return array
     */
    public function lister($id = null)
    {
        $sql = " SELECT `id`,`slug`,`title`
         FROM `page`";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $data;
    }
    /**
     * @param array $data
     * @return bool
     */
    public function modifier(array $data, $id)
    {
        $sql = "UPDATE`page`
                SET`slug` = :slug,
                    `h1` = :h1,
                    `title` = :title,
                    `body` = :body
                  
                WHERE`id` = :id
                ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':slug', $data['slug'], \PDO::PARAM_STR);
        $stmt->bindParam(':h1', $data['h1'], \PDO::PARAM_STR);
        $stmt->bindParam(':title', $data['title'], \PDO::PARAM_STR);
        $stmt->bindParam(':body', $data['body'], \PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function supprimer($id)
    {
        $sql = "DELETE FROM 
              `page`
              WHERE 
              id = :id";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return true;

    }

    /**
     * @param array $data
     * @return int
     */
    public function ajouter(array $data = null)
    {

        $sql = "INSERT INTO 
                    `page`(slug, title, h1, body)
                    
                VALUES 
                 (:slug, :title, :h1, :body)
                ";
        $stmt=$this->PDO->prepare($sql);
        $stmt->bindParam(':slug', $data['slug'], \PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title'], \PDO::PARAM_INT);
        $stmt->bindParam(':h1', $data['h1'], \PDO::PARAM_INT);
        $stmt->bindParam(':body', $data['body'], \PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param $slug
     * @return stdClass|bool
     */
    public function getBySlug($slug)
    {

        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':slug', $slug, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    /**
     * @param $id
     * @return \stdClass|bool
     */
    public function getById($id)
    {
        $sql = "SELECT 
                    `id`, 
                    `slug`, 
                    `body`, 
                    `title` 
                FROM 
                    `page` 
                WHERE 
                    `id` = :id
                ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function findAll()
    {
        $sql = "SELECT 
                    `id`,
                    `slug`,
                    `title`
                FROM 
                    `page`
                ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}