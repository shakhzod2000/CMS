<?php

namespace App\Repository; //namespace is directories

use PDO;
use App\Model\PageModel; //use is for class

class PagesRepository {
    public function __construct(private PDO $pdo) {}

    public function fetchForNavig(): array {
        return $this->get();
    }

    public function get() {
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` ORDER BY `id` ASC');
        $stmt->execute();
        $entries = $stmt->fetchAll(PDO::FETCH_CLASS, PageModel::class);
        return $entries;
    }

    public function slugExists(string $slug): bool {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) AS `count` FROM `pages` WHERE `slug` = :slug');
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $slugCount = $res['count'];
        return $slugCount >= 1;
    }

    public function insert(string $title, string $slug, string $content): bool {
        $stmt = $this->pdo->prepare('INSERT INTO `pages` (`title`, `slug`, `content`) VALUES (:title, :slug, :content)');
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':slug', $slug);
        $stmt->bindValue(':content', $content);
        return $stmt->execute();
    }

    public function delete(int $id) {
        var_dump($id);
        $stmt = $this->pdo->prepare('DELETE FROM `pages` WHERE `id`=:id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function fetchBySlug(string $slug): ?PageModel {
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` WHERE `slug` = :slug');
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);
        $entry = $stmt->fetch(); //fetch 1st entry
        if (!empty($entry)) return $entry;
        else return null;
        //when we fetchAll entries, we don't need 'setFetchMode'
        // $entry = $stmt->fetchAll(PDO::FETCH_CLASS, PageModel::class);
    }
}