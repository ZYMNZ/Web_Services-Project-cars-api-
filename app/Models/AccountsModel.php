<?php

namespace Vanier\Api\Models;

use Vanier\Api\Helpers\DateTimeHelper;
use Vanier\Api\Models\BaseModel;

/**
 * A model for managing the Web service's users.      
 *
 * @author frostybee
 */
class AccountsModel extends BaseModel
{

    private $table_name = "ws_users";

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Checks whether there is an existing account in the database for the user
     * identified by the supplied email address.      
     * 
     * @param string $email the email address of the registered user.
     */
    public function isAccountExist($email)
    {
        $sql = "SELECT * FROM $this->table_name WHERE email= :email";
        return $this->fetchSingle($sql, [":email" => $email]);
    }

    /**
     * Verifies the provided user password.
     * 
     * @param string $email the email address of the registered user. 
     * @param string $input_password the password of the registered user.
     */
    public function isPasswordValid($email, $input_password)
    {
        $sql = "SELECT * FROM $this->table_name WHERE email= :email";
        $account = $this->fetchSingle($sql, [":email" => $email]);
        if ($account && is_array($account)) {
            if (password_verify($input_password, $account['password'])) {
                return $account;
            }
        }
        return null;
    }

    /**
     * Creates a new user with the provide user info. 
     * 
     * @param array $account_info an array containing the info of user for whom an account
     *  will be created.
     * @return int the newly generated user id.
     */
    public function createAccount(array $account_info) : int
    {
        //-- 1) Add the value of the required created at (date and time) field.        
        $account_info["created_at"] = DateTimeHelper::getDateAndTime(DateTimeHelper::Y_M_D_H_M_S);
        //-- 2) We need to hash the password! 
        $account_info["password"] = $this->getHashedPassword($account_info["password"]);
        //var_dump($account_info);exit;
        return $this->insert($this->table_name, $account_info);
    }

    /**
     * Returns a hashed password.
     * 
     * @param string $password_to_hash the user password that needs to be hashed
     * @return string the hashed password.
     */
    private function getHashedPassword(string $password_to_hash) : string
    {
        //@see: https://www.php.net/manual/en/function.password-hash.php
        $options = ['cost' => 15];
        $hash = password_hash($password_to_hash, PASSWORD_DEFAULT, $options);
        return $hash;
    }
}
