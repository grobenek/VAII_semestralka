<?php

class User
{
    private $userId;
    private $login;
    private $isAdmin;


    public function __construct()
    {
    }

    public function setAtributes($userId, $login, $isAdmin)
    {
        $this->userId = $userId;
        $this->login = $login;
        $this->isAdmin = $isAdmin;
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return bool|string
     */
    static function getAllComments()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/user/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $users = curl_exec($curl);

        curl_close($curl);
        return json_decode($users, true);
    }

    static function getUserById($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/user/'.$id,
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

        $response = curl_exec($curl);

        if (!$response) {
            http_response_code(404);
            include('../error_page/my_404.php');
            die();
        }

        curl_close($curl);
        $decodedUsers = json_decode($response, true);

        $userToReturn = new User();
        $userToReturn->setAtributes($decodedUsers["userId"], $decodedUsers["login"], $decodedUsers["isAdmin"]);
        return $userToReturn;
    }
}