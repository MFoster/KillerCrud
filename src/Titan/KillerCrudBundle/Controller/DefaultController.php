<?php

namespace Titan\KillerCrudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Titan\KillerCrudBundle\Entity\Contract;
use Titan\KillerCrudBundle\Form\ContractType;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    
    /**
     * Demo action just serves up a default form to show the bootstrap override template.
     * 
     * @access public
     * @return void
     * @Route("/demo.html")
     * @Template("TitanKillerCrudBundle:Default:default-form.html.twig")
     */
    public function demoAction()
    {
        $entity  = new Contract();
        $form = $this->createForm(new ContractType(), $entity)->createView();
        
        
        return array('form' => $form);
    }
    
    
}
