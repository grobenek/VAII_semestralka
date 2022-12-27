<?php

namespace model;

class Picture
{
    private $pictureId;
    private $data;
    private $fileName;

    public function __construct()
    {
    }

    public function setAtributes($pictureId, $data, $fileName) {
        $this->pictureId = $pictureId;
        $this->data = $data;
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getPictureId()
    {
        return $this->pictureId;
    }

    /**
     * @param mixed $pictureId
     */
    public function setPictureId($pictureId): void
    {
        $this->pictureId = $pictureId;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @param $id
     * @return Picture|void
     */
    static function getPictureById($id)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/picture/'.$id,
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

        $picture = curl_exec($curl);

        curl_close($curl);

        if (!$picture) {
            http_response_code(404);
            include('../error_page/my_404.php');
            die();
        }

        $decodedPicture = json_decode($picture, true);

        $pictureToReturn = new Picture();
        $decodedPicture['data'] = trim($decodedPicture['data'], "\xEF\xBB\xBF");
        $pictureToReturn->setAtributes($decodedPicture['pictureId'], $decodedPicture['data'], $decodedPicture['fileName']);

        return $pictureToReturn;
    }


}