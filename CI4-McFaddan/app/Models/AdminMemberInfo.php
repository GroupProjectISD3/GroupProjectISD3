<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class AdminMemberInfo extends Model
{
  // Specify the table name
  protected $table = 'member';

  // Define the fields that are allowed (Can be Inserted, Updated and Deleted)
  protected $allowedFields = ['memberID', 'firstName', 'lastName', 'userName', 'email'];


  public function getCustomer($id)
  {
    // Call the stored procedure
    $query = $this->query("CALL GetMemberAddresses(?)", [$id]);

        // Check if a record is found
        if ($query->getNumRows() > 0) {
            // Map the row to an associative array and return it
            return $query->getResultArray();
        }

        return []; // or an empty array, depending on your preference
  }

  
  public function getCategoryWithMostPayments()
  {
    $query = $this->query("CALL GetCategoryWithMostPayments()");
    return $query->getResultArray();  // Use getResultArray() instead of getRowArray()
  }

  public function countMembers()
  {
    $query = $this->query('CALL CountMembers()');
    $result= $query->getRow();

    $memberCount = isset($result->TotalMembers) ? $result->TotalMembers : 0;

    return $memberCount;
  }

  public function countStaffs()
  {
    $query = $this->query('CALL CountStaffs()');
    $result= $query->getRow();

    // Extract the count value from the object
    $staffCount = isset($result->TotalStaffs) ? $result->TotalStaffs : 0;

    return $staffCount;
  }

  public function calculateTotalSuccessfulPayments()
  {
    $query = $this->db->query('CALL CalculateTotalSuccessfulPayments()');
    $result = $query->getRow();

    // Format the result as currency with euros and commas
    $formattedResult = '€' . number_format($result->TotalSuccessfulPayments, 2, '.', ',');

    return $formattedResult;
  }


  
}

?>