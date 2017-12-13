<?php
/*
 *加解密
 *
 *1.配置
 *  php artisan key:generate (生成32为的APP_KEY)
 *
 *2.序列化加解密
 *      encrypt($string)
 *      decrypt($string);
 *
 * 3.普通加解密
 *      Crypt::encryptString($string)
 *      Crypt::decryptString($string);
 *
 *
 * Hash
 *
 * 1.对密码进行哈希
 *      Hash::make($password)
 *
 * 2.通过哈希验证密码
 *      Hash::check('password', $hashedPassword)
 *
 * */
