<?php
declare(strict_types=1);

namespace Iono\Stiletto;

use Psr\Container\ContainerInterface;
use Iono\Stiletto\Exceptions\NotFoundException;

/**
 * Class Container
 */
class Container implements ContainerInterface
{
    /** @var Binding */
    protected $binding;

    /**
     * Container constructor.
     *
     * @param Binding $binding
     */
    public function __construct(Binding $binding)
    {
        $this->binding = $binding;
    }

    /**
     * @param string $id
     *
     * @return object
     * @throws NotFoundException
     */
    public function get($id)
    {
        if ($this->has($id)) {
            $resolved = $this->binding->getBinding($id);
            try {
                $arguments = [];
                $reflectionClass = new \ReflectionClass($resolved->concrete());
                if ($reflectionClass->isInstantiable()) {
                    $constructor = $reflectionClass->getConstructor();
                    if ($constructor instanceof \ReflectionMethod) {
                        $arguments = $this->resolveConstructorParameters($id, $constructor);
                    }

                    return $reflectionClass->newInstanceArgs($arguments);
                }
            } catch (\ReflectionException $e) {
                throw new NotFoundException(sprintf('Identifier "%s" is not binding.', $id));
            }
        }
    }

    /**
     * @param string            $id
     * @param \ReflectionMethod $constructor
     *
     * @return array
     */
    protected function resolveConstructorParameters(string $id, \ReflectionMethod $constructor): array
    {
        $resolvedParameters = [];
        if ($parameters = $constructor->getParameters()) {
            foreach ($parameters as $parameter) {
                if ($parameter->isDefaultValueAvailable()) {
                    $resolvedParameters[$parameter->getName()] = $parameter->getDefaultValue();
                }
                if ($this->binding->getParameters($id)) {
                    if (isset($this->binding->getParameters($id)[$parameter->getName()])) {
                        $parameterValue = $this->binding->getParameters($id)[$parameter->getName()];
                        if ($parameterValue instanceof Instance) {
                            $parameterValue = $this->get($parameterValue->getName());
                        }
                        $resolvedParameters[$parameter->getName()] = $parameterValue;
                    }
                }
            }
        }

        return $resolvedParameters;
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has($id)
    {
        return $this->binding->hasBinding($id);
    }
}
