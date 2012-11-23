<?php

namespace Theodo\RogerCmsBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Theodo\RogerCmsBundle\Repository\PageRepository;

/**
 * LayoutAdmin.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class LayoutAdmin extends AbstractAdmin
{
    protected $cacheKeyPrefix = 'layout';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('content', null, array('attr' => array('class' => 'code-editor', 'data-mode' => 'jinja2')))
            ->add('contentType', 'choice', array('choices' => PageRepository::getAvailableContentTypes()))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('content')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

}
