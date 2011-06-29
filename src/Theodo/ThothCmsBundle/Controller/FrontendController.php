<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Theodo\ThothCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Theodo\ThothCmsBundle\Repository\PageRepository;

use Theodo\ThothCmsBundle\Extensions\Twig_Loader_Database;
use Twig_Error_Syntax;
use Twig_Loader_Array;


class FrontendController extends Controller
{
    /**
     * Test for page display
     *
     * @author Mathieu Dähne <mathieud@theodo.fr>
     * @since 2011-06-21
     */
    public function pageAction($slug)
    {
        $repository = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('TheodoThothCmsBundle:Page');
        if(!$slug)
        {
            $page = $repository->getHomepage();
        }
        else
        {
            $page = $repository->findOneBySlug($slug);
        }

        if (!$page || PageRepository::STATUS_PUBLISH !== $page->getStatus())
        {
            if (!$page = $repository->findOneBySlug('error404'))
            {
                throw $this->createNotFoundException();
            }
        }

        return $this->get('thoth_frontend.templating')->renderResponse('page:'.$page->getName());
    }
}
