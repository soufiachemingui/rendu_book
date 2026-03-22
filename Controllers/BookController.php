<?php
include_once(_DIR_ . '/../config.php');
include_once(_DIR_ . '/../Models/Book.php');
include_once(_DIR_ . '/../Models/Category.php');

class BookController
{
    public function addBook(Book $book)
    {
        $sql = "INSERT INTO book (title, author, publication_date, language, status, number_of_copies, category_id) 
                VALUES (:title, :author, :publication_date, :language, :status, :number_of_copies, :category_id)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'publication_date' => $book->getPublicationDate(),
                'language' => $book->getLanguage(),
                'status' => $book->getStatus() ? 1 : 0,
                'number_of_copies' => $book->getNumberOfCopies(),
                'category_id' => $book->getCategory() ? $book->getCategory()->getId() : null
            ]);
        }
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listBooks()
    {
        $sql = "SELECT b.*, c.title as category_title, c.description as category_description 
                FROM book b 
                LEFT JOIN category c ON b.category_id = c.id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $booksData = $query->fetchAll();

            $books = [];
            foreach ($booksData as $row) {
                $category = new Category($row['category_title'], $row['category_description']);
                if (isset($row['category_id'])) {
                    $category->setId($row['category_id']);
                }

                $book = new Book(
                    $row['title'],
                    $row['author'],
                    $row['publication_date'],
                    $row['language'],
                    $row['status'],
                    $row['number_of_copies'],
                    $category
                    );
                $book->setId($row['id']);

                $books[] = $book;
            }
            return $books;
        }
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function deleteBook($id)
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function getBookById($id)
    {
        $sql = "SELECT b.*, c.title as category_title, c.description as category_description 
                FROM book b 
                LEFT JOIN category c ON b.category_id = c.id 
                WHERE b.id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $row = $query->fetch();

            if ($row) {
                $category = new Category($row['category_title'], $row['category_description']);
                if (isset($row['category_id'])) {
                    $category->setId($row['category_id']);
                }

                $book = new Book(
                    $row['title'],
                    $row['author'],
                    $row['publication_date'],
                    $row['language'],
                    $row['status'],
                    $row['number_of_copies'],
                    $category
                    );
                $book->setId($row['id']);
                return $book;
            }
        }
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return null;
    }

    public function updateBook(Book $book, $id)
    {
        $sql = "UPDATE book SET 
                title = :title, 
                author = :author, 
                publication_date = :publication_date, 
                language = :language, 
                status = :status, 
                number_of_copies = :number_of_copies, 
                category_id = :category_id 
                WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'publication_date' => $book->getPublicationDate(),
                'language' => $book->getLanguage(),
                'status' => $book->getStatus() ? 1 : 0,
                'number_of_copies' => $book->getNumberOfCopies(),
                'category_id' => $book->getCategory() ? $book->getCategory()->getId() : null,
                'id' => $id
            ]);
        }
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
