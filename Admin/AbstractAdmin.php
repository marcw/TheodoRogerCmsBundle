<?php

namespace Theodo\RogerCmsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin as BaseAdmin;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * AbstractAdmin
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
abstract class AbstractAdmin extends BaseAdmin implements ContainerAwareInterface
{
    protected $cacheKeyPrefix = null;
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'TheodoRogerCmsBundle:Admin:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }


    private function invalidate($object)
    {
        if ($this->cacheKeyPrefix) {
            $this->container->get('roger.caching')->invalidate(sprintf('%s:%s', $this->cacheKeyPrefix, $object->getName()));
        }
    }

    private function warmup($object)
    {
        if ($this->cacheKeyPrefix) {
            $this->container->get('roger.caching')->warmup(sprintf('%s:%s', $this->cacheKeyPrefix, $object->getName()));
        }
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
}
