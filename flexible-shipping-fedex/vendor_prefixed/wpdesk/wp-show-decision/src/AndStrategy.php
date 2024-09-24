<?php

namespace FedExVendor\WPDesk\ShowDecision;

class AndStrategy implements \FedExVendor\WPDesk\ShowDecision\ShouldShowStrategy
{
    /**
     * @var ShouldShowStrategy[]
     */
    private array $conditions = [];
    public function __construct(\FedExVendor\WPDesk\ShowDecision\ShouldShowStrategy $strategy)
    {
        $this->conditions[] = $strategy;
    }
    public function addCondition(\FedExVendor\WPDesk\ShowDecision\ShouldShowStrategy $condition) : self
    {
        $this->conditions[] = $condition;
        return $this;
    }
    public function shouldDisplay() : bool
    {
        foreach ($this->conditions as $condition) {
            if (!$condition->shouldDisplay()) {
                return \false;
            }
        }
        return \true;
    }
}
