<?php
/**
 * Clock Hour Management System - Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\Provider\Models\Concerns;

trait EnsureTrait
{
    public static function ensure($id)
    {
        $check = (int)static::where(['id' => $id])->count();
        if ($check === 0) {
            $newObject = new static;
            $newObject->id = $id;
            return $newObject->save();
        }
        return true;
    }
}
