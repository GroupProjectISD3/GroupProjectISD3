<?php

namespace App\Controllers;

use App\Models\AdminDashboardModel; // Updated model name here
use CodeIgniter\Controller;
use App\Models\AdminMemberInfo;
use App\Models\MemberModel;
use App\Models\StaffMemberInfo;


class AdminDashboardController extends BaseController{
	
	protected $db;
    private $AdminDashboardModel; // Define the class-level property
    private $MemberModel; // Define the class-level property



    public function __construct() {
        helper(['form', 'url']);
        $this->AdminDashboardModel = new AdminDashboardModel(); // Initialize the $AdminDashboardModel property in the constructor

        //Instance of the admin member info model
        $this->adminMemberInfo = new AdminMemberInfo();

        //Instance of the staff member info model
        $this->staffMemberInfo = new StaffMemberInfo();

        $this->MemberModel = new MemberModel();

        $this->db = \Config\Database::connect();

        // Load the session service
        $this->session = \CodeIgniter\Config\Services::session();
    }

   /*public function index() {
        $data['products'] = $this->AdminDashboardModel->findAll();
        echo view('index', $data);
		
		
    }
	
	public function faq() {
    echo view('faq');
}


	public function portal() {
    echo view('portal');
}

public function memberlogin() {
    echo view('memberlogin');
}


	public function contact() {
    echo view('contact');
}

	public function wishlist() {
    echo view('wishlist');
}

	public function cart() {
    echo view('cart');
}

	public function checkout() {
    echo view('checkout');
}

		public function adminLogin() {
    echo view('adminLogin');
}


	public function productDescription() {
    echo view('productDescription');
}


  public function products() {
        $data['products'] = $this->AdminDashboardModel->findAll();
        echo view('products', $data);
		
    }*/

    public function categoryDashboard() {
        echo view('Dashboard/categoryDashboard');
        
    }





	public function dashboard() {
       // Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();

        // Get session data
        $data['email'] = $isLoggedIn ? $this->getMemberSessionDataLogin()['email'] : '';

        // Pass $isLoggedIn to the view
        $data['isLoggedIn'] = $isLoggedIn;

        // Load the view for the other page
        return view('dashboard', $data);
    }





	public function viewProductsDashboard()
{
    $productModel = new AdminDashboardModel();
    $data['products'] = $productModel->findAll();

    // Loop through each product and add the 'id' key
    foreach ($data['products'] as &$product) {
        $product['id'] = $product['productID'];
    }

    echo view('dashboard/productsDashboard', $data);
}


    //Customers details
    public function viewMembersDashboard(){
        $members = [ 'members' => $this->adminMemberInfo->paginate(15), //no. of records to display
        'pager' => $this->adminMemberInfo->pager ]; //Pager class info
        
        echo view('Dashboard/viewAllMembersDashboard', $members); //Display view with records and pager info
    }

    //Staff details
    public function viewStaffsDashboard(){
        $staffs = [ 'staffs' => $this->staffMemberInfo->paginate(15), //no. of records to display
        'pager' => $this->staffMemberInfo->pager ]; //Pager class info
        
        echo view('Dashboard/viewAllStaffsDashboard', $staffs); //Display view with records and pager info
    }
    

    //View AddNewStaff
    public function viewAddNewStaff(){
        echo view('Dashboard/addNewStaff');
    }


    //Delete Staff
    public function deleteStaff($id){
        $result = $this->staffMemberInfo->deleteStaff($id);

        if ($result) {
            return redirect()->to(base_url('AdminDashboardController/viewStaffsDashboard'));
        } else {
            return redirect()->to(base_url('AdminDashboardController/viewStaffsDashboard'));
        }
    }



