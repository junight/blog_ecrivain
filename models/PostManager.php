<?php
require 'Manager.php';
require 'Post.php';
class PostManager extends Manager
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->pdo;
    }

    /**
     * @see PostManager::count()
     */
    public function count()
    {
        return $this->db->query('SELECT id FROM post')->num_rows;
    }

    public function findAll(int $start = -1, int $limit = -1, bool $order = false)
    {
        $postsList = [];

        $sql = 'SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreation FROM news ORDER BY date_creation';

        if ($order != false) {
            $sql .= ' DESC ';
        } else {
            $sql .= ' ASC ';
        }
        if ($start != -1 || $limit != -1) {
            $sql .= 'LIMIT ' . (int) $limit . ' OFFSET ' . (int) $start;
        }
        $req = $this->db->query($sql);

        while ($data = $req->fetch()) {
            $postsList[] = new Post($data);
        }

        $req->closeCursor();

        return $postsList;
    }

    public function find(int $postId)
    {

        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreation FROM news WHERE id = :postId');

        $req->execute([
            "postId" => $postId,
        ]);

        $post[] = new Post($req->fetch());

        $req->closeCursor();

        return $post;
    }

    public function delete(int $postId)
    {

        $req = $this->db->prepare('DELETE FROM news WHERE id = ?');

        $affectedLines = $req->execute(array($postId));

        return $affectedLines;
    }

    public function add(string $title, string $content)
    {

        $req = $this->db->prepare('INSERT INTO news SET title = :title, content = :content, date_creation = NOW()');

        $affectedLines = $req->execute(array(
            "title" => $title,
            "content" => $content,
        ));

        return $affectedLines;
    }

    public function edit(string $title, string $content, int $postId)
    {

        $req = $this->db->prepare('UPDATE news SET title = :title, content = :content WHERE id = :postId');

        $affectedLines = $req->execute([
            "title" => $title,
            "content" => $content,
            "postId" => $postId,
        ]);

        return $affectedLines;

    }

}
