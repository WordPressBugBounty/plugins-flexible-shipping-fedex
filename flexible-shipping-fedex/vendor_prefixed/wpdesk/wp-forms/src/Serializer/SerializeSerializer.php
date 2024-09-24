<?php

namespace FedExVendor\WPDesk\Forms\Serializer;

use FedExVendor\WPDesk\Forms\Serializer;
class SerializeSerializer implements \FedExVendor\WPDesk\Forms\Serializer
{
    public function serialize($value) : string
    {
        return \serialize($value);
    }
    public function unserialize(string $value)
    {
        return \unserialize($value);
    }
}
