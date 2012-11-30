<?php

namespace Theodo\RogerCmsBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Theodo\RogerCmsBundle\Repository\PageRepository;

/**
 * PageAdmin.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class PageAdmin extends AbstractAdmin
{
    protected $cacheKeyPrefix = 'page';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('content', null, array('attr' => array('class' => 'code-editor', 'data-mode' => 'jinja2')))
            ->with('Tree')
                ->add('parent')
                ->add('breadcrumb')
            ->end()
            ->with('SEO')
                ->add('title')
                ->add('keywords')
                ->add('description')
            ->end()
            ->with('Workflow')
                ->add('status', 'choice', array('choices' => PageRepository::getAvailableStatus()))
                ->add('public', null, array('required' => false))
            ->end()
            ->with('Cache')
                ->add('lifetime')
                ->add('cacheable', null, array('required' => false))
            ->end()
            ->add('contentType', 'choice', array('choices' => PageRepository::getAvailableContentTypes()))
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
            ->addIdentifier('name')
            ->add('slug')
            ->add('status')
            //->add('parent', null, array('associated_tostring' => 'name'))
            //->add('children',)
            ->add('title')
            ->add('public')
            ->add('lifetime')
            ->add('cacheable')
        ;
    }
}
