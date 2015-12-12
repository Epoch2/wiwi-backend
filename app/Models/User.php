<?php namespace App\Models;

/**
 * Created by Johan Vester
 * johan.vester@gmail.com
 *
 * Date: 12/12/15
 *
 * (c) 2015 wasitworth.it
 */

use App\Models\Traits\MagicAccessors;

class User
{
    use MagicAccessors;

    protected $id;
    protected $first_name;
    protected $last_name;
}