<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class MemberModel extends Model
{
  protected $table = 'member'; // Your member table name

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

    // Check if the operation was successful
    if (count($result) > 0) {
      // The stored procedure returned data, indicating success
      return $result[0]->memberID;
    } else {
      // The stored procedure did not return data, indicating an error
      return false;
    }
  }


  public function authenticateMember($email, $password)
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
  }


  public function authenticateUser($emailOrUsername, $password)
  {
    // Call the stored procedure to authenticate user
    $query = $this->query("CALL authenticate_user(?, ?)", [$emailOrUsername, $password]);

    // Get the result
    $result = $query->getRowArray();

    // Check if the result is empty
    if (empty($result)) {
      return null; // Return null if no user is found
    }

    return $result;
  }

}

?>