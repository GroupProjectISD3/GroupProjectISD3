<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\AdminDashboardModel;
use App\Models\CartModel;
use CodeIgniter\Controller;
require_once(__DIR__ . '/../../vendor/autoload.php');

class MemberController extends BaseController{
	
	protected $db;
    private $AdminDashboardModel;
    private $MemberModel; // Define the class-level property



    public function __construct() {
        helper(['form', 'url']);
        //Instance of the member model
        $this->MemberModel = new MemberModel();
        $this->CartModel = new CartModel();
        $this->AdminDashboardModel = new AdminDashboardModel();
        $this->pager = \Config\Services::pager();

        $this->db = \Config\Database::connect();

    }

    public function errorMemberLogin(){
        // Load the view for the index page
        return view('errorMemberLogin');
    }



    public function success()
{
    // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();

        // Load the view for the faq page
        return view('success', $data);
}

	
	
	 public function contactUs()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Load the form validation and email libraries
        helper(['form', 'url']);
        $email = \Config\Services::email();

        // Define validation rules
        $validationRules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'subject' => 'required',
            'message' => 'required',
        ];

        // Apply validation rules
        if ($this->validate($validationRules)) {
            // If the form is valid, you can process the form data here.
            // For now, just redirect to a success page.
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
            ];
			$email = \Config\Services::email();
            // Set the email parameters
            $email->setTo('mcfaddaninstruments@gmail.com'); // Replace with your recipient's email address
            $email->setFrom($data['email'], $data['name']);
            $email->setSubject($data['subject']);
            $email->setMessage($data['message']);

            // Send the email
            if ($email->send()) {
                // Email sent successfully, you can redirect or do other actions here
                return redirect()->to(base_url('success'));
            } else {
                // Email not sent, handle the error as needed
                echo $email->printDebugger(['headers']);
            }
        }
    }
}
    public function index() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';

        $data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();

        // Load the view for the index page
        return view('index', $data);
    }

    protected function loadProducts()
    {
        // Load and return products data
        return $this->AdminDashboardModel->findAll();
    }

    public function faq() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();

        // Load the view for the faq page
        return view('faq', $data);
    }



    public function contact() {

        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();

        // Load the view for the contact page
        return view('contact', $data);
    }

    public function account_details() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        if (!$isLoggedIn) {
            // Member is not logged in, redirect to errorMemberLogin
            return redirect()->to('MemberController/errorMemberLogin');
        }

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();


        // Load the view for the wishlist page
        return view('account_details', $data);
    }

    public function wishlist() {
        $session = \Config\Services::session();
        $cartModel = new \App\Models\CartModel();
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        if (!$isLoggedIn) {
            // Member is not logged in, redirect to errorMemberLogin
            return redirect()->to('MemberController/errorMemberLogin');
        }

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        if ($this->isLoggedIn()) {
            $memberID = $session->get('member_id');
            $userID = $session->get('user_id');
            $id = $memberID ?? $userID;
            $data['wishlist'] = $cartModel->getWishlistFromDatabase($id);
        }

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();


        // Load the view for the wishlist page
        return view('wishlist', $data);
    }

    public function cart() {
        $session = \Config\Services::session();
        $cartModel = new \App\Models\CartModel();
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

            if ($this->isLoggedIn()) {
                $memberID = $session->get('member_id');
                $userID = $session->get('user_id');
                $id = $memberID ?? $userID;
                
                $data['cart'] = $cartModel->getCartFromDatabase($id);
            } else {
                $cart = $session->get('cart', []);
                if ($cart !== null) {
                    foreach ($cart as $productID => $item) {
                        $product = $cartModel->findProduct($productID);
                        $cart[$productID] = array_merge($item, $product);
                    }
                }
                    $data['cart'] = $cart;
            }
            $data['cart'] = $data['cart'] ?? [];
            $subtotal = 0;
            foreach ($data['cart'] as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $data['subtotal'] = $subtotal;
            $data['total'] = $subtotal; 

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();

        // Load the view for the contact page
        return view('cart', $data);
        
    }

    public function checkout() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        if (!$isLoggedIn) {
            // Member is not logged in, redirect to errorMemberLogin
            return redirect()->to('MemberController/errorMemberLogin');
        }

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionDataLogin = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';
        //log_message('debug', 'Member ID: ' . $data['member_id']);

        $data['user_id'] = $sessionDataLogin['user_id'] ?? '';
        //log_message('debug', 'User ID: ' . $data['user_id']);

        $iid = $sessionData['member_id'] ?? $sessionDataLogin['user_id'] ?? '';

        $data['address'] = $this->MemberModel->getLastAddress($iid);
        //log_message('debug', 'IID: ' . $iid);

		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        $data['cartCount'] = $this->getCartCount();


        // Load the view for the checkout page
        return view('checkout', $data);
    }

    

    public function products($category_id) {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
         

        $data['products'] = $this->MemberModel->get_products_by_category($category_id);
        if ($data['products'] === false) {
            $data['products'] = 'No products exist in the database for this category.';
        }
        $data['cartCount'] = $this->getCartCount();

        // Load the view for the products page
        return view('products', $data);
           
    }

        public function productDescription($product_id) {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
        $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

        // Load products data
        $data['products'] = $this->loadProducts();

        
        // Pass $isLoggedIn and $userRole to the view
        $data['isLoggedIn'] = $isLoggedIn;
        $data['userRole'] = $userRole;

        // Pass session data to the view
        $data['email'] = $sessionData['email'] ?? '';
        $data['first_name'] = $sessionData['first_name'] ?? '';
        $data['last_name'] = $sessionData['last_name'] ?? '';
        $data['member_id'] = $sessionData['member_id'] ?? '';

        $data['user_id'] = $sessionData['user_id'] ?? '';
		
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }

        $data['productInfo'] = $this->MemberModel->get_products_by_id($product_id);
        if ($data['productInfo'] === false) {
            $data['productInfo'] = 'Product does not exist in the database for this category.';
        }
        $data['cartCount'] = $this->getCartCount();

        // Load the view for the products page
        return view('productDescription', $data);
           
    }


    public function register()
    {
        //Load the validation service
        $validation = \Config\Services::validation();
        
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }

        //if the register button is clicked
        if(isset($_POST['register'])){
            //If validation does not pass
            if (!$this->validate('memberInsertValidation')) {
                // Get validator details
                $data['validation'] = $this->validator;
				$data['cartCount'] = $this->getCartCount();
                //Render view with validator errors
                echo view('portal', $data);
            }else{
                // Hash the password with CodeIgniter's password_hash function
                $hashedPassword = hash('sha256', $this->request->getPost('newPassword'));

                // Register the member
                $member = $this->MemberModel->registerMember(
                    $this->request->getPost('firstName'),
                    $this->request->getPost('lastName'),
                    $this->request->getPost('userName'),
                    $this->request->getPost('email'),
                    $hashedPassword
                );

                if ($member) {
                    // Registration successful, set session data

                    //Load the session service
                    $session = \Config\Services::session();
                    $session->set([
                        'member_id' => $member->memberID,
                        'first_name' =>$member->firstName,
                        'last_name' => $member->lastName,
                        'email'     => $this->request->getPost('email'),
                        'role'      => 'member',
                    ]);

                    // Redirect to the member dashboard or wherever needed
                    return redirect()->to('MemberController/index');
                } else {
                    // Registration failed, redirect back to the registration form with an error message
                    $data['error'] = 'Registration failed. Please try again.';
                    echo view('portal', $data);
                }
            }
        }
        $data['cartCount'] = $this->getCartCount();
        echo view('portal', $data); 
    }

    //Member logout

    public function logout()
    {
        // Destroy the session
        session()->destroy();

        // Redirect to the index page
        return redirect()->to('MemberController/index');
    }


    //Cart - $this->CartModel
    public function addToCart()
    {
        $productID = $this->request->getPost('productID');
        $quantity = $this->request->getPost('quantity');

        $session = \Config\Services::session();
        $cartModel = new CartModel();

        if ($this->isLoggedIn()) {
            $memberID = $session->get('member_id');
            $userID = $session->get('user_id');

            $id = $memberID ?? $userID; //returns the first operand if it exists and is not NULL; otherwise, it returns its second operand as two id's are being used to represent the logged in state of a member

            $cart = $cartModel->getCartFromDatabase($id);
            $productExistsInCart = false;
            foreach ($cart as $item) {
                if ($item['productID'] == $productID) {
                    $productExistsInCart = true;
                    break;
                }
            }
            if ($productExistsInCart) {
                // Update the quantity of the product in the cart in the database
                $cartModel->updateQuantityInCart($id, $productID, $quantity);
            } else {
                // Add the product to the cart in the database
                $cartModel->addToCart($id, $productID, $quantity);
            }

            //$cartModel->addToCart($id, $productID, $quantity);
        } else {

            $cart = $session->get('cart', []);

            if (isset($cart[$productID])) {
                $cart[$productID]['quantity'] += $quantity;
            } else {
                $product = $cartModel->findProduct($productID);
                $cart[$productID] = [
                    'productID' => $productID,
                    'quantity' => $quantity,
                    'productName' => $product['productName'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'imagePath' => $product['imagePath'],
                    'stockQuantity' => $product['stockQuantity'],
                    'color' => $product['color'],
                    'categoryID' => $product['categoryID']
                ];
            }
            $session->set('cart', $cart);
        }
        return redirect()->to('/cart');
    }

    //Add Member Address
    public function addNewMemberAddress(){
        $session = \Config\Services::session();
        // Check if the user is logged in and has the 'admin' role
        if ($this->isLoggedIn()) {
            // Check if the user is logged in
            $isLoggedIn = $this->isLoggedIn();
            $userRole = $this->getUserRole();
            $memberID = $session->get('member_id');
            $userID = $session->get('user_id');

            $id = $memberID ?? $userID;

            if (!$isLoggedIn) {
                // Member is not logged in, redirect to errorMemberLogin
                return redirect()->to('MemberController/errorMemberLogin');
            }
             // Get session data
                $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];
                $sessionData = $isLoggedIn ? $this->getMemberSessionDataLogin() : [];

                // Load products data
                $data['products'] = $this->loadProducts();

                
                // Pass $isLoggedIn and $userRole to the view
                $data['isLoggedIn'] = $isLoggedIn;
                $data['userRole'] = $userRole;

                // Pass session data to the view
                $data['email'] = $sessionData['email'] ?? '';
                $data['first_name'] = $sessionData['first_name'] ?? '';
                $data['last_name'] = $sessionData['last_name'] ?? '';
                $data['member_id'] = $sessionData['member_id'] ?? '';

                $data['user_id'] = $sessionData['user_id'] ?? '';
                
                $data['categories'] = $this->MemberModel->get_all_categories();
                if ($data['categories'] === false) {
                    $data['categories'] = 'No categories exist in the database.';
                }
                $data['cartCount'] = $this->getCartCount();

            //Load the validation service
            $validation = \Config\Services::validation();

                    //if the addNewStaff button is clicked
            if(isset($_POST['submit'])){
                //If validation does not pass
                if (!$this->validate('addressInsertValidation')) {
                    // Get validator details
                    $data['validation'] = $this->validator;

                    //Render view with validator errors
                    echo view('account_details', $data);
                }else{
                    
                    // Insert address
                    $address = $this->MemberModel->insertMemberAddress(
                        $id,
                        $this->request->getPost('address1'),
                        $this->request->getPost('address2'),
                        $this->request->getPost('address3'),
                        $this->request->getPost('city'),
                        $this->request->getPost('county'),
                        $this->request->getPost('eircode')    
                    );

                    if ($address) {

                        
                        return redirect()->to('/cart');

                    } else {
                        // Registration failed, redirect back to the registration form with an error message
                        $data['error'] = "Error!, Please Try again";
                        return view('account_details', $data);
                        
                    }
                }


            }
        }
        
    }


    //Add wishlist
    public function addToWishlist(){
        $productID = $this->request->getGet('productID');

        $session = \Config\Services::session();
        $cartModel = new CartModel();

        if ($this->isLoggedIn()) {
            $memberID = $session->get('member_id');
            $userID = $session->get('user_id');

            $id = $memberID ?? $userID; //returns the first operand if it exists and is not NULL; otherwise, it returns its second operand as two id's are being used to represent the logged in state of a member

            $wishlist = $cartModel->getWishlistFromDatabase($id);
            $productExistsInWishlist = false;
            foreach ($wishlist as $item) {
                if ($item['productID'] == $productID) {
                    $productExistsInWishlist = true;
                    break;
                }
            }
            if ($productExistsInWishlist) {
                // Redirect the the wishlist - Fake adding the product to wishlis
                return redirect()->to('/wishlist');
            } else {
                // Add the product to the wishlist in the database
                $cartModel->addToWishlist($id, $productID);
            }

            //$cartModel->addToCart($id, $productID, $quantity);
        } else {

            //Add something here is you want users that are not members to add to wislist
            //Store product id in session and then use the find method in the member controller to get details for that product
        }
        return redirect()->to('/wishlist');

    }

    public function deleteFromCart($productID)
    {
        $session = \Config\Services::session();
        $cartModel = new CartModel();

        if ($this->isLoggedIn()) {
            $memberID = $session->get('member_id');
            $userID = $session->get('user_id');
            $id = $memberID ?? $userID;
            $cartModel->deleteFromCart($id, $productID);
        } else {
            $cart = $session->get('cart', []);
            unset($cart[$productID]);
            $session->set('cart', $cart);
        }
        return redirect()->to('/index');
    }

    public function deleteFromWishlist($productID)
    {
        $session = \Config\Services::session();
        $cartModel = new CartModel();

        if ($this->isLoggedIn()) {
            $memberID = $session->get('member_id');
            $userID = $session->get('user_id');
            $id = $memberID ?? $userID;
            $cartModel->deleteFromWishlist($id, $productID);
        }
        return redirect()->to('/index');
    }

    public function getCartCount()
    {
        $session = \Config\Services::session();
        $cartModel = new CartModel();

        if ($this->isLoggedIn()) {
            $memberID = $session->get('member_id');
            $userID = $session->get('user_id');
            $id = $memberID ?? $userID;
            $cart = $cartModel->getCartFromDatabase($id);
        } else {
            $cart = $session->get('cart', []);
        }

        return is_null($cart) ? 0 : count($cart);
    }

    public function processPayment(){
        \Stripe\Stripe::setApiKey('sk_test_51OHqKsDJTbFTfK1emJUJ76ZTVh0DgcfFNiagx4jW4KXcRxkvTs1F9v6QSkLPsHqifQ2xwVR1NX6Z5t5vshAKNLtW00UjpPKdpa');

        $orderID = $_POST['orderID'];
        $total = $_POST['total'];

        $token = $_POST['stripeToken'];
        error_log("Stripe Token: " . $token);
        // Log the $_POST array
error_log(print_r($_POST, true));
log_message('debug', "Stripe Token: " . $token);

        // Get the current date and time
        $paymentDate = date('Y-m-d H:i:s');

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $total * 100, // amount in cents - avoid issues with floating point values
                'currency' => 'eur', // currency
                'description' => 'Charge for order ' . $orderID,
                'source' => $token,
            ]);
            $status = 'Success: Payment Successful, please check your emails for further details';
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $body = $e->getJsonBody();
            $err  = $body['error'];
            if ($err['message'] == "You cannot use a Stripe token more than once") {
                $status = 'Your payment has already been processed. Please do not refresh the page.';
            } else {
                $status = 'Error: Your payment has already been processed. Please do not refresh the page.';
                //$status = 'Error: Your payment has already been processed. Please do not refresh the page.' . $err['message'];
            }
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $status = 'Error: ' . $e->getMessage();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $status = 'Error: ' . $e->getMessage();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $status = 'Error: ' . $e->getMessage();
        } catch (Exception $e) {
            $status = 'Error: ' . $e->getMessage();
        }

        // Call the model function to insert the data into the database
        $this->MemberModel->insertPayment($orderID, $paymentDate, $total, $status);

        // Load the view and pass the status
        return view('payment_view', array('status' => $status));
    }




}

/* Load products in the view ----Alfred Michael----Would not start until the image folder has been created and path moved to the database ---> Gabriela

<!-- Display products -->
<?php foreach ($products as $product): ?>
    <div class="product">
        <!-- Display product information -->
        <h3><?php echo $product->name; ?></h3>
        <!-- Add more product details as needed -->
    </div>
<?php endforeach; ?>*/


?>
