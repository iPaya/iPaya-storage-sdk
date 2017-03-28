<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPayaUnit\storageSdk;


use iPaya\storage\Client;

class StorageTest extends TestCase
{
    /**
     * 测试上传文件
     */
    public function testUpload()
    {
        /** @var Client $storage */
        $storage = \Yii::$app->storage;
        $result = $storage->api('storage')->upload(__DIR__ . '/data/ipaya.png');

        static::assertArrayHasKey('name', $result);
        static::assertArrayHasKey('url', $result);
    }
}
