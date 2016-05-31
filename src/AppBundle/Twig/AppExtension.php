<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('highlight', array($this, 'highlightFilter')),
        );
    }

    public function highlightFilter($text, $global_search = '', $search = '') {
        if(strlen(trim($global_search)) > 0 || strlen(trim($search)) > 0) {
            $words = '';

            // Erster Suchparameter
            if(strlen(trim($global_search)) > 0) {
                $words = preg_quote($global_search) . '|' . str_replace(' ', '|', preg_quote($global_search));
            }

            // Zweiter Suchparameter
            if(strlen(trim($search)) > 0) {
                if(strlen($words) > 0) {
                    $words .= '|';
                }

                $words .= preg_quote($search) . '|' . str_replace(' ', '|', preg_quote($search));
            }

            $highlighted = preg_filter(
                '/(' . $words  . ')/i',
                '<span class="highlight">$0</span>',
                $text
            );

            if (!empty($highlighted)) {
                $text = $highlighted;
            }
        }

        return $text;
    }

    public function getName() {
        return 'app_extension';
    }
}