<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnDetail()
                ->hideOnIndex(),
            AssociationField::new('movie'),
            AssociationField::new('author')
                ->hideOnForm(),
            DateTimeField::new('createdAt')
                ->hideonForm(),
            TextEditorField::new('text', 'Content'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('movie')
            ->add('author')
            ->add('createdAt')
            ->add('text')
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        ->setPaginatorPageSize(100)
        ->setPaginatorRangeSize(2)
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }
}
