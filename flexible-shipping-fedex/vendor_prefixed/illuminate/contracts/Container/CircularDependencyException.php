<?php

namespace FedExVendor\Illuminate\Contracts\Container;

use Exception;
use FedExVendor\Psr\Container\ContainerExceptionInterface;
class CircularDependencyException extends Exception implements ContainerExceptionInterface
{
    //
}
