<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\JWTManager;
use Vanier\Api\Models\AccountsModel;


/**
 * Handles requests for creating new accounts and 
 * generating JWTs.
 * 
 * @author frostybee
 */
class AccountsController extends BaseController
{
    private $accounts_model = null;

    public function __construct()
    {
        $this->accounts_model = new AccountsModel();
    }
    public function handleCreateAccount(Request $request, Response $response): Response
    {
        $account_data = $request->getParsedBody();
        var_dump($account_data);
        // 1) Verify if any information about the new account to be created was included in the 
        // request.
        if (empty($account_data)) {
            return $this->makeResponse(
                $response,
                ['error' => true, 'message' => 'No data was provided in the request.'],
                400
            );

            // return $this->prepareOkResponse($response, ['error' => true, 'message' => 'No data was provided in the request.'], 400);

        }
        //TODO: before creating the account, verify if there is already an existing one with the provided email.
//        var_dump("before the thingy");
        $email_exits = $this->accounts_model->isAccountExist($account_data['email']);
//        var_dump($account_data['email']);exit;
        if (!empty($email_exits)){
            throw new HttpBadRequestException(
                $request,
                "The email already exists"
            );
        }
        // 2) Data was provided, we attempt to create an account for the user.                
        $this->accounts_model->createAccount($account_data);
        //if (!$new_account_id) {
            // 2.a) Failed to create the new account.
        //}
        
        // 3) A new account has been successfully created. 
        $response_data = array(
            "code" => "success",
            "message" => "A new account has been successfully created"
        );

        // Prepare and return a response.
        return $this->makeResponse($response,$response_data,201);
    }

    public function handleGenerateToken(Request $request, Response $response, array $args)
    {
        $account_data = $request->getParsedBody();
        //var_dump($user_data);exit;

        //-- 1) Reject the request if the request body is empty.
        if(empty($account_data)){
            throw new HttpInvalidInputException(
              $request,
              "Nothing was passed as inputs!"
            );

        }
        //-- 2) Retrieve and validate the account credentials.
//        $account = $this->accounts_model->isPasswordValid($account_data["email"], $account_data["password"]);
        $email_exits = $this->accounts_model->isAccountExist($account_data['email']);
        if (!$email_exits) {
            $response_data = array(
                "code" => "Error",
                "message" => "Account doesn't exist",
            );
            // Prepare and return a response.
            return $this->makeResponse($response, $response_data,201);
        }
        //-- 3) Is there an account matching the provided email address in the DB?
        //-- 4) If so, verify whether the provided password is valid.
        $db_account = $this->accounts_model->isPasswordValid($account_data["email"], $account_data["password"]);
        if (!$db_account) {
            //-- 4.a) If the password is invalid --> prepare and return a response with a message indicating the 
            // reason.
            $response_data = array(
                "code" => "Error",
                "message" => "Wrong password"
            );
            // Prepare and return a response.
            return $this->makeResponse($response, $response_data,201);
        }
        //-- 5) Valid account detected => Now, we return an HTTP response containing
        // the newly generated JWT.
        // TODO: add the account role to be included as JWT private claims.
        //-- 5.a): Prepare the private claims: user_id, email, and role.

        $jwtPayload = [
            "id" => $db_account['user_id'],
            "email" => $db_account['email'],
            "role" => $db_account['role']
        ];

        // Current time stamp * 60 seconds
        $expires_in = time() + 100000000000; //! NOTE: Expires in 1 minute.
        //!note: the time() function returns the current timestamp, which is the number of seconds since January 1st, 1970
        //-- 5.b) Create a JWT using the JWTManager's generateJWT() method.
        //$jwt = JWTManager::generateJWT($account_data, $expires_in);
        //--

        $jwt = JWTManager::generateJWT($jwtPayload, $expires_in);
            $jwt_info = array(
                "status" => "success",
                "token" => $jwt,
                "message" => "Logged is successfully"
            );

        // 5.c) Prepare and return a response containing the jwt.
        return $this->makeResponse($response, $jwt_info, 201);
    }
}
