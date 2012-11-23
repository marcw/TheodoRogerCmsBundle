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
}
