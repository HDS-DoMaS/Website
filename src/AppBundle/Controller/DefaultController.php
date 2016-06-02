<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_default")
     */
    public function indexAction(Request $request) {
        $data = array();

        $form = $this->createFormBuilder($data)
            ->setMethod('GET')
            ->add('suche', TextType::class)
            ->add('hdncollapse', HiddenType::class, array('data' => 'collapsed'))
            ->add('submit', SubmitType::class)
            ->getForm();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
