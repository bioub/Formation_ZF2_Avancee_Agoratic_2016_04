<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CsvView\Renderer;

use CsvView\Model\CsvModel;
use JsonSerializable;
use Traversable;
use Zend\Json\Json;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Exception;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ModelInterface as Model;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\ResolverInterface;

class CsvRenderer implements RendererInterface
{
    /**
     * @var ResolverInterface
     */
    protected $resolver;


    public function getEngine()
    {
        return $this;
    }

    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    public function render($nameOrModel, $values = null)
    {
        if ($nameOrModel instanceof CsvModel) {
            $values = $nameOrModel->serialize();
            return $values;
        }

        // use case 3: Both $nameOrModel and $values are populated
        throw new Exception\DomainException(sprintf(
            '%s: Do not know how to handle operation when both $nameOrModel and $values are populated',
            __METHOD__
        ));
    }

}
