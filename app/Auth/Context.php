<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Auth;
 
use CHMS\Common\Auth\Context as BaseContext;

class Context extends BaseContext
{
    private $objectFields = [];
    private $providerId;

    public function getContextFields()
    {
        $fields = $this->objectFields;
        if ($this->getProviderId() !== null) {
            $fields['provider_id'] = $this->getProviderId();
        }
        return $fields;
    }

    public function setObjectField($name, $value)
    {
        if (!isset($value)) {
            unset($this->objectFields[$name]);
        } else {
            $this->objectFields[$name] = $value;
        }
    }

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
