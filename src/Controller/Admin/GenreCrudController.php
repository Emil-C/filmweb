<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class GenreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Genre::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ;
    }  
}
