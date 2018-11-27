<?php

// There is a code supporting calculation if a car is damaged.
// Now it should be extended to support calculating if a painting of car's exterior is damaged (this means, if a painting of any of car details is not OK - for example a door is scratched).

// ```
// <?php

// abstract class CarDetail {

    // private $isBroken;

    // public function __construct(bool $isBroken)
    // {
        // $this->isBroken = $isBroken;
    // }

    // public function isBroken(): bool
    // {
        // return $this->isBroken;
    // }
// }

// class Door extends CarDetail
// {
// }

// class Tyre extends CarDetail
// {
// }

// class Car
// {

    // /**
    //  * @var CarDetail[]
    //  */
    // private $details;

    // /**
    //  * @param CarDetail[] $details
    //  */
    // public function __construct(array $details)
    // {
        // $this->details = $details;
    // }

    // public function isBroken(): bool
    // {
        // foreach ($this->details as $detail) {

            // if ($detail->isBroken()) {
                // return true;
            // }
        // }

        // return false;
    // }

    // public function isPaintingDamaged(): bool
    // {
        // MAKE AN IMPLEMENTATION
    // }
// }

// $car = new Car([new Door(true), new Tyre(false), ....]); // we pass a list of all details
// ```

// Expected result: an implemented code.

// Note: you are allowed (and encouraged) to change anything in the existing code in order to make an implementation SOLID compliant

/**
 *
 * In this case I also have no chance to get the requirements, so I will use my own.
 *
 * PHP7.
 *
 */

/**
 *
 * In this case I also have no chance to get the requirements, so I will use my own.
 *
 * PHP7.
 *
 */
interface IBreakable
{
    public function isBroken(): bool;
}
interface IPaintDamageable
{
    public function isPaintingDamaged(): bool;
}

/**
 * @implements IBreakable
 */
abstract class CarDetail implements IBreakable
{
    private $isBroken;

    public function __construct(bool $isBroken)
    {
        $this->isBroken = $isBroken;
    }

    public function isBroken(): bool
    {
        return (bool)$this->isBroken;
    }
}

/**
 * @extends CarDetail
 * @implements IPaintDamageable
 */
abstract class CarPaintedDetail extends CarDetail implements IPaintDamageable
{
    private $isPaintingDamaged;

    public function __construct(bool $isBroken, $isPaintingDamaged)
    {
        parent::__construct($isBroken);
        $this->isPaintingDamaged = $isPaintingDamaged;
    }

    public function isPaintingDamaged(): bool
    {
        return (bool)$this->isPaintingDamaged;
    }
}

/*
 * Class Tyre.
 * @extends CarDetail
 */
class Tyre extends CarDetail
{
}

/*
 * Class Door.
 *
 */
class Door extends CarPaintedDetail
{
}

/**
 * Car class.
 *
 * @property string $details
 */
class Car
{

    /**
     * @var array
     */
    private $details;

    /**
     * @param array $details
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function isBroken(): bool
    {
        foreach ($this->details as $detail) {
            if ($detail instanceof IBreakable && $detail->isBroken()) {
                return true;
            }
        }

        return false;
    }

    public function isPaintingDamaged(): bool
    {
        foreach ($this->details as $detail) {
            if ($detail instanceof IPaintDamageable && $detail->isPaintingDamaged()) {
                return true;
            }
        }

        return false;
    }
}

$car = new Car([new Door(false, true), new Tyre(false)]);

print_r([$car->isBroken(), $car->isPaintingDamaged()]);
