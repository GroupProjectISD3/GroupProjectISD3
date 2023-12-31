<?php
namespace App\Models;
use CodeIgniter\Model;

class CartModel extends Model{
	protected $table = 'orderdetail';

	public function addToCart($memberID, $productID, $quantity)
  {
    $query = $this->query("CALL AddToCart(?, ?, ?)", [$memberID, $productID, $quantity]);

    $result = $query->getResult();
    if (count($result) < 0) {
      return false;
    }
  }

  public function findProduct($product_id)
  {
      
    $query = $this->query("CALL GetProductByID(?)", [$product_id]);

    if ($query->getNumRows() > 0) {
    	return $query->getRowArray();
    }
    else{
      return false;
    }
  }

  public function getCartFromDatabase($id)
  {
  	$query = $this->query("CALL GetCart(?)", [$id]);
  	return $query->getResultArray();
  }

	public function deleteFromCart($id, $productID)
	{
    return $this->query("CALL DeleteFromCart(?, ?)", [$id, $productID]);
	}

  public function updateQuantityInCart($memberID, $productID, $quantity)
  {
      $query = $this->query("CALL UpdateQuantityInCart(?, ?, ?)", [$memberID, $productID, $quantity]);
      $result = $query->getResult();
      if (count($result) < 0) {
          return false;
      }
  }


  public function addToWishlist($memberID, $productID)
  {
    $query = $this->query("CALL AddToWishlist(?, ?)", [$memberID, $productID]);
    $result = $query->getResult();
    if (count($result) < 0) {
      return false;
    }
  }

  public function deleteFromWishlist($memberID, $productID)
  {
    return $this->query("CALL DeleteFromWishlist(?, ?)", [$memberID, $productID]);
  }

  public function getWishlistFromDatabase($memberID)
  {
    $query = $this->query("CALL GetWishlist(?)", [$memberID]);
    return $query->getResultArray();
  }


}

?>