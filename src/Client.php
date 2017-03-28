<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPaya\storage;


use iPaya\storage\api\Storage;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;

class Client extends Component
{
    public $serverUrl = 'http://api.storage.ipaya.cn';
    public $appId;
    public $appSecret;

    /**
     * @var
     */
    private $request;

    public function init()
    {

        if ($this->appId == null) {
            throw new InvalidConfigException('请配置 "appId".');
        }
        if ($this->appSecret == null) {
            throw new InvalidConfigException('请配置 "appSecret".');
        }

        parent::init();
    }

    public function api($name)
    {
        switch ($name) {
            case 'storage':
                $api = new Storage($this);
                break;
            default:
                throw new InvalidParamException('错误的 api 接口');
        }
        return $api;
    }

    /**
     * @return \yii\httpclient\Request
     */
    public function getRequest()
    {
        if (null === $this->request) {
            $client = new \yii\httpclient\Client([
                'baseUrl' => $this->serverUrl,
            ]);
            $this->request = $client->createRequest()
                ->addHeaders([
                    'Authorization' => 'Basic ' . base64_encode("{$this->appId}:{$this->appSecret}")
                ]);

        }

        return $this->request;
    }
}
