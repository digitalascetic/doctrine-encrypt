<?php
/**
 * Created by IntelliJ IDEA.
 * User: martino
 * Date: 30/03/18
 * Time: 10:59
 */

namespace DoctrineEncrypt\Test\Functional;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

abstract class BaseTestCase extends KernelTestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    protected function setUp(): void
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir() . '/DoctrineEncrypt');

        self::bootKernel();

        $this->container = static::getContainer();
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->dispatcher = $this->container->get('event_dispatcher');

        $this->importDatabaseSchema();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->container = null;
        $this->em->close();
        $this->em = null;
    }

    protected function importDatabaseSchema()
    {
        $metadata = $this->em->getMetadataFactory()->getAllMetadata();
        if (!empty($metadata)) {
            $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
            $schemaTool->dropDatabase();
            $schemaTool->createSchema($metadata);
        }
    }


}
