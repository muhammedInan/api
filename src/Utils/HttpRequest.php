<?php

namespace App\Utils;

class HttpRequest 
    {
    private $handle = null;

    public function __construct(string $url)
    {
    $this->handle = curl_init($url);
    }

    public function setOption($name, $value)
    {
    curl_setopt($this->handle, $name, $value);
    }

    public function execute()
    {
    return curl_exec($this->handle);
    }

    public function getInfo($name = null)
    {
    return $name ? curl_getinfo($this->handle, $name) : curl_getinfo($this->handle);
    }

    public function close()
    {
    curl_close($this->handle);
    }
    }