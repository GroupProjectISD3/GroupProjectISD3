<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class StaffMemberInfo extends Model
{
  // Specify the table name
  protected $table = 'staff';

  //`staffID`, `firstname`, `lastname`, `email`, `phone`, `address1`, `address2`, `address3`, `city`, `country`, `eircode`, `hireDate`, `gender`, `title`, `jobTitle`, `role`, `passwordHash`, `salt` FROM `staff` WHERE 1

  // Define the fields that are allowed (Can be Inserted, Updated and Deleted)
  protected $allowedFields = ['staffID','firstname', 'lastname', 'email', 'phone', 'gender', 'hireDate', 'jobTitle', 'role' ];


  public function registerStaff($firstname, $lastname, $email, $phone, $address1, $address2, $address3, $city, $country, $eircode, $hireDate, $gender, $title, $jobTitle, $password)
  {
  	
    // Execute the stored procedure
    $query = $this->query("CALL InsertStaff(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
      [
        $firstname,
        $lastname,
        $email,
        $phone,
        $address1,
        $address2,
        $address3,
        $city,
        $country,
        $eircode,
        $hireDate,
        $gender,
        $title,
        $jobTitle,
        $password,
      ]
    );

    // Fetch the results (including the LAST_INSERT_ID)
    $result = $query->getResult();

    // Check if the operation was successful
    if (count($result) > 0) {
      // The stored procedure returned data, indicating success
      return $result[0]->staffID;
    } else {
      // The stored procedure did not return data, indicating an error
      return false;
    }

}


public function deleteStaff($staffID){
	$query = $this->query("CALL deleteStaff(?)",[$staffID]);

}




}
?>