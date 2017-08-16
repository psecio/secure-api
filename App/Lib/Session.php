<?php

namespace App\Lib;
use \App\Model\User;
use \App\Model\ApiKey;
use \App\Model\ApiSession;
use Doctrine\DBAL\Exception\DatabaseObjectExistsException;

class Session
{
    const TIMEOUT = '+1 hour';

    /**
     * Start up the API session and generate the randomized token
     *
     * @param User $user User instance
     * @param ApiKey $key API Key instance
     * @param boolean $expire Expire older API keys [optional]
     * @return string Randomly generated Session ID
     */
    public static function start(User $user, ApiKey $key, $expire = true)
    {
        // The key is found, generate them a new one
        $sessionId = hash('sha512', random_bytes(128));

        // Make the new session record
        $session = ApiSession::create([
            'key_id' => $key->id,
            'session_id' => $sessionId,
            'expiration' => date('Y-m-d H:i:s', strtotime(self::TIMEOUT)),
            'user_id' => $user->id
        ]);

        if ($expire === true) {
            self::expire($session);
        }

        return $sessionId;
    }

    /**
     * Expire previous API sessions
     *
     * @param ApiSession $session API Session instance
     */
    protected static function expire(ApiSession $session)
    {
        $now = date('Y-m-d H:i:s');

        // Expire sessions older than the one provided
        $sessions = ApiSession::where('user_id', $session->user_id)
            ->where('key_id', $session->key_id)
            ->where('created_at', '<=', $now)
            ->where('id', '!=', $session->id)
            ->get();

        foreach ($sessions as $expire) {
            $expire->delete();
        }
    }


    public static function validate($request)
    {
        // Get the headers
        $xToken = $request->getHeader('X-Token')[0];
        $xTokenHash = $request->getHeader('X-Token-Hash')[0];

        // Get the key first
        $key = ApiKey::where(['key' => $xToken])->first();

        if ($key == null) {
            return false;
        }

        // Be sure the key matches a session and isn't expired
        $session = ApiSession::where(['key_id' => $key->id])
            ->where('expiration', '>=', date('m-d-Y H:i:s'))
            ->first();

        if ($session == null) {
            return false;
        }

        // Get the body and rebuild the hash
        $body = (string)$request->getBody()->getContents();
        $messageHash = hash_hmac('SHA512', $body, $session->session_id.time());

        if ($messageHash !== $xTokenHash) {
            return false;
        }

        return true;
    }
}
