<?php

namespace DoctrineEncrypt\Test\Functional\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineEncrypt\Configuration\Encrypted;

#[ORM\Entity]
class User
{
    /**
     *
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected $id;

    /**
     * @var string
     */
    #[ORM\Column(type: "string", length: 64)]
    protected $username;

    /**
     * @var string
     */
    #[ORM\Column(type: "string", length: 64)]
    #[Encrypted]
    protected $password;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
