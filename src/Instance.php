<?php
declare(strict_types=1);

namespace Iono\Stiletto;

/**
 * Class Instance
 */
final class Instance
{
    /** @var string  */
    private $name;

    /**
     * Instance constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
