<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class MemberModel extends Model
{
  protected $table = 'member'; 

  public function registerMember($firstName, $lastName, $userName, $email, $password)
  {
    // Execute the stored procedure
    $query = $this->query("CALL insertmember(?, ?, ?, ?, ?)",
      [
        $firstName,
        $lastName,
        $userName,
        $email,
        $password
      ]
    );

    // Fetch the results (including the LAST_INSERT_ID)
    $result = $query->getResult();

    //log_message('debug', 'registerMember result: ' . print_r($result, true));

    // Check if the operation was successful
    if (count($result) > 0) {
      // The stored procedure returned data, indicating success
      return $result[0];
    } else {
      // The stored procedure did not return data, indicating an error
      return false;
    }
  }


  /*public function authenticateMember($email, $password)
  {
    // Execute the stored procedure
    $query = $this->query("CALL authenticate_member(?, ?)",
      [
        $email,
        $password,
      ]
    );

    // Fetch the results
    $result = $query->getResult();

    // Check if the operation was successful
    if (count($result) > 0) {
      // The stored procedure returned data, indicating success
      return [
        'memberID' => $result[0]->memberID,
        'email'    => $result[0]->email,
        'role'     => $result[0]->role,
      ];
    }else{
      // The stored procedure did not return data, indicating an error
      return false;
    }
  }*/


  public function authenticateUser($emailOrUsername, $password)
  {
    // Call the stored procedure to authenticate user
    $query = $this->query("CALL authenticate_user(?, ?)", [$emailOrUsername, $password]);

    // Fetch the results (including the id, firstName, lastName, etc.)
    $result = $query->getResult();

    // Check if the operation was successful
    if (count($result) > 0) {
      // The stored procedure returned data, indicating success
      return $result[0];
    } else {
      // The stored procedure did not return data, indicating an error
      return null; // Return null if no user is found
    } 
  }

  public function get_all_categories() {
    $query = $this->query("CALL GetAllCategories()");

    if ($query->getNumRows() > 0){

      return $query->getResultArray();
    }else{

      return false;
    }
  }


  public function get_products_by_category($category_id) {
      $query = $this->query("CALL GetProductsByCategory(?)", [$category_id]);
      
      if ($query->getNumRows() > 0) {
        return $query->getResultArray();
      } else {
        return false;
      }
  }

  public function getLastAddress($memberID)
  {
    return $this->query("CALL GetLastAddress(?)", $memberID)->getRowArray();
  }

  public function get_products_by_id($product_id) {
      $query = $this->query("CALL GetProductByID(?)", [$product_id]);
      
      if ($query->getNumRows() > 0) {
        return $query->getResultArray();
      } else {
        return false;
      }
  }

  public function insertPayment($orderID, $paymentDate, $totalAmount, $status) {
    $sql = "CALL InsertPayment(?, ?, ?, ?)";
    $this->query($sql, array($orderID, $paymentDate, $totalAmount, $status));
  }

  public function insertMemberAddress($memberID, $address1, $address2, $address3, $city, $county, $eircode)
  {
    $query = $this->query('CALL insertmemberAddress(?, ?, ?, ?, ?, ?, ?)', [$memberID, $address1, $address2, $address3, $city, $county, $eircode]);
  }


}

?>