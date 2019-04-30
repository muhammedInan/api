<?php
// src/CacheKernel.php
namespace App;

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

class CacheKernel extends HttpCache
{
    protected function getOptions()
    {
        return [
            'default_ttl' => 0,
            // ...
        ];
    }
}