    //Add Staffs
    public function addNewStaff(){
        //Load the validation service
        $validation = \Config\Services::validation();

                //if the addNewStaff button is clicked
        if(isset($_POST['addNewStaff'])){
            //If validation does not pass
            if (!$this->validate('staffInsertValidation')) {
                // Get validator details
                $data['validation'] = $this->validator;

                //Render view with validator errors
                echo view('Dashboard/addNewStaff', $data);
            }else{
                // Hash the password with CodeIgniter's password_hash function
                $hashedPassword = hash('sha256', $this->request->getPost('password'));


                // Register Staff
                $staff = $this->staffMemberInfo->registerStaff(
                    $this->request->getPost('firstname'),
                    $this->request->getPost('lastname'),
                    $this->request->getPost('email'),
                    $this->request->getPost('phone'),
                    $this->request->getPost('address1'),
                    $this->request->getPost('address2'),
                    $this->request->getPost('address3'),
                    $this->request->getPost('city'),
                    $this->request->getPost('country'),
                    $this->request->getPost('eircode'),
                    $this->request->getPost('date'),
                    $this->request->getPost('gender'),
                    $this->request->getPost('title'),
                    $this->request->getPost('jobTitle'),
                    $hashedPassword
                );

                if ($staff) {
                    // Registration successful, set session data

                    // Redirect to the staffs dashboard or wherever needed
                    $this->viewStaffsDashboard();
                } else {
                    // Registration failed, redirect back to the registration form with an error message
                    $data['error'] = 'Registration failed. Please try again.';
                    echo view('Dashboard/addNewStaff', $data);
                }
            }
        }
        
    }

    public function getMemberAddress($memberID){
        if (!empty($memberID)) { 

            // Get customer details using $customerNumber
            $data['addresses'] = $this->adminMemberInfo->getCustomer($memberID);

            //Return the view file with the data
            echo view('Dashboard/memberAddressAdmin', $data);
        }
        $this->dashboard();

    }

    public function viewSalesDashboard(){

        $memberCount = $this->adminMemberInfo->countMembers();
        $staffCount = $this->adminMemberInfo->countStaffs();
        $totalSuccessfulPayments = $this->adminMemberInfo->calculateTotalSuccessfulPayments();
        $data['categoryData'] = $this->adminMemberInfo->getCategoryWithMostPayments();


        // Add new values to the data array
        $data['memberCount'] = $memberCount;
        $data['staffCount'] = $staffCount;
        $data['totalSuccessfulPayments'] = $totalSuccessfulPayments;
        //Display information about all categories
        echo view('Dashboard/viewSalesDashboard', $data);
    }

	// Same as view sales dashboard- can delete later 
    public function showChart()
    {
        $data['categoryData'] = $this->yourModel->getCategoryWithMostPayments();

        //Display information about all categories
        echo view('Dashboard/viewSalesDashboard', $data);
    }

	
	public function viewAddProductDashboard()
    {
        $productModel = new AdminDashboardModel();
        $data['products'] = $productModel->findAll();
    $data['categories'] = $productModel->findAllCategories(); // Corrected line

        echo view('dashboard/addProductDashboard', $data);
    }
	
	
	
	public function viewUpdateProduct($id)
{
    $productModel = new AdminDashboardModel();
    
    // Fetch the product data based on the given ID
    $data['product'] = $productModel->find($id);

    // Check if the product exists
    if (!$data['product']) {
        // Product not found, handle this scenario (e.g., redirect to an error page)
        return redirect()->to(base_url('AdminDashboardController/viewProductsDashboard'))->with('error', 'Product not found');
    }

    echo view('dashboard/updateProductDashboard', $data);
}


public function viewAddProduct(){

}

