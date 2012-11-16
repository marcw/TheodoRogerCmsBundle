<?php

namespace Theodo\RogerCmsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * SnippetAdmin.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class SnippetAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('content')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('cacheable')
            ->add('public')
            ->add('lifetime')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('content')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('cacheable')
            ->add('public')
            ->add('lifetime')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('content')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('cacheable')
            ->add('public')
            ->add('lifetime')
        ;
    }
}
