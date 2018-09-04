<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParamAdminBundle:Default:index.html.twig');
    }
}
