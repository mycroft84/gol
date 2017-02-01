<?php
/**
 * User: Tibor
 * Date: 2015.10.17.
 * Time: 14:31
 * Project: enigma
 * Company: d2c
 */
class Restful_Auth extends Kohana_Restful_Auth
{
    protected function getAuthSecret($apiKey)
    {
        $user = ORM::factory('User',array(
            'api_key'=>$apiKey
        ));
        if ($user->loaded() and $user->secret) {
            $this->user = $user;

            return $user->secret;
        }
    }

    protected function getUserByToken($token)
    {
        $token = ORM::factory('User_Token')->getToken(1,$token,false);
        if ($token->loaded() and $token->user->loaded()) {
            $this->token = $token;
            $this->user = $token->user;
        }

        return false;
    }
}