<?php
declare(strict_types=1);

namespace Iono\Stiletto\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

/**
 * Class NotFoundException
 */
final class NotFoundException extends \Exception implements NotFoundExceptionInterface
{

}
