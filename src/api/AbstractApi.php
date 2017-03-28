<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPaya\storage\api;


use iPaya\storage\Client;
use yii\helpers\Json;

abstract class AbstractApi
{
    /**
     * @var Client
     */
    protected $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function postWithFile($path, $field, $content, $options = [])
    {
        $request = $this->client->getRequest();
        $request->setUrl($path);
        $request->setMethod('post');
        $request->addContent($field, $content, $options);

        $response = $request->send();
        if ($response->isOk) {
            return Json::decode($response->content);
        }
        return Json::decode($response->content);
    }

}
