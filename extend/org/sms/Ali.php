<?php

namespace org\sms;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;

class Ali
{
    public static function send($config, $phone, $data = [])
    {
        $client = self::createClient($config['sms_ali_key'], $config['sms_ali_secret']);
        $sendSmsRequest = new SendSmsRequest();
        $sendSmsRequest->phoneNumbers = $phone;
        $sendSmsRequest->signName = $config['sms_ali_appsign'];
        $sendSmsRequest->templateCode = $config['sms_ali_code_temp'];
        $sendSmsRequest->templateParam = $data;

        // 复制代码运行请自行打印 API 的返回值
        $res = $client->sendSms($sendSmsRequest);
        return $res->body;
    }

    /**
     * 使用AK&SK初始化账号Client
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return Dysmsapi Client
     */
    private static function createClient($accessKeyId, $accessKeySecret){
        $config = new Config([
            // 您的AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 您的AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        // 访问的域名
        $config->endpoint = "dysmsapi.aliyuncs.com";
        return new Dysmsapi($config);
    }

}
