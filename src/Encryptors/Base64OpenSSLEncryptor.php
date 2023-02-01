<?php
/**
 * Created by IntelliJ IDEA.
 * User: martino
 * Date: 13/12/17
 * Time: 11:52
 */

namespace DoctrineEncrypt\Encryptors;

/**
 * Class Base64OpenSSLEncryptor
 *
 * Created because OpenSslEncryptor returns multibyte chars not
 * allowed by MySQL so we return base64 encoded crypt.
 * 
 * @package DoctrineEncrypt\Encryptors
 */
class Base64OpenSSLEncryptor extends OpenSslEncryptor
{

    public function encrypt($data)
    {
        if ($data === null) {
            return null;
        }

        return base64_encode(parent::encrypt($data));
    }

    public function decrypt($data)
    {
        return parent::decrypt(base64_decode($data));
    }


}
