<?php
declare(strict_types=1);

namespace Iono\Stiletto;

/**
 * Class Map
 */
class Map
{
    /** @var string */
    private $abstract;

    /** @var string */
    private $concrete;

    /**
     * Map constructor.
     *
     * @param string $abstract
     * @param string $concrete
     */
    public function __construct(string $abstract, string $concrete)
    {
        $this->abstract = $abstract;
        $this->concrete = $concrete;
    }

    /**
     * @return string
     */
    public function abstract(): string
    {
        return $this->abstract;
    }

    /**
     * @return string
     */
    public function concrete(): string
    {
        return $this->concrete;
    }
}
