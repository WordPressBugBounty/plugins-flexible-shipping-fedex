<?php

namespace FedExVendor\WPDesk\Forms\Serializer;

use FedExVendor\WPDesk\Forms\Serializer;
class JsonSerializer implements \FedExVendor\WPDesk\Forms\Serializer
{
    public function serialize($value) : string
    {
        return (string) \json_encode($value);
    }
    public function unserialize(string $value)
    {
        return \json_decode($value, \true);
    }
}
