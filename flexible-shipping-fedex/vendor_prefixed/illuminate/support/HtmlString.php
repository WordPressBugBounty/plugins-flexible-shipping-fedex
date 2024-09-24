<?php

namespace FedExVendor\Illuminate\Support;

use FedExVendor\Illuminate\Contracts\Support\Htmlable;
class HtmlString implements \FedExVendor\Illuminate\Contracts\Support\Htmlable
{
    /**
     * The HTML string.
     *
     * @var string
     */
    protected $html;
    /**
     * Create a new HTML string instance.
     *
     * @param  string  $html
     * @return void
     */
    public function __construct($html = '')
    {
        $this->html = $html;
    }
    /**
     * Get the HTML string.
     *
     * @return string
     */
    public function toHtml()
    {
        return $this->html;
    }
    /**
     * Determine if the given HTML string is empty.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->html === '';
    }
    /**
     * Determine if the given HTML string is not empty.
     *
     * @return bool
     */
    public function isNotEmpty()
    {
        return !$this->isEmpty();
    }
    /**
     * Get the HTML string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toHtml();
    }
}