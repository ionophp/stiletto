<?php
declare(strict_types=1);

namespace Iono\Stiletto;

/**
 * Class Binding
 */
class Binding
{
    /** @var Map[] */
    private $arrayStorage = [];

    /** @var string[] */
    private $parameters = [];

    /**
     * @param string      $abstract
     * @param string      $concrete
     * @param string|null $qualifier
     * @param string      $scope
     */
    public function setBinding(
        string $abstract,
        string $concrete,
        string $qualifier = null,
        string $scope = Scope::PROTOTYPE
    ) {
        $qualifier = ($qualifier) ?? $abstract;
        $this->arrayStorage[$qualifier] = new Map($abstract, $concrete);
    }

    /**
     * @param string $abstract
     *
     * @return bool
     */
    public function hasBinding(string $abstract): bool
    {
        return isset($this->arrayStorage[$abstract]);
    }

    /**
     * @param string $abstract
     *
     * @return null|Map
     */
    public function getBinding(string $abstract)
    {
        if ($this->hasBinding($abstract)) {
            return $this->arrayStorage[$abstract];
        }

        return null;
    }

    /**
     * @param string $id
     * @param string $name
     * @param mixed  $mixed
     */
    public function setParameters(string $id, string $name, $mixed)
    {
        $this->parameters[$id][$name] = $mixed;
    }

    /**
     * @param string $id
     *
     * @return null|string|\string[]
     */
    public function getParameters(string $id)
    {
        return ($this->parameters[$id]) ?? null;
    }
}
