<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class CacheController extends Controller {
    /**
     * @Route("/reset", name="_reset")
     */
    public function resetAction() {
        $response = "<pre>";

        if (extension_loaded('apc')) {
            $response .= "APC-User cache: " . apc_clear_cache('user') . "\n";
            $response .= "APC-System cache: " . apc_clear_cache() . "\n";
        }

        if (extension_loaded('apcu')) {
            $response .= "APC-User cache: " . apc_clear_cache('user') . "\n";
        }

        if (function_exists('opcache_reset')) {
            // Clear it twice to avoid some internal issues...
            opcache_reset();
            opcache_reset();
            $response .= "OP Cache resetted\n";
        }

        // Console reset
        $command = $this->container->get('app.cache.clear');
        //$dev = new ArgvInput(array('--env=dev'));
        $prod = new ArgvInput(array('--env=prod'));

        //$output = new ConsoleOutput();
        //$command->run($dev, $output);
        //$response .= "dev Cache resetted\n";

        $output = new ConsoleOutput();
        $command->run($prod, $output);
        $response .= "prod Cache resetted\n";

        // Cache Warmup
        $command = $this->container->get('app.cache.warmup');
        $output = new ConsoleOutput();
        $command->run($prod, $output);

        $response .= "All Caches cleared\n";
        $response .= "</pre>";

        return new Response($response);
    }
}