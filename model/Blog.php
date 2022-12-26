<?php

namespace model;
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";

class Blog
{
    private $blogId;
    private $authorId;
    private $text;
    private $timestamp;

    public function __construct()
    {
    }

    public function setAtributes($blogId, $authorId, $text, $timestamp)
    {
        $this->blogId = $blogId;
        $this->authorId = $authorId;
        $this->text = $text;
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getBlogId()
    {
        return $this->blogId;
    }

    /**
     * @param mixed $blogId
     */
    public function setBlogId($blogId): void
    {
        $this->blogId = $blogId;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    static function getAllBlogs()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/blog/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $blogs = curl_exec($curl);

        curl_close($curl);

        if (!$blogs) {
            http_response_code(404);
            include('../error_page/my_404.php');
            die();
        }

        $decodedBlogs = json_decode($blogs, true);

        $blogsToReturn = [];

        foreach ($decodedBlogs as $blog) {
            $blogToAdd = new Blog();
            $blogToAdd->setAtributes($blog["blogId"], $blog["authorId"], $blog["text"], $blog["timestamp"]);
            $blogsToReturn = $blogToAdd;
        }

        return $blogsToReturn;
    }

    static function getBlogById($id)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/blog/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $blog = curl_exec($curl);

        curl_close($curl);

        if (!$blog) {
            http_response_code(404);
            include('../error_page/my_404.php');
            die();
        }

        $decodedBlog = json_decode($blog, true);

        $blogToReturn = new Blog();
        $blogToReturn->setAtributes($decodedBlog['blogId'], $decodedBlog['authorId'], $decodedBlog['text'], $decodedBlog['timestamp']);
        return $blogToReturn;
    }

}