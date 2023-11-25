<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\AdminDashboardModel;
use CodeIgniter\Controller;

class MemberController extends BaseController{
	
	protected $db;
    private $AdminDashboardModel;
    private $MemberModel; // Define the class-level property



    public function __construct() {
        helper(['form', 'url']);
        //Instance of the member model
        $this->MemberModel = new MemberModel();

        $this->AdminDashboardModel = new AdminDashboardModel();

        $this->db = \Config\Database::connect();

    }

    public function errorMemberLogin(){
        // Load the view for the index page
        return view('errorMemberLogin');
    }

    public function index() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];

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

        // Load the view for the faq page
        return view('faq', $data);
    }



    public function contact() {

        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];

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


        // Load the view for the wishlist page
        return view('account_details', $data);
    }

    public function wishlist() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        if (!$isLoggedIn) {
            // Member is not logged in, redirect to errorMemberLogin
            return redirect()->to('MemberController/errorMemberLogin');
        }

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];

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


        // Load the view for the wishlist page
        return view('wishlist', $data);
    }

    public function cart() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];

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


        // Load the view for the checkout page
        return view('checkout', $data);
    }

    

    public function products() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        $userRole = $this->getUserRole();

        // Get session data
        $sessionData = $isLoggedIn ? $this->getMemberSessionData() : [];

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

        // Load the view for the products page
        return view('products', $data);
           
    }


    public function register()
    {
        //Load the validation service
        $validation = \Config\Services::validation();
        


        //if the register button is clicked
        if(isset($_POST['register'])){
            //If validation does not pass
            if (!$this->validate('memberInsertValidation')) {
                // Get validator details
                $data['validation'] = $this->validator;

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
                        'role'      => 'customer', // Assuming 'customer' is the default role
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
        echo view('portal'); 
    }

    //Member logout

    public function logout()
    {
        // Destroy the session
        session()->destroy();

        // Redirect to the index page
        return redirect()->to('MemberController/index');
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