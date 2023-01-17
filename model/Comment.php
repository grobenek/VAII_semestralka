<?php
namespace model;
include_once $_SERVER["DOCUMENT_ROOT"]."/semestralka/config/dir_global.php";

class Comment
{
    private $commentId;

    private $authorId;

    private $timestamp;

    private $blogId;

    private $text;

    private $isEdited;

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
    public function setAtributes($commentId, $authorId, $timestamp, $blogId, $text, $isEdited)
    {
        $this->commentId = $commentId;
        $this->authorId = $authorId;
        $this->timestamp = $timestamp;
        $this->blogId = $blogId;
        $this->text = $text;
        $this->isEdited = $isEdited;
    }

    /**
     * @param mixed $decodedComments
     * @return array
     */
    private static function extractComments(mixed $decodedComments): array
    {
        $commentsToReturn = [];

        foreach ($decodedComments as $comment) {
            $commentToAdd = new Comment();
            $commentToAdd->setAtributes($comment["commentId"], $comment["authorId"], $comment["timestamp"], $comment["blogId"], $comment["text"], $comment["isEdited"]);
            $commentsToReturn[] = $commentToAdd;
        }

        return $commentsToReturn;
    }

    /**
     * @return mixed
     */
    public function getIsEdited()
    {
        return $this->isEdited;
    }

    /**
     * @param mixed $isEdited
     */
    public function setIsEdited($isEdited)
    {
        $this->isEdited = $isEdited;
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
     * @return false|string
     */
    public function getTimestamp()
    {
        return date("d.m.Y H:i", strtotime($this->timestamp));
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
    static function getAllComments(): array
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

        return self::extractComments($decodedComments);
    }

    static function getAllCommentsOfBlogById($id): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/comment/blog/'.$id,
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

        if ($decodedComments === null) {
            return [];
        }

        return self::extractComments($decodedComments);
    }

    /**
     * @return bool true if comment was created, else false
     */
    static function createComment($authorId, $blogId, $text) : bool
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
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
        "authorId": '.$authorId.',
        "blogId": '.$blogId.',
        "text": "'.$text.'"
    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $responseDecoded = json_decode($response, true);

        curl_close($curl);

        return is_numeric($responseDecoded['commentId']);
    }
}