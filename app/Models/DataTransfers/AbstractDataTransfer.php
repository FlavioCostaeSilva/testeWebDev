<?php
/**
 * Created by PhpStorm.
 * User: Flávio Costa e Silva
 * Date: 26/03/2017
 * Time: 19:15
 */

namespace App\Models\DataTransfers;


abstract class AbstractDataTransfer
{
    public function attributesToArray()
    {
        return (array) $this;
    }
}