 public function addProduct()
{
    $productModel = new AdminDashboardModel();
        $data['products'] = $productModel->findAll();
    $data['categories'] = $productModel->findAllCategories(); // Corrected line

        

    //Load the validation service
    $validation = \Config\Services::validation();

    //if the add product button is clicked
    if(isset($_POST['addProductButton'])){
        //If validation does not pass
        if (!$this->validate('productInsertValidation')) {
            // Get validator details
            $data['validation'] = $this->validator;

            //Render view with validator errors
            return view('dashboard/addProductDashboard', $data);
        }
        else{
            //$productName,$description,$price,$stockQuantity,$image, $color, $categoryID

            // Get the product data from the form POST data
            $productName = $this->request->getPost('productName');
            $description = $this->request->getPost('description');
            $price = $this->request->getPost('price');
            $stockQuantity = $this->request->getPost('stockQuantity');
            $color = $this->request->getPost('color');
            $categoryID = $this->request->getPost('categoryID');

            // Handle image upload
            $image = $this->request->getFile('image');

            // Check if the image was uploaded successfully
            if ($image->isValid() && !$image->hasMoved()) {
                
                // Path where the images will be stored, Something like this
                //http://localhost/CI4-McFaddan/public/uploads/ResourceImageProduct
                $imagePath = 'C:\xampp\htdocs\GroupProjectISD3\CI4-McFaddan\public\uploads\ResourceImageProduct';

                // Create the uploads folder if it doesnt exist
                if (!is_dir(FCPATH . 'uploads')) {
                    //mkdir(FCPATH . 'uploads', 0777, true);
                    $result = mkdir(FCPATH . 'uploads', 0777, true);
                    var_dump($result);  // Add this line
                }

                // Create the 'ResourceImageProduct' folder if it doesn't exist
                if (!is_dir($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }

                // Get the original name of the uploaded file
                $imageName = $image->getName();

                // Move the uploaded file to the 'ResourceImageProduct' folder
                $image->move($imagePath, $imageName);
                
                $this->AdminDashboardModel->insertProduct($productName,$description,$price,$imageName, $stockQuantity, $color, $categoryID);

                $this->viewProductsDashboard();
                //return view('dashboard/productsDashboard');
            }else {
                $error = $image->getError();

                // Display error message
                $this->session->setFlashdata('error', 'Image upload failed: ' . $error);

                // Pass the error message back to the form
                $data['error'] = $this->session->getFlashdata('error');
                return view('dashboard/addProductDashboard', $data);
            }
        } 
    }else{
        echo view('dashboard/addProductDashboard', $data);
    }
    
    

}



public function updateProduct($id)
{
    
    $productModel = new AdminDashboardModel();
        $data['product'] = $productModel->findProduct($id);
    $data['categories'] = $productModel->findAllCategories();
    //Load the validation service
    $validation = \Config\Services::validation();

    //if the add product button is clicked
    if(isset($_POST['updateProductButton'])){
        //If validation does not pass
        if (!$this->validate('productInsertValidation')) {
            // Get validator details
            $data['validation'] = $this->validator;

            //Render view with validator errors
            return view('dashboard/updateProductDashboard', $data);
        }
        else{
            //$productName,$description,$price,$stockQuantity,$image, $color, $categoryID

            // Get the product data from the form POST data
            $productName = $this->request->getPost('productName');
            $description = $this->request->getPost('description');
            $price = $this->request->getPost('price');
            $stockQuantity = $this->request->getPost('stockQuantity');
            $color = $this->request->getPost('color');
            $categoryID = $this->request->getPost('categoryID');

            // Handle image upload
            $image = $this->request->getFile('image');

            // Check if the image was uploaded successfully
            if ($image->isValid() && !$image->hasMoved()) {
                
                // Path where the images will be stored, Something like this
                //http://localhost/CI4-McFaddan/public/uploads/ResourceImageProduct
                $imagePath = 'C:\xampp\htdocs\GroupProjectISD3\CI4-McFaddan\public\uploads\ResourceImageProduct';

                // Create the uploads folder if it doesnt exist
                if (!is_dir(FCPATH . 'uploads')) {
                    //mkdir(FCPATH . 'uploads', 0777, true);
                    $result = mkdir(FCPATH . 'uploads', 0777, true);
                    var_dump($result);  // Add this line
                }

                // Create the 'ResourceImageProduct' folder if it doesn't exist
                if (!is_dir($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }

                // Get the original name of the uploaded file
                $imageName = $image->getName();

                // Move the uploaded file to the 'ResourceImageProduct' folder
                $image->move($imagePath, $imageName);
                
                $this->AdminDashboardModel->updateProduct($id, $productName,$description,$price,$imageName, $stockQuantity, $color, $categoryID);

                $this->viewProductsDashboard();
                //return view('dashboard/productsDashboard');
            }else {
                $error = $image->getError();

                // Display error message
                $this->session->setFlashdata('error', 'Image upload failed: ' . $error);

                // Pass the error message back to the form
                $data['error'] = $this->session->getFlashdata('error');
                return view('dashboard/updateProductDashboard', $data);
            }
        } 
    }else{
        echo view('dashboard/updateProductDashboard', $data);
    }

    
}




    public function deleteProduct($id)
{
    $productModel = new AdminDashboardModel(); 

    // Assuming delete method in AdminDashboardModel takes the product ID
    $result = $productModel->delete($id);

    if ($result) {
        // Successful deletion, redirect to the products page with a success message
        return redirect()->to(base_url('AdminDashboardController/viewProductsDashboard'))->with('success', 'Product deleted successfully!');
    } else {
        // Handle deletion failure, redirect back to the products page with an error message
        return redirect()->to(base_url('AdminDashboardController/viewProductsDashboard'))->with('error', 'Failed to delete product');
    }
}





//Gabriela Category

//category 

public function viewCategoryDashboard()
{
    $categoryModel = new AdminDashboardModel();
    $data['categories'] = $categoryModel->findAllCategories();

    echo view('dashboard/categoryDashboard', $data);
}



public function viewAddCategoryDashboard()
    {
        $categoryModel = new AdminDashboardModel();
        $data['categories'] = $categoryModel->findAll();
        echo view('dashboard/addCategoryDashboard', $data);
    }


public function insertCategory(){

    //Load the validation service
    $validation = \Config\Services::validation();

    //if the register button is clicked
    if(isset($_POST['addCategory'])){
        //If validation does not pass
        if (!$this->validate('categoryInsertValidation')) {
            // Get validator details
            $data['validation'] = $this->validator;

            //Render view with validator errors
            return view('dashboard/addCategoryDashboard', $data);
        }else{

            // Get the category name from the form POST data
            $categoryName = $this->request->getPost('categoryName');

            // Handle image upload
            $image = $this->request->getFile('image');

            // Check if the image was uploaded successfully
            if ($image->isValid() && !$image->hasMoved()) {
                
                // Path where the images will be stored, Something like this
                //http://localhost/CI4-McFaddan/public/uploads/ResourceImage
                $imagePath = 'C:\xampp\htdocs\GroupProjectISD3\CI4-McFaddan\public\uploads\ResourceImage';

                // Create the uploads folder if it doesnt exist
                if (!is_dir(FCPATH . 'uploads')) {
                    //mkdir(FCPATH . 'uploads', 0777, true);
                    $result = mkdir(FCPATH . 'uploads', 0777, true);
                    var_dump($result);  // Add this line
                }

                // Create the 'ResourceImage' folder if it doesn't exist
                if (!is_dir($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }

                // Get the original name of the uploaded file
                $imageName = $image->getName();

                // Move the uploaded file to the 'ResourceImage' folder
                $image->move($imagePath, $imageName);
                
                $this->AdminDashboardModel->insertCategory($categoryName,$imageName);

                $this->viewAddCategoryDashboard();
                //return view('dashboard/productsDashboard');
            }else {
                $error = $image->getError();

                // Display error message
                $this->session->setFlashdata('error', 'Image upload failed: ' . $error);

                // Pass the error message back to the form
                $data['error'] = $this->session->getFlashdata('error');
                return view('dashboard/addCategoryDashboard', $data);
            }
        }
    }
}



public function viewUpdateCategory($id)
{
    $categoryModel = new AdminDashboardModel();

    // Fetch the category data based on the given ID
    $data['category'] = $categoryModel->findCategory($id);

    // Check if the category exists
    if (!$data['category']) {
        // Category not found, handle this scenario (e.g., redirect to an error page)
        return redirect()->to(base_url('AdminDashboardController/viewCategoryDashboard'))->with('error', 'Category not found');
    }

    echo view('dashboard/updateCategoryDashboard', $data);
}

public function updateCategory($id)
{
        $categoryModel = new AdminDashboardModel();

    // Fetch the category data based on the given ID
    $data['category'] = $categoryModel->findCategory($id);

    // Check if the category exists
    if (!$data['category']) {
        // Category not found, handle this scenario (e.g., redirect to an error page)
        return redirect()->to(base_url('AdminDashboardController/viewCategoryDashboard'))->with('error', 'Category not found');
    }

    

    //Load the validation service
    $validation = \Config\Services::validation();

    //if the register button is clicked
    if(isset($_POST['updateCategory'])){
        //If validation does not pass
        if (!$this->validate('categoryInsertValidation')) {
            // Get validator details
            $data['validation'] = $this->validator;

            //Render view with validator errors
            return view('dashboard/updateCategoryDashboard', $data);
        }else{
            // Get the category name from the form POST data
            $categoryName = $this->request->getPost('categoryName');

            // Handle image upload
            $image = $this->request->getFile('image');

            // Check if the image was uploaded successfully
            if ($image->isValid() && !$image->hasMoved()) {
                
                // Path where the images will be stored, Something like this
                //http://localhost/CI4-McFaddan/public/uploads/ResourceImage
                $imagePath = 'C:\xampp\htdocs\GroupProjectISD3\CI4-McFaddan\public\uploads\ResourceImage';

                // Create the uploads folder if it doesnt exist
                if (!is_dir(FCPATH . 'uploads')) {
                    //mkdir(FCPATH . 'uploads', 0777, true);
                    $result = mkdir(FCPATH . 'uploads', 0777, true);
                    var_dump($result);  // Add this line
                }

                // Create the 'ResourceImage' folder if it doesn't exist
                if (!is_dir($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }
                // Get the original name of the uploaded file
                $imageName = $image->getName();

                // Move the uploaded file to the 'ResourceImage' folder
                $image->move($imagePath, $imageName);
                // Fetch the category data based on the given ID
    $data['category'] = $categoryModel->findCategory($id);
                
                $result = $this->AdminDashboardModel->updateCategory($id, $categoryName,$imageName);

                if ($result) {
                    // Successful update, retrieve the updated category data and redirect
                    $updatedCategory = $this->AdminDashboardModel->findCategory($id);
                    return redirect()->to(base_url('AdminDashboardController/viewCategoryDashboard'))->with('success', 'Category updated successfully!')->with('updatedCategory', $updatedCategory);
                } else {
                    // Handle update failure, redirect back to the categories page with an error message
                    return redirect()->to(base_url('AdminDashboardController/viewCategoryDashboard'))->with('error', 'Failed to update category');
                }
            }else {
                $error = $image->getError();

                // Display error message
                $this->session->setFlashdata('error', 'Image upload failed: ' . $error);

                // Pass the error message back to the form
                $data['error'] = $this->session->getFlashdata('error');
                return view('dashboard/updateCategoryDashboard', $data);
            }
        }
    }else{
        echo view('dashboard/updateCategoryDashboard', $data);
    }

    
}



public function deleteCategory($id)
{
    $categoryModel = new AdminDashboardModel();

    // Assuming delete method in AdminDashboardModel takes the category ID
    $result = $categoryModel->deleteCategory($id);

    if ($result) {
        // Successful deletion, redirect to the categories page with a success message
        return redirect()->to(base_url('AdminDashboardController/viewCategoryDashboard'))->with('success', 'Category deleted successfully!');
    } else {
        // Handle deletion failure, redirect back to the categories page with an error message
        return redirect()->to(base_url('AdminDashboardController/viewCategoryDashboard'))->with('error', 'Failed to delete category');
    }
}



    //log out button dashboard view
	public function logout()
{
    // Destroy the session to log out the user
    session()->destroy();

    // Redirect the user to the index page 
return redirect()->to(base_url())->with('success', 'You have been successfully logged out!');
}


}
