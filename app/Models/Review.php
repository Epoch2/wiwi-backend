<?php namespace App\Models;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 12/12/15
 *
 * (c) 2015 wasitworth.it
 */

use App\Models\Traits\MagicAccessors;

class Review
{
    use MagicAccessors;

    const VERDICT_NOT_WORTH_IT = 1;
    const VERDICT_WORTH_IT = 2;

    protected $id;
    protected $product;
    protected $author;
    protected $verdict;

    public function setVerdictFromBool($worthIt)
    {
        $this->verdict = $worthIt
            ? self::VERDICT_WORTH_IT
            : self::VERDICT_NOT_WORTH_IT;
    }
}