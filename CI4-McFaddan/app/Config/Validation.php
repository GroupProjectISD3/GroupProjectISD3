<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
	
	
    // Validation for Product Insert.
public $productInsertValidation = [
    
    'productName' => [
        'label'=>'Product Name',
        'rules' => 'required|max_length[255]',
        'errors' => [
            'required' => 'Must insert a value for {field}.',
            'max_length' => '{field} must be less than {param} characters long.'
        ]
    ],

    'description' => [
        'label'=>'Product Description',
        'rules' => 'max_length[1000]', // Adjust the max_length based on your database schema
        'errors' => [
            'max_length' => '{field} must be less than {param} characters long.'
        ]
    ],

    'price' => [
        'label' => 'Price',
        'rules' => 'required|decimal',
        'errors' => [
            'required' => 'Must insert a value for {field}.',
            'decimal' => '{field} must be a decimal value.'
        ]
    ],

    

    'stockQuantity' => [
        'label'=> 'Stock Quantity',
        'rules' => 'required|integer|max_length[11]',
        'errors' => [
            'required' => 'Must insert a value for {field}.',
            'integer' => '{field} must be an integer value.',
            'max_length' => '{field} must be less than {param} digits long.'
        ]
    ],

    'image' => [
        'label' => 'image',
        'rules' => 'uploaded[image]|max_size[image,5024]|mime_in[image,image/jpeg,image/png,image/gif]|is_image[image]',

        'errors' => [
            'uploaded' => 'Please choose an {field} to upload.',
            'max_size' => 'The {field} file size should not exceed 5 MB.',
            'mime_in' => 'The selected file is not a valid {field} type (JPEG, PNG, GIF).',
            'is_image' => 'The selected file is not a valid {field}.'

        ]
    ],


    'color' => [
        'label'=> 'Color',
        'rules' => 'max_length[255]',
        'errors' => [
            'max_length' => '{field} must be less than {param} characters long.'
        ]
    ],

    'categoryID' => [
        'label'=>'Category ID',
        'rules' => 'required|integer',
        'errors' => [
            'required' => 'Must insert a value for {field}.',
            'integer' => '{field}must be an integer value.'
        ]
    ]


];




    // Validation for member Insert.
public $memberInsertValidation = [
    'firstName' => [
        'label' => 'First name',
        'rules' => 'required|max_length[255]',
        'errors' => [
            'required' => '{field} is required!',
            'max_length' => '{field} must be less than {param} characters long.'
        ]
    ],

    'lastName' => [
        'label' => 'Last name',
        'rules' => 'required|max_length[255]',
        'errors' => [
            'required' => '{field} is required!',
            'max_length' => '{field} must be less than {param} characters long.'
        ]
    ],

    'email' => [
        'label' => 'Email',
        'rules' => 'required|max_length[255]|valid_email|is_unique[member.email]',
        'errors' => [
            'required' => '{field} is required!',
            'max_length' => '{field} must be less than {param} characters long.',
            'is_unique' => 'This {field} already exists.',
            'valid_email' => '{field} must be a valid email address.'
        ]
    ],

    'userName' => [
        'label' => 'Username',
        'rules' => 'required|max_length[255]',
        'errors' => [
            'required' => '{field} is required!',
            'max_length' => '{field} must be less than {param} characters long.'
        ]
    ],

    'newPassword' => [
        'label' => 'Password',
        'rules' => 'required|min_length[6]',
        'errors' => [
            'required' => '{field} is required!',
            'min_length' => '{field} must be greater than {param} characters.'
        ]
    ]
];


      // Validation for member Insert.
public $loginValidation = [
    'emailOrUsername' => [
        'label' => 'Email Or Username',
        'rules' => 'required',
        'errors' => [
            'required' => '{field} is required!'
        ]
    ],


    'password' => [
        'label' => 'Password',
        'rules' => 'required',
        'errors' => [
            'required' => '{field} is required!'
        ]
    ]

];


    // Validation for Category Insert.
public $categoryInsertValidation = [
    'categoryName' => [
        'label' => 'Category name',
        'rules' => 'required|max_length[255]',
        'errors' => [
            'required' => 'Must insert a value for {field}.',
            'max_length' => '{field} must be less than {param} characters long.'
        ]
    ],


    'image' => [
        'label' => 'image',
        'rules' => 'uploaded[image]|max_size[image,5024]|mime_in[image,image/jpeg,image/png,image/gif]|is_image[image]',

        'errors' => [
            'uploaded' => 'Please choose an {field} to upload.',
            'max_size' => 'The {field} file size should not exceed 5 MB.',
            'mime_in' => 'The selected file is not a valid image type (JPEG, PNG, GIF).',
            'is_image' => 'The selected file is not a valid image.'

        ]
    ]

];

}


