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
        echo "<pre>";

        if (extension_loaded('apc')) {
            echo "APC-User cache: " . apc_clear_cache('user') . "\n";
            echo "APC-System cache: " . apc_clear_cache() . "\n";
        }

        if (extension_loaded('apcu')) {
            echo "APC-User cache: " . apc_clear_cache('user') . "\n";
        }

        if (function_exists('opcache_reset')) {
            // Clear it twice to avoid some internal issues...
            opcache_reset();
            opcache_reset();
            echo "OP Cache resetted\n";
        }

        // Console reset
        $command = $this->container->get('app.cache.clear');
        //$dev = new ArgvInput(array('--env=dev'));
        $prod = new ArgvInput(array('--env=prod'));

        //$output = new ConsoleOutput();
        //$command->run($dev, $output);
        //echo "dev Cache resetted\n";

        $output = new ConsoleOutput();
        $command->run($prod, $output);
        echo "prod Cache resetted\n";

        // Cache Warmup
        $command = $this->container->get('app.cache.warmup');
        $output = new ConsoleOutput();
        $command->run($prod, $output);

        echo "All Caches cleared\n";
        echo "</pre>";

        return new Response();
    }
}