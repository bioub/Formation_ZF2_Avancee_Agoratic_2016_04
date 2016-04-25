<?php

namespace CsvView\Model;


use Traversable;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Model\ViewModel;

class CsvModel extends ViewModel
{
    public function serialize()
    {
        $variables = $this->getVariables();
        if ($variables instanceof Traversable) {
            $variables = ArrayUtils::iteratorToArray($variables);
        }


    }
}
