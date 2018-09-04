<?php

namespace Member\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MemberBundle:Default:index.html.twig');
    }
}
