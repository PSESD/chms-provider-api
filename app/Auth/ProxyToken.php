<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Auth;

class ProxyToken
{
    private $token;
    private $id;
    private $type;
    private $expires;
    private $meta = [];

    /**
     * Generate object
     * @param  string $token
     * @param  array $raw
     * @return static|boolean
     */
    public static function generate($token, $raw)
    {
        if (!isset($raw['id']) || !isset($raw['type']) || !isset($raw['meta']) || !isset($raw['expires'])) {
            return false;
        }
        return new static($token, $raw['type'], $raw['id'], $raw['expires'], $raw['meta']);
    }

    /**
     * Constructor
     * @param string $token
     * @param string $type
     * @param string $id
     * @param int $expires
     * @param array $meta
     */
    public function __construct($token, $type, $id, $expires, $meta = [])
    {
        $this->token = $token;
        $this->id = $id;
        $this->type = $type;
        $this->meta = $meta;
        $this->expires = $expires;
    }

    /**
     * Gets the id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets the meta
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Gets the expires time
     * @return int
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Gets the token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Ensures the client or user is in the system
     *
     * @return boolean
     */
    public function ensureObject()
    {
        if ($this->type === 'user') {
            return User::ensure($this->id);
        } elseif ($this->type === 'client') {
            return Client::ensure($this->id);
        }
        return false;
    }
}
