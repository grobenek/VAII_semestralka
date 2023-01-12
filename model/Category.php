<?php

namespace model;

class Category
{
    private $categoryId;
    private $categoryName;
    private $blogId;

    public function __construct()
    {
    }

    public function setAtributes($categoryId, $categoryName, $blogId)
    {
        $this->blogId = $blogId;
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param mixed $categoryName
     */
    public function setCategoryName($categoryName): void
    {
        $this->categoryName = $categoryName;
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

    static function getCategoriesByBlogId($blogId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/api/category/blog/'.$blogId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $categories = curl_exec($curl);

        curl_close($curl);

        if (!$categories) {
            http_response_code(404);
            include('../error_page/my_404.php');
            die();
        }

        $decodedCategories = json_decode($categories, true);

        if ($decodedCategories == null) {
            return [];
        }

        $categoriesToReturn = [];

        foreach ($decodedCategories as $category) {
            $categoryToAdd = new Category();
            $categoryToAdd->setAtributes($category['categoryId'], $category['categoryName'], $category['blogId']);
            $categoriesToReturn[] = $categoryToAdd;
        }

        return $categoriesToReturn;
    }
}