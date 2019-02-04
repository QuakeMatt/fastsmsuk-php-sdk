<?php

namespace FastSMS\Api;

use FastSMS\Model\Contact;

/**
 * This is the API class for Contacts
 */
class Contacts extends AbstractApi
{

    /**
     * Create new user
     * @param \FastSMS\Model\Contact $contacts Contact model
     * @return array
     */
    public function create(Array $data)
    {
        $contact = new Contact($data);
        $args = $contact->buildArgs();
        $result = array();
        $pdata = array();
        $data = $this->client->http->call('ImportContactsCSV', $args);
        $lines = array_map('trim', explode("\n", $data));
        unset($lines[key(array_slice($lines, -1, 1, true))]);
        foreach ($lines as $line) {
            $pdata[] = array_map('trim', explode(":", $line));
        }
        foreach ($pdata as $msg) {
            $result[$msg[0]] = $msg[1];
        }
        return $result;
    }

    /**
     * Delete All Contacts
     * @return array
     */
    public function deleteAll()
    {
        $result = array();
        $data = $this->client->http->call('DeleteAllContacts', array());
        $result['status'] = 'error';
        if ($data == 1) {
            $result['status'] = 'success';
        }
        return $result;
    }

}
