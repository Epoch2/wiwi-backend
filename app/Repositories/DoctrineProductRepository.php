<?php namespace App\Repositories;

    /**
     * Created by Johan Vester
     * johan@assimilate.se
     *
     * Date: 13/12/15
     *
     * (c) 2015 Assimilate
     */

// Doctrine
use Doctrine\ORM\EntityRepository;

// Repositories
use App\Repositories\Contracts\ProductRepository;

class DoctrineProductRepository extends EntityRepository implements ProductRepository {}