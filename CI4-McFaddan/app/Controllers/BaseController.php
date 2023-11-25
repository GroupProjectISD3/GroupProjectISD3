<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    protected function adminSession()
    {
        return \Config\Services::session();
    }

    protected function memberSession()
    {
        return \Config\Services::session();
    }

    /* Can't expose users email
    protected function setMemberSessionData($memberId, $email)
    {
        $memberSession = $this->memberSession();
        $memberSession->set([
            'member_id' => $memberId,
            'email'     => $email,
            'role'      => 'customer',
        ]);
    }

    protected function getMemberSessionData()
    {
        $memberSession = $this->memberSession();
        return [
            'member_id' => $memberSession->get('member_id'),
            'email'     => $memberSession->get('email'),
            'role'      => $memberSession->get('role'),
        ];
    }

    */

    protected function setMemberSessionData($member)
    {
        $memberSession = $this->memberSession();
        $memberSession->set([
            'member_id' => $member->memberID,
            'first_name' => $member->firstName,
            'last_name' => $member->lastName,
            'email'     => $member->email,
            'role'      => 'customer',
        ]);
    }

    protected function getMemberSessionData()
    {
        $memberSession = $this->memberSession();
        return [
            'member_id' => $memberSession->get('member_id'),
            'first_name' => $memberSession->get('first_name'),
            'last_name' => $memberSession->get('last_name'),
            'email'     => $memberSession->get('email'),
            'role'      => $memberSession->get('role'),
        ];
    }



    

    protected function setMemberSessionDataLogin($userId, $email, $role)
    {
        $memberSession = $this->memberSession();
        $memberSession->set([
            'user_id' => $userId,
            'email'     => $email,
            'role'      => $role,
        ]);
    }

    protected function getMemberSessionDataLogin()
    {
        $memberSession = $this->memberSession();
        return [
            'user_id' => $memberSession->get('user_id'),
            'email'     => $memberSession->get('email'),
            'role'      => $memberSession->get('role'),
        ];
    }

    // In BaseController
    protected function getUserRole()
    {
        $session = \Config\Services::session();

        if ($session->has('role')) {
            return $session->get('role');
        }

        return null;
    }

     protected function isLoggedIn()
    {
        $session = $this->memberSession();
        return $session->has('member_id') || $session->has('user_id');
    }
}
