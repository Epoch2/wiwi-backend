<?php namespace App\Repositories\Contracts;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 02/12/15
 *
 * (c) 2015 wasitworth.it
 */

/**
 * This interface can be extended in other repository interfaces to force
 * implementations to implement the usual Doctrine repository
 * methods (i.e. find, findAll, findBy, findOneBy) as defined in
 * Doctrine's ObjectRepository interface.
 *
 * In effect, this interface is (currently) simply an alias of the
 * ObjectRepository interface.
 *
 * Refer to: http://www.doctrine-project.org/api/common/2.4/class-Doctrine.Common.Persistence.ObjectRepository.html
 */

use Doctrine\Common\Persistence\ObjectRepository;
interface ResourceRepository extends ObjectRepository {}