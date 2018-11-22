<?php
/*
Please take a look at the piece of code. 
We've got a class Fight, which implements a logic of a fight between two heroes. 
After the fight one of the hero may lose some health points.
Please make an implementation of a test for Fight::makeFight() method.

Feel free to refactor a code if you think it's needed.
*/

// interface HeroInterface
// {

    // public function getForce(): int;

    // public function getImmunity(): int;

    // public function getHealthPoints(): int;

    // public function setHealthPoints(int $healthPoints);
// }

// class DamageHelper
// {

    // public static function getDamage(HeroInterface $attacker, HeroInterface $defender)
    // {
        // if ($attacker->getForce() < $defender->getForce()) {
            // return 0;
        // }

        // return round(($attacker->getForce() - $defender->getForce())/$defender->getImmunity());
    // }
// }

// class Fight
// {

    // public function makeFight(HeroInterface $hero1, HeroInterface $hero2)
    // {
        // if (mt_rand(10) % 2 == 0) {
            // $attacker = $hero1;
            // $defender = $hero2;
        // } else {
            // $attacker = $hero2;
            // $defender = $hero1;
        // }
        
        // $damage = DamageHelper::getDamage($attacker, $defender);
        // $defender->setHealthPoints($defender->getHealthPoints()-$damage);
    // }
// }

// class FightTest extends TestCase {

    // public function testMakeFight()
    // {
      // implement the test   
    // }
// }

/*
 * Unfortunately, I have no any information about the test platform and about fixtures and etc. 
 * So anyway I just made some minor code changes and wrote some quick test case for the fight.
 */

interface HeroInterface
{

    public function getForce(): int;

    public function getImmunity(): int;

    public function getHealthPoints(): int;

    public function setHealthPoints(int $healthPoints);
}

abstract class HeroBase  implements HeroInterface{

    private $immunity;
    private $health;

    public function __construct(int $health, int $force, int $immunity = 0) {
        $this->force = $force;
        $this->immunity = $immunity;
        $this->setHealthPoints($health);
    }

    public function getForce(): int {
        return (int) $this->force;
    }

    public function getImmunity(): int {
        return (int) $this->immunity;
    }

    public function getHealthPoints(): int {
        return (int) $this->health;
    }

    public function setHealthPoints(int $healthPoints) {
        $this->health = $healthPoints;
    }
}

class Hero extends HeroBase {

}

class DamageHelper
{

    public static function getDamage(HeroInterface $attacker, HeroInterface $defender)
    {
        $damage = 0;
        if ($attacker->getForce() > $defender->getForce()) {
            $damage = round(($attacker->getForce() - $defender->getForce())/$defender->getImmunity());
        }

        return $damage;
    }
}

class Fight
{

    public function makeFight(HeroInterface $hero1, HeroInterface $hero2)
    {

        if (mt_rand(0, 1)) {
            $attacker = $hero1;
            $defender = $hero2;
        } else {
            $attacker = $hero2;
            $defender = $hero1;
        }
        
        $damage = DamageHelper::getDamage($attacker, $defender);
        $defender->setHealthPoints($defender->getHealthPoints() - $damage);
    }
}

class FightTest extends TestCase {

    public function testMakeFight()
    {
        $fight = new Fight();
        $hero1 = new Hero(100, 5, 2);
        $hero2 = new Hero(100, 6);
        $hero3 = new Hero(100, 5);

        $fight->makeFight($hero1, $hero3);
        $fight->makeFight($hero1, $hero3);
        $fight->makeFight($hero1, $hero3);
        $this->assertEquals($hero1->getHealthPoints(), $hero3->getHealthPoints());

        $fight->makeFight($hero1, $hero2);
        $fight->makeFight($hero1, $hero2);
        $fight->makeFight($hero1, $hero2);
        $fight->makeFight($hero1, $hero2);
        $fight->makeFight($hero1, $hero2);
        $fight->makeFight($hero1, $hero2);

        $this->assertTrue(($hero1->getHealthPoints() < $hero2->getHealthPoints()));
    }
}

$test = new FightTest();

$test->testMakeFight();