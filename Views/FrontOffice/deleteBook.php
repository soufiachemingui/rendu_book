<?php
include '../../Controllers/BookController.php';

if (isset($_GET['id'])) {
    $bookController = new BookController();
    $bookController->deleteBook($_GET['id']);
}

header('Location: bookList.php');
exit;