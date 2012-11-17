<?php

namespace Theodo\RogerCmsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * PageAdmin.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class PageAdmin extends Admin
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('status')
            ->add('parent')
            ->add('children')
            ->add('title')
            ->add('public')
            ->add('lifetime')
            ->add('cacheable')
        ;
    }
}
