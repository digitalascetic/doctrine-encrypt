<?php

namespace DoctrineEncrypt\Test\Functional;

use DoctrineEncrypt\Test\Functional\Entity\User;

class DoctrineEncryptSubscriberTest extends BaseTestCase
{
    const USER = 'DoctrineEncrypt\Test\Functional\Entity\User';
    /**
     * @var int
     */
    private $userId;

    public function setUp(): void
    {
        parent::setUp();
        $this->populate();
    }

    public function testReadUnencryptedPassword()
    {
        $conn = $this->em->getConnection();
        $result = $conn->executeQuery('SELECT password FROM User')->fetchOne();

        $this->assertNotEquals($result, 'testPassword');

        /** @var User $user */
        $user = $this->em->find(self::USER, $this->userId);

        $this->assertNotNull($user);
        $this->assertEquals('testPassword', $user->getPassword());
    }

    public function testDirtyEntity()
    {
        /** @var User $user */
        $user = $this->em->find(self::USER, $this->userId);
        $this->assertEquals('testPassword', $user->getPassword());

        // $this->em->getUnitOfWork()->computeChangeSets();
        // $this->assertFalse($this->em->getUnitOfWork()->isScheduledForUpdate($user));
    }

    public function testCommit()
    {
        $password = 'test2';

        $user = new User();
        $user->setUsername('test2');
        $user->setPassword($password);

        $this->em->persist($user);

        //Ensure the password is still plaintext after persist operation
        $this->assertEquals($password, $user->getPassword());

        $this->em->flush($user);

        //Ensure the password is still plaintext after flush
        $this->assertEquals($password, $user->getPassword());

        //Ensure we have a clean object
        //$this->em->getUnitOfWork()->computeChangeSets();
        //$this->assertFalse($this->em->getUnitOfWork()->isScheduledForUpdate($user));
    }

    /**
     * Get a list of used fixture classes
     *
     * @return array
     */
    protected function getUsedEntityFixtures()
    {
        return array(
            self::USER,
        );
    }

    private function populate()
    {
        $user = new User();
        $user->setUsername('testUsername');
        $user->setPassword('testPassword');

        $this->em->persist($user);
        $this->em->flush();
        $this->em->clear();
        $this->userId = $user->getId();
    }
}
