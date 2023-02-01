<?php
namespace DoctrineEncrypt\Test\Encryptors;

use DoctrineEncrypt\Encryptors\OpenSslEncryptor;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class OpenSslEncryptorTest
 */
class OpenSslEncryptorTest extends KernelTestCase
{

    public function testEncryptDecrypt()
    {
        $sixteenChars = '3_2_C_H_A_R_S_*_*_*_*_*_*_*_*_*_';
        $e = new OpenSslEncryptor($sixteenChars);

        $plainText = 'test-data';

        $cipherText = $e->encrypt($plainText);
        $this->assertNotEquals($plainText, $cipherText);

        $this->assertEquals($plainText, $e->decrypt($cipherText));
    }

    public function testEncryptDecryptNull()
    {
        $sixteenChars = '3_2_C_H_A_R_S_*_*_*_*_*_*_*_*_*_';
        $e = new OpenSslEncryptor($sixteenChars);

        $plainText = null;

        $cipherText = $e->encrypt($plainText);
        $this->assertNull($cipherText);

        $this->assertNull($e->decrypt($cipherText));
    }

    public function testEncryptDecryptEmpty()
    {
        $sixteenChars = '3_2_C_H_A_R_S_*_*_*_*_*_*_*_*_*_';
        $e = new OpenSslEncryptor($sixteenChars);

        $plainText = '';

        $cipherText = $e->encrypt($plainText);
        $this->assertNotEquals($plainText, $cipherText);

        $this->assertTrue($plainText === $e->decrypt($cipherText));
    }
}
