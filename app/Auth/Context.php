<?php
/**
 * Clock Hour Management System - Sponsor Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\SponsorProvider\Auth;

class Context
{
    private $providerId;

    public function setProviderId($providerId)
    {
        $this->providerId = $providerId;
        return $this;
    }

    public function getProviderId()
    {
        return $this->providerId;
    }
}
