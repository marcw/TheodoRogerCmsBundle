<?php

namespace Theodo\RogerCmsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

use Theodo\RogerCmsBundle\Repository\PageRepository;
use Symfony\Component\DependentInjection\ContainerAwareInterface;
use Symfony\Component\DependentInjection\ContainerInterface;

/**
 * LayoutAdmin.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class LayoutAdmin extends Admin implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('content')
            ->add('contentType', 'choice', array('choices' => PageRepository::getAvailableContentTypes()))
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('content')
            ->add('contentType')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
        ;
    }

    public function preUpdate($object)
    {
        $this->invalidate($object);
    }

    public function postUpdate()
    {
        $this->warmup($object);
    }

    public function prePersist($object)
    {
        $this->invalidate($object);
    }

    public function postPersist($object)
    {
        $this->warmup($object);
    }

    private function invalidate($object)
    {
        $this->container->get('roger.caching')->invalidate('layout:'.$object->getName());
    }

    private function warmup($object)
    {
        $this->container->get('roger.caching')->warmup('layout:'.$object->getName());
    }
}
