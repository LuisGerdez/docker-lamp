<?php

namespace Models;


use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Error;

// require_once __DIR__.'/../administrar/vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

class Bucket
{
    //atributos
    public $S3;
    public $options = [];
    public $region = '';
    public $version = '';
    private $key = '';
    private $secret = '';
    private $bucket = '';


    public function __construct($bucket = 'firmadoc-bucket', $key = 'AKIAR5YN5DPDAVDEBXAH', $secret = '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', $region = 'us-east-1', $version = 'latest')
    {
        $this->bucket = $bucket;
        $this->region = $region;
        $this->version = $version;
        $this->key = $key;
        $this->secret = $secret;
        $this->options = [
            'region' => $this->region,
            'version' => $this->version,
            'credentials' => [
                'key' => $this->key,
                'secret' => $this->secret
            ]
        ];
        $this->S3 = new S3Client($this->options);
    }


    public function s3UploadObject($file_path, $file_name, $path_key = CLIENT.'/firmados/')
    {
        try {
            $result = $this->S3->putObject([
                'Bucket' => $this->bucket,
                'Key' => $path_key . $file_name,
                'SourceFile' => $file_path

            ]);
            return $result;
        } catch (S3Exception $e) {
            error_log($e, 0, '../php-error.log');
        }
    }

    public function s3DownloadObject($key, $path_key = CLIENT.'/firmados/')
    {
        try {
            $result = $this->S3->getObject([
                'Bucket' => 'firmadoc-bucket',
                'Key'    => $path_key . $key
            ]);
            header("Content-Type: {$result['ContentType']}");
            header("Content-Disposition: attachment; filename={$key}");
            echo $result['Body'];
        } catch (S3Exception $e) {
            // echo $e->getMessage() . PHP_EOL;
            error_log($e, 0, '../php-error.log');
        }
    }

    public function s3DownloadObjectRoute($key, $ruta, $path_key = CLIENT.'/pendientes/')
    {

        try {
            $result = $this->S3->getObject([
                'Bucket' => 'firmadoc-bucket',
                'Key'    =>  $path_key . $key
            ]);
            $body = $result->get('Body');
            file_put_contents($ruta, $body);
        } catch (S3Exception $e) {
            error_log($e, 0, '../php-error.log');
        }
    }

    public function s3DownloadObjectAjax($key, $path_key = CLIENT.'/firmados/')
    {
        try {
            $result = $this->S3->getObject([
                'Bucket' => $this->bucket,
                'Key'    => $path_key . $key
            ]);
            $body = $result->get('Body');
            $pdf = base64_encode($body);
            return $pdf;
        } catch (S3Exception $e) {
            error_log($e, 0, '../php-error.log');
        }
    }
    public function s3DownloadObjectB64($key, $path_key = CLIENT.'/firmados/')
    {
        try {
            $result = $this->S3->getObject([
                'Bucket' => $this->bucket,
                'Key'    => $path_key . $key
            ]);
            $body = $result->get('Body');
            $pdf = base64_encode($body);
            return $pdf;
        } catch (S3Exception $e) {
            // echo $e->getMessage() . PHP_EOL;
            error_log($e, 0, '../php-error.log');
        }
    }

    public function s3ListObject()
    {
    }

    public function s3DeleteObject()
    {
    }

    public function s3SignatureObject()
    {
    }
}
