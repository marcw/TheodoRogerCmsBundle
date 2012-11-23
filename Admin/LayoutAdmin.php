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

    public function preUpdate($object)
    {
        $this->invalidate($object);
    }

    public function postUpdate($object)
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
