<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminDashboardModel extends Model
{
    protected $table = 'product'; // Corrected table name
    protected $primaryKey = 'productID'; // Corrected primary key name
    protected $allowedFields = ['productName', 'description', 'price', 'imagePath', 'stockQuantity',  'color', 'categoryID']; // Adjusted column names


/*public function updateProduct($id, $data)
{
    // Ensure that the ID is an integer
    $id = (int)$id;

    // Validate the incoming data if needed

    // Perform the update
    $this->set($data);
    $this->where('productID', $id);
    $this->update();

    // Return the result of the update operation
    return $this->affectedRows() > 0;
}*/


    public function findAllCategories()
    {
        return $this->db->table('category')->get()->getResultArray();
    }
    


    public function findCategory($id)
    {
        return $this->db->table('category')->where('categoryID', $id)->get()->getRowArray();
    }

    public function findProduct($id)
    {
        return $this->db->table('product')->where('productID', $id)->get()->getRowArray();
    }

    /*
    ---Delete this please we are supposed to use stored procedures not query builder

    public function insertCategory($data)
    {
        return $this->db->table('category')->insert($data);
    }*/

    /*
    ---Delete this please we are supposed to use stored procedures not query builder
    public function updateCategory($id, $data)
    {
        return $this->db->table('category')->where('categoryID', $id)->update($data);
    }*/

    public function deleteCategory($id)
    {
        return $this->db->table('category')->where('categoryID', $id)->delete();
    }

    //Stored procedure to insert category into the database 
    public function insertCategory($categoryName, $imageCat)
    {
        $query = $this->query('CALL InsertCategory(?, ?)', [$categoryName, $imageCat]);
        //return $query;
    }

    //Stored procedure to update category into the database

    public function updateCategory($categoryID, $categoryName, $imageCat)
    {
        $query = $this->db->query('CALL UpdateCategory(?, ?, ?)', [$categoryID, $categoryName, $imageCat]);
        //return $query;
    }

    //Stored procedure to insert category into the database 
    public function insertProduct($productName,$description,$price,$image,$stockQuantity, $color, $categoryID)
    {
        $query = $this->query('CALL InsertProduct(?, ?, ?, ?, ?, ?, ?)', [$productName,$description,$price, $image, $stockQuantity, $color, $categoryID]);
        //return $query;
    }

    public function updateProduct($productID, $productName,$description,$price,$image,$stockQuantity, $color, $categoryID)
    {
        $query = $this->db->query('CALL UpdateProduct(?, ?, ?, ?, ?, ?, ?, ?)', [$productID,$productName,$description,$price, $image, $stockQuantity, $color, $categoryID]);
        //return $query;
    }


}
