<?php

class Comment
{
    private $commentId;

    private $authorId;

    private $timestamp;

    private $blogId;

    private $text;

    public function __construct()
    {

    }

    /**
     * @param $commentId
     * @param $authorId
     * @param $timestamp
     * @param $blogId
     * @param $text
     */
    public function setAtributes($commentId, $authorId, $timestamp, $blogId, $text)
    {
        $this->commentId = $commentId;
        $this->authorId = $authorId;
        $this->timestamp = $timestamp;
        $this->blogId = $blogId;
        $this->text = $text;
    }


    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param mixed $commentId
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
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
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
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
    public function setTimestamp($timestamp)
    {
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
    public function setBlogId($blogId)
    {
        $this->blogId = $blogId;
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
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return array
     */
    static function getAllComments()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/comment/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $comments = curl_exec($curl);

        curl_close($curl);

        if (!$comments) {
            http_response_code(404);
            include('../error_page/my_404.php');
            die();
        }

        $decodedComments = json_decode($comments, true);

        $commentsToReturn = [];

        foreach ($decodedComments as $comment) {
            $commentToAdd = new Comment();
            $commentToAdd->setAtributes($comment["commentId"], $comment["authorId"], $comment["timestamp"], $comment["blogId"], $comment["text"]);
            $commentsToReturn[] = $commentToAdd;
        }

        return $commentsToReturn;
    }
}