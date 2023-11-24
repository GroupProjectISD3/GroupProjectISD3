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

    public function index() {

        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Load products data
        $data['products'] = $this->loadProducts();

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

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

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

        // Load the view for the other page
        return view('faq', $data);
    }



    public function contact() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

        // Load the view for the other page
        return view('contact', $data);
    }

    public function wishlist() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

        // Load the view for the other page
        return view('wishlist', $data);
    }

    public function cart() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

        // Load the view for the other page
        return view('cart', $data);
        
    }

    public function checkout() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

        // Load the view for the other page
        return view('checkout', $data);
    }

    public function adminLogin() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

        // Load the view for the other page
        return view('adminLogin', $data);
    }

    public function products() {
        // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionData()['email'] : '';

        // Load products data
        $data['products'] = $this->loadProducts();

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

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
                $memberId = $this->MemberModel->registerMember(
                    $this->request->getPost('firstName'),
                    $this->request->getPost('lastName'),
                    $this->request->getPost('userName'),
                    $this->request->getPost('email'),
                    $hashedPassword
                );

                if ($memberId) {
                    // Registration successful, set session data

                    //Load the session service
                    $session = \Config\Services::session();
                    $session->set([
                        'member_id' => $memberId,
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