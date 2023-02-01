<?php

namespace DoctrineEncrypt\Configuration;

use Attribute;

/**
 * The Encrypted class handles the @Encrypted annotation.
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 * @Annotation
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Encrypted
{
    // some parameters will be added
}
