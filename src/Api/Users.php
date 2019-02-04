<?php

namespace FastSMS\Api;

use FastSMS\Model\User;

/**
 * This is the API class for Users
 */
class Users extends AbstractApi
{

    /**
     * Create new user
     * @param \FastSMS\Model\User $user user model
     * @return array
     */
    public function create(Array $data)
    {
        $user = new User($data);
        $args = $user->buildArgs();
        $result = array();
        $data = $this->client->http->call('CreateUser', $args);
        $result['status'] = 'error';
        if ($data == 1) {
            $result['status'] = 'success';
        }
        return $result;
    }
    
    /**
     * Update user
     * @param \FastSMS\Model\User $user user model
     * @return array
     */
    public function update(Array $data)
    {
        $user = new User($data);
        $args = $user->buildArgs();
        $result = array();
        $data = $this->client->http->call('UpdateCredits', $args);
        $result['status'] = 'error';
        if ($data == 1) {
            $result['status'] = 'success';
        }
        return $result;
    }

}
