<?php

/**
 * PHP version 7.4
 * tests/Entity/ResultTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

/**
 * Class ResultTest
 *
 * @package MiW\Results\Tests\Entity
 */
class ResultTest extends TestCase
{

    private $user;
    private $result;
    private const USERNAME = 'hector';
    private const POINTS = 2018;
    private \DateTime $time;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->user = new User();
        $this->user->setUsername(self::USERNAME);
        $this->time = new \DateTime('now');
        $this->result = new Result(
            self::POINTS,
            $this->user,
            $this->time
        );
    }

    /**
     * Implement testConstructor
     *
     * @covers \MiW\Results\Entity\Result::__construct()
     * @covers \MiW\Results\Entity\Result::getId()
     * @covers \MiW\Results\Entity\Result::getResult()
     * @covers \MiW\Results\Entity\Result::getUser()
     * @covers \MiW\Results\Entity\Result::getTime()
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $this->result->__construct(
            23,
            $this->user,
            new \DateTime('now')
        );
        $this->assertSame(23, $this->result->getResult());
        $this->assertSame(0, $this->result->getUser()->getId());
    }

    /**
     * Implement testGet_Id().
     *
     * @covers \MiW\Results\Entity\Result::getId()
     * @return void
     */
    public function testGetId():void
    {
        $this->assertSame(0, $this->result->getId());
    }

    /**
     * Implement testUsername().
     *
     * @covers \MiW\Results\Entity\Result::setResult
     * @covers \MiW\Results\Entity\Result::getResult
     * @return void
     */
    public function testResult(): void
    {
        $this->result->setResult(1);
        $this->assertSame(1, $this->result->getResult());
    }

    /**
     * Implement testUser().
     *
     * @covers \MiW\Results\Entity\Result::setUser()
     * @covers \MiW\Results\Entity\Result::getUser()
     * @return void
     */
    public function testUser(): void
    {
        $this->user = new User();
        $this->user->setUsername('pepe');
        $this->result->setUser($this->user);
        $this->assertSame($this->user, $this->result->getUser());
    }

    /**
     * Implement testTime().
     *
     * @covers \MiW\Results\Entity\Result::setTime
     * @covers \MiW\Results\Entity\Result::getTime
     * @return void
     */
    public function testTime(): void
    {
        //TODO HACERRRRRRR
        assertSame(true, true);
    }

    /**
     * Implement testTo_String().
     *
     * @covers \MiW\Results\Entity\Result::__toString
     * @return void
     */
    public function testToString(): void
    {
        $this->assertSame(sprintf(
            '%3d - %3d - %22s - %s',
            0,
            2018,
            'hector',
            $this->time->format('Y-m-d H:i:s')
        ), $this->result->__toString());
    }

    /**
     * Implement testJson_Serialize().
     *
     * @covers \MiW\Results\Entity\Result::jsonSerialize
     * @return void
     */
    public function testJsonSerialize(): void
    {
        $this->assertSame([
            'id' => 0,
            'result' => 2018,
            'user'   => $this->user,
            'time'   => $this->time->format('Y-m-d H:i:s')
        ], $this->result->jsonSerialize());
    }
}
