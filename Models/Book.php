<?php
class Book
{
    private $id;
    private $language;
    private $status;
    private $number_of_copies;
    private $category;
    private $title;
    private $author;
    private $publication_date;
    

    public function __construct($title = null, $author = null, $publication_date = null, $language = null, $status = null, $number_of_copies = null, $category = null)
    {
        $this->title = $title;
        $this->author = $author;
        $this->publication_date = $publication_date;
        $this->language = $language;
        $this->status = $status;
        $this->number_of_copies = $number_of_copies;
        $this->category = $category;
    }

    public function getId()
    {
        
        return $this->id;
    }
    public function setId($id)
    {

        $this->id = $id;
    }

    public function getTitle()
    {

        return $this->title;
    }
    public function setTitle($title)
    {

        $this->title = $title;
    }

    public function getAuthor()
    {

        return $this->author;
    }
    public function setAuthor($author)
    {

        $this->author = $author;
    }

    public function getPublicationDate()
    {

        return $this->publication_date;
    }
    public function setPublicationDate($publication_date)
    {

        $this->publication_date = $publication_date;
    }

    public function getLanguage()
    {

        return $this->language;
    }
    public function setLanguage($language)
    {

        $this->language = $language;
    }

    public function getStatus()
    {

        return $this->status;
    }
    public function setStatus($status)
    {

        $this->status = $status;
    }

    public function getNumberOfCopies()
    {

        return $this->number_of_copies;
    }
    public function setNumberOfCopies($number_of_copies)
    {

        $this->number_of_copies = $number_of_copies;
    }

    public function getCategory()
    {

        return $this->category;
    }
    public function setCategory($category)
    {
        
        $this->category = $category;
    }
}