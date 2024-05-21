<?php

namespace Vanier\Api\Helpers;

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Utility class for decoding and generating JWTs.
 *
 * @author frostybee
 */
class JWTManager
{

    public const SIGNATURE_ALGO = 'HS256';
    private $secret_key;

    public function __construct()
    {
    }

    /**
     * Loads the value of the secret key to be used in generating JWTs from 
	 * the .env file. 
     * @return string The value of the secret key.
     */
    public static function loadSecretKey()
    {
        $dotenv = Dotenv::createImmutable(APP_BASE_DIR, APP_ENV_FILE);
        $dotenv->load();
        //TODO: throw an exception if the key is empty.
        $secret = $_ENV['SECRET_KEY'] ?? "";
        return $secret;
    }

    /**
     * Decodes a JWT token using the supplied signing algorithm.
     * 
     * @param string $parsed_token the JWT that was retrieved from an HTTP request message.
     * @param string $algo The signing algorithm to be used in decoding the JWT.
     * @return array an array containing the public and private claims. 
     */
    public static function decodeJWT(string $parsed_token, string $algo): array
    {
        self::loadSecretKey();
        $jwt_secret = $_ENV['SECRET_KEY'];
        //echo $parsed_token;exit;
        $decoded_token = (array) JWT::decode($parsed_token, new Key($jwt_secret, $algo));
        //var_dump($decoded_token);exit;
        return $decoded_token;
    }

    /**
     * Generates a new JWT with the supplied public and private claims.
     *  
     * @param array $private_claims An associative array containing the private claims
     *                              to be embedded.
     * @param string $expires_in    The time indicating when the JWT will expire. 
     * @return string  The newly generated JWT.
     */
    public static function generateJWT(array $private_claims, $expires_in)
    {
        // For more information about the registered claims
        // @see: https://www.rfc-editor.org/rfc/rfc7519.html#section-4.1
        //"nbf" (Not Before) Claim
        //@see:  https://www.rfc-editor.org/rfc/rfc7519.html#section-4.1.5
        $public_claims = [
            'iss' => 'localhost',
            'aud' => 'localhost',
            'iat' => time(),
            'exp' => $expires_in,
        ];
        $jwt_payload = array_merge($public_claims, $private_claims);

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        self::loadSecretKey();
        $jwt_secret = $_ENV['SECRET_KEY'];
        $jwt = JWT::encode($jwt_payload, $jwt_secret, self::SIGNATURE_ALGO);
        //print_r($jwt);
        return $jwt;
    }
}
