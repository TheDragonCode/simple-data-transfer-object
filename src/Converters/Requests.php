<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Converters;

use DragonCode\Contracts\Support\Arrayable;
use DragonCode\Support\Concerns\Makeable;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method static Requests make($request)
 */
class Requests implements Arrayable
{
    use Makeable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function toArray(): array
    {
        return method_exists($this->request, 'all')
            ? $this->request->all()
            : $this->request->toArray();
    }
}
