<?php

namespace app\common\utilities;

use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Storage\StorageObject;
use Google\Cloud\Storage\WriteStream;
use JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;


class GoogleCloudStorage
{
    const BUCKKET_NAME = 'adsspy';
    const CLIENT_SECRET_PATH = './clientSecretAccount.json';


    static protected $_instance = null;

    static public function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    public static function uploadFile($fileName, $pathFile)
    {
        $storageClient = self::getStorageClient();
        $file = fopen($pathFile, 'rb');
        $bucket = $storageClient->bucket(self::BUCKKET_NAME);
        $object = $bucket->upload(
            $file,
            [
                'name' => $fileName,
                // 'predefinedAcl' => 'PUBLICREAD'
            ]
        );

        return $object->info();
    }


    public static function uploadImage($fileName, $pathFile, $bucketName = 'zalo-image')
    {
        if (file_exists($pathFile)) {
            $storageClient = self::getStorageClient();
            $file = fopen($pathFile, 'rb');
            $bucket = $storageClient->bucket($bucketName);
            $object = $bucket->upload(
                $file,
                [
                    'name' => $fileName,
                    // 'predefinedAcl' => 'PUBLICREAD'
                ]
            );

            return $object->info();
        }

        return '';
    }

    public static function getStorageClient()
    {
        return new StorageClient(
            [
                'projectId' => 'leadads',
                'keyFile'   => json_decode(file_get_contents(self::CLIENT_SECRET_PATH), true)
            ]
        );
    }

    public static function uploadFiles($data, $bucketName, $endId)
    {
        if (! $bucketName) {
            $bucketName = self::BUCKKET_NAME;
        }
        $storageClient = self::getStorageClient();
        $bucket = $storageClient->bucket($bucketName);
        $promises = [];
        foreach ($data as $item) {
            $promises[] = $bucket->uploadAsync($item['value'], ['name' => $item['name']])
                                 ->then(
                                     function (StorageObject $object) use ($item) {
                                         $info = $object->info();
                                         if (! empty($info['id'])) {
//						echo "<pre>\n";
//						print_r($item['path']);
                                             //	@unlink($item['path']);
//                                             echo "<pre>\n ";
//                                             print_r('Upload file ' . $info['name'] . ' lên google cloud thành công');
                                         }
                                     },
                                     function (\Exception $e) {
                                         return $e->getMessage();
//                                         echo "<pre>";
//                                         print_r($e->getMessage());
//                                         die;
                                     }
                                 );
        }
        foreach ($promises as $index => $promise) {
            $promise->wait();
            //echo "\n"; print_r($promise->getState());
        }

        return $endId;
    }


    public static function getDataFile($fileName)
    {
//		try
//		{
//			ini_set('memory_limit', '-1');
//			$storage = self::getStorageClient();
//			$storage->registerStreamWrapper();
//			$path = sprintf('gs://%s/%s', self::BUCKKET_NAME, $fileName);
//			//$data = @file_get_contents($path);
//			$data = explode("\n", @file_get_contents($path));
//			if ($data)
//			{
//				return  array_unique(array_values(array_filter($data)));
//			}
//			return NULL;
//		} catch (\Exception $e)
//		{
//			echo "<pre>";
//			print_r($e->getMessage());
//			die;
//		}
        try {
//            ini_set('memory_limit', '-1');
            $storage = self::getStorageClient();
            $storage->registerStreamWrapper();
            $path = sprintf('gs://%s/%s', self::BUCKKET_NAME, $fileName);
            //$data = @file_get_contents($path);
            $data = explode("\n", @file_get_contents($path));
            if ($data) {
                return array_unique(array_values(array_filter($data)));
            }

            return null;
        } catch (\Exception $e) {
            echo "<pre>";
            print_r($e->getMessage());
            die;
        }
    }


    public static function getDataFileJson($fileName, $bucketName)
    {
        try {
			$googleClient = self::getStorageClient();
			$googleClient->bucket($bucketName)->object($fileName)->info();
			$googleClient->registerStreamWrapper();
			$filePath = sprintf('gs://%s/%s', $bucketName, $fileName);
			$fileContent = Items::fromFile($filePath, ['decoder' => new ExtJsonDecoder(TRUE)]);
			return $fileContent;
        } catch (\Exception $e) {
            return  [];
        }
    }

    public static function checkFileExists($fileName, $bucked = self::BUCKKET_NAME)
    {
        $storage = self::getStorageClient();

        return $storage->bucket($bucked)->object($fileName)->exists();
    }


    public static function uploadObjectStream(string $contentPath, string $objectName, string $bucketName): string
    {
        try {
            $storageClient = self::getStorageClient();
            $bucket = $storageClient->bucket($bucketName);
            $writeStream = new WriteStream(
                null, [
                        'chunkSize' => 1024 * 256, // 256KB
                    ]
            );
            $uploader = $bucket->getStreamableUploader(
                $writeStream,
                [
                    'name'          => $objectName,
                    'predefinedAcl' => 'PUBLICREAD'
                ]
            );
            $writeStream->setUploader($uploader);
            $stream = fopen($contentPath, 'r');
            while (($line = stream_get_line($stream, 1024 * 256)) !== false) {
                $writeStream->write($line);
            }
            $writeStream->close();

            return sprintf('%s/%s', $bucketName, $objectName);
        } catch (\Exception $e) {
            return '';
        }
    }
}