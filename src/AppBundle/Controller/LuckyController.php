<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LuckyController extends Controller {
    /**
     * @Route("/lucky/number/{count}", defaults={"count" = 1})
     * @Route("/DoMaS/lucky/number/{count}", defaults={"count" = 1})
     */
    public function numberAction($count) {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }

        return $this->render(
            'lucky/number.html.twig',
            array('numbers' => $numbers)
        );
    }
}