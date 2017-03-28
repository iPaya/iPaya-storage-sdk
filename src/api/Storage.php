<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPaya\storage\api;


use yii\helpers\FileHelper;

class Storage extends AbstractApi
{
    /**
     * @param string $src
     * @return array
     */
    public function upload($src)
    {
        $mimeType = FileHelper::getMimeType($src);
        $filename = pathinfo($src, PATHINFO_BASENAME);
        $options = [
            'fileName' => $filename,
            'mimeType' => $mimeType
        ];

        return $this->postWithFile('upload/file', 'file', file_get_contents($src), $options);
    }
}
