<?php

namespace Modules\Bookable\Contracts;

interface Bookable
{
    /**
     * Returns whether the product is active (based on its state)
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Returns the title of the product. If no `title` was given, returns the `name` of the product
     *
     * @return string
     */
    public function title(): string;
}