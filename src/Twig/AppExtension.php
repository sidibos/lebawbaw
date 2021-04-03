<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('base64', [$this, 'twig_base64_filter']),
        ];
    }

    function twig_base64_filter($source)
    {   if($source!=null) {           
           return base64_encode(stream_get_contents($source));
        }
        return '';
    }
}