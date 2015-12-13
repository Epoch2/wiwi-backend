<?php namespace App\Models;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 13/12/15
 *
 * (c) 2015 wasitworth.it
 */

use App\Models\Traits\MagicAccessors;

class Product
{
    use MagicAccessors;

    protected $id;
    protected $title;
    protected $imageUrl;
    protected $reviews;
}