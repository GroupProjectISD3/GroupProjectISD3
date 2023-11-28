<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\AdminDashboardModel;
use CodeIgniter\Controller;

class LoginController extends BaseController{
	protected $db;
    private $AdminDashboardModel;
    private $MemberModel; // Define the class-level property

    public function __construct() {
        helper(['form', 'url']);
        //Instance of the member model
        $this->MemberModel = new MemberModel();

        $this->AdminDashboardModel = new AdminDashboardModel();

        $this->db = \Config\Database::connect();


        // Error logging enabled
        $this->logger = \Config\Services::logger();



    }

    public function index()
    {
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }
        // This loads the memberlogin view.
        return view('memberlogin', $data);
    }

    public function authenticate()
    {
        // This function is responsible for handling the user authentication process.

        //Load the validation service
        $validation = \Config\Services::validation();
		$data['categories'] = $this->MemberModel->get_all_categories();
        if ($data['categories'] === false) {
            $data['categories'] = 'No categories exist in the database.';
        }

        //if the register button is clicked
        if(isset($_POST['login'])){
            //If validation does not pass
            if (!$this->validate('loginValidation')) {
                // Get validator details
                $data['validation'] = $this->validator;

                //Render view with validator errors
                echo view('memberlogin', $data);
            }else{

		            	// Get user input from the login form
		        $emailOrUsername = $this->request->getPost('emailOrUsername');
		        //$password = $this->request->getPost('password');
		        $hashedPassword = hash('sha256', $this->request->getPost('password'));

		        // Authenticate user based on role using the UserModel
		        $user = $this->MemberModel->authenticateUser($emailOrUsername, $hashedPassword);

		        // Log user data
            //$this->logger->info('User Email: ' . print_r($emailOrUsername, true));
            // Log user data
            //$this->logger->info('User Password: ' . print_r($hashedPassword, true));

		        // Log user data
            //$this->logger->info('User Data: ' . print_r($user, true));

		        if ($user) {
		            // If the user is authenticated, set session data
		            $this->setSessionData($user);

		            // Redirect to the appropriate dashboard based on the user's role
		            return redirect()->to($this->getDashboardURL($user->role));
		        } else {
		            // If authentication fails, set flash data and redirect
					return redirect()->to('memberlogin')->with('error', 'Login failed. Please try again.');

		        }
    		}      
    	}
    }

    
    private function setSessionData($user)
    {
        // This private function sets session data after successful authentication.

        $session = \Config\Services::session();

        // Set common session data for all users
        $session->set([
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->p_email,
            'role' => $user->role,
        ]);

    }

    private function getDashboardURL($role)
    {
        // This private function returns the appropriate dashboard URL based on the user's role.

        switch ($role) {
            case 'admin':
                return 'AdminDashboardController/dashboard';
            case 'staff':
                return 'AdminDashboardController/dashboard';
            case 'member':
                return 'MemberController/index';
            default:
                return 'MemberController/errorMemberLogin';
        }
    }

}

?>