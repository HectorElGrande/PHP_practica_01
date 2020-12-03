<?php

/**
 * PHP version 7.4
 * tests/Entity/UserTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package MiW\Results\Tests\Entity
 * @group   users
 */
class UserTest extends TestCase
{
    private User $user;
    private string $username = 'hector';
    private string $email = 'x@xyz.com';
    private string $password = '123';
    private bool $enable = false;
    private bool $admin = false;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->user = new User();
        $this->user = new User(
            $this->username,
            $this->email,
            $this->password,
            $this->enable,
            $this->admin
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     */
    public function testConstructor(): void
    {
        $this->user->__construct(
            'pp',
            'pp@',
            '12',
            true,
            true
        );
        $this->assertSame('pp', $this->user->getUsername());
        $this->assertSame('pp@', $this->user->getEmail());
        $this->assertSame(true, $this->user->validatePassword('12'));
        $this->assertSame(true, $this->user->isEnabled());
        $this->assertSame(true, $this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::getId()
     */
    public function testGetId(): void
    {
        $this->assertSame(0, $this->user->getId());
    }

    /**
     * @covers \MiW\Results\Entity\User::setUsername()
     * @covers \MiW\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername(): void
    {
        $this->user->setUsername('pepe');
        $this->assertSame('pepe', $this->user->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail(): void
    {
        $this->user->setEmail('d@j.com');
        $this->assertSame('d@j.com', $this->user->getEmail());
    }

    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled(): void
    {
        $this->user->setEnabled(true);
        $this->assertSame(true, $this->user->isEnabled());
    }

    /**
     * @covers \MiW\Results\Entity\User::setIsAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin
     */
    public function testIsSetAdmin(): void
    {
        $this->user->setIsAdmin(true);
        $this->assertSame(true, $this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testSetValidatePassword(): void
    {
        $this->user->setPassword('12');
        $this->assertSame(true, $this->user->validatePassword('12'));
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString(): void
    {
        $this->assertSame(sprintf(
            '%3d - %20s - %30s - %1d - %1d',
            0,
            $this->username,
            $this->email,
            $this->enable,
            $this->admin
        ), $this->user->toString());
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize(): void
    {
        $this->assertSame([
            'id' => 0,
            'username' => $this->username,
            'email' => $this->email,
            'enabled' => $this->enable,
            'admin' => $this->admin
        ], $this->user->jsonSerialize());
    }
}
