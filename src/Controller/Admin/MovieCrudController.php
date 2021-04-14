<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex()
                ->hideOnDetail(),
                TextField::new('title'),
                TextEditorField::new('description'),
            IntegerField::new('duration', 'Duration [min]'),
            DateField::new('premiere')
            ->formatValue(function ($value) {
                $currentDate = strtotime(date('d M Y'));
                    $premierDate = strtotime($value);
                    
                    return $currentDate > $premierDate ? $value : 'Coming soon ' . $value;
                }),
            ImageField::new('poster')
                ->hideOnIndex()
                ->setBasePath('/uploads/images')
                ->setUploadDir('/public/uploads/images/'),
            AssociationField::new('genre'),
            AssociationField::new('actors')
        ];
    }
    
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('title')
        ->add('duration')
        ->add('premiere')
        ->add('genre')
        ;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setDateFormat('dd MMMM y')
        ->setPaginatorPageSize(30)
        ->setPaginatorRangeSize(2)
        ;
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
