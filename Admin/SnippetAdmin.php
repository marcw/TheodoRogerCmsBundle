<?php

namespace Theodo\RogerCmsBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;


/**
 * SnippetAdmin.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class SnippetAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('content', null, array('attr' => array('class' => 'code-editor', 'data-mode' => 'jinja2')))
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
            ->add('cacheable')
            ->add('public')
            ->add('lifetime')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('cacheable')
            ->add('public')
            ->add('lifetime')
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
        $this->container->get('roger.caching')->invalidate('snippet:'.$object->getName());
    }

    private function warmup($object)
    {
        $this->container->get('roger.caching')->warmup('snippet:'.$object->getName());
    }
}
