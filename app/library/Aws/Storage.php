<?php

namespace Lackky\Aws;

use Lackky\Constants\UploadTypeConstant;
use Lackky\Models\DownloadableContents;
use Lackky\Models\MediaData;
use Lackky\Models\Services\DownloadableContentService;
use Aws\S3\S3Client;
use Exception;
use Phalcon\Http\Request\FileInterface;
use Phalcon\Mvc\User\Component;

/**
 * Class Storage
 * @package Lackky\Aws
 */
class Storage extends Component
{
    /**
     * @var object
     */
    protected $config;

    public function __construct()
    {
        $this->configure();
        $this->client = $this->s3Client();
        $this->mediaType = new MediaType();
    }

    public function configure()
    {
        /** @noinspection PhpIncludeInspection */
        $config = require config_path('aws.php');
        $this->config = $config['aws'];
    }

    /**
     * @param FileInterface $file
     *
     * @return array|object
     */
    public function upload(FileInterface $file, $id = null)
    {
        if (!file_exists($file->getTempName())) {
            return $this->getError('Path file not found');
        }
        if (!isset($file->fileName)) {
            return $this->getError('You need add property dynamic fileName before send a file name to s3!');
        }
        if (!isset($file->acl)) {
            $file->acl = 'public-read';
        }
        try {
            if ($id) {
                $container = container(MediaData::class);
                $download = $container->getFirstById($id);
            } else {
                $download = new MediaData();
            }

            if ('dev' === env('APPLICATION_ENV')) {
                $file->moveTo($file->fileName);
            } else {
                $this->client->putObject([
                    'Bucket' => $this->config->bucket,
                    'Key'    => $file->fileName,
                    'Body'   => fopen($file->getTempName(), 'rb'),
                    'ACL'    => $file->acl,
                    'ContentType' => $file->getRealType()
                ]);
            }
            //@TODO delete file on aws and verify owner file before update
            $download->setKey($file->fileName);
            $download->setUrl(env('CDN') . '/' . $file->fileName);
            $download->setFileSize($file->getSize());
            $download->setOriginalFile($file->getName());
            $download->setAcl($file->acl);
            $download->setExpires(time() + 888888);
            $download->setCreatedAt(time());
            $download->setUserId($this->auth->getUserId());
            if (!$download->save()) {
                $this->logger->error('
                    Add data to table download able content false!' .
                    $download->getMessages()[0]->getMessage());
                return  $this->getError('Add data to table download able content false!');
            }
            return $download;
        } catch (Exception $e) {
            return $this->getError('There was an error uploading the file to aws ' . $e->getMessage());
        }
    }

    /**
     * @param $id
     * @param FileInterface $fileInfo
     *
     * @return array|object
     */
    public function uploadImage(FileInterface $file, $id = null)
    {
        if (!$this->mediaType->imageCheck($file->getRealType())) {
            return $this->getError('You need chose format image');
        }
        $fileName = md5(rand()) . '.' . $file->getExtension();
        $fileName = UploadTypeConstant::THUMBNAIL . '/' . $fileName;
        $file->fileName = $fileName;
        return $this->upload($file, $id);
    }
    /**
     * @param $id
     * @param FileInterface $fileInfo
     *
     * @return array|object
     */
    public function uploadAvatar(FileInterface $file)
    {
        if (!$this->mediaType->imageCheck($file->getRealType())) {
            return $this->getError('You need chose format image');
        }
        $auth = container('auth');
        $fileName = md5($auth->getUserId()) . '.' . $file->getExtension();
        $fileName = UploadTypeConstant::USER_AVATAR . '/' . $fileName;
        $file->fileName = $fileName;
        return $this->upload($file);
    }

    /**
     * @param FileInterface $file
     * @param null $id
     *
     * @return array|object
     */
    public function uploadArtwork(FileInterface $file, $id = null)
    {
        if (!$this->mediaType->archiveCheck($file->getRealType())) {
            return $this->getError('You need chose format zip');
        }
        $fileName = md5(rand()) . '.' . $file->getExtension();
        $fileName = UploadTypeConstant::ARTWORK . '/' . $fileName;
        $file->fileName = $fileName;
        return $this->upload($file, $id);
    }

    /**
     * @param $pathToFile
     *
     * @return mixed|null
     */
    public function get($pathToFile)
    {
        try {
            return $this->client->getObject([
                'Bucket' => $this->config->bucket,
                'Key' => $pathToFile
            ])->get('Body');
        } catch (Exception $e) {
            return $this->logger->error($e->getMessage());
        }
    }

    /**
     * @param $pathToFile
     * @return mixed
     */
    public function getContent($pathToFile)
    {
        return $this->get($pathToFile)->getContents();
    }

    /**
     * @param $pathToFile
     *
     * @return string
     */
    public function getObjectUrl($pathToFile)
    {
        try {
            return $this->client->getObjectUrl(
                $this->config->bucket,
                $pathToFile
            );
        } catch (Exception $e) {
            return $this->logger->error($e->getMessage());
        }
    }

    /**
     * @param $pathToFile
     *
     * @return string
     */
    public function createPreSignedRequest($pathToFile)
    {
        //@TODO
    }

    /**
     * @return S3Client
     */
    protected function s3Client()
    {
        $s3Client = new S3Client(
            [
                'version' => 'latest',
                'region'  => $this->config->region,
                'credentials' => [
                    'key' => $this->config->key,
                    'secret' => $this->config->secret
                ]
            ]
        );
        return $s3Client;
    }

    /**
     * @param $id
     * @param FileInterface $fileInfo
     *
     * @return array|object
     */
    public function uploadFeed(FileInterface $file, $id = null)
    {
        if (!$this->mediaType->imageCheck($file->getRealType())) {
            return $this->getError('You need chose format image');
        }
        $fileName = md5(rand()) . '.' . $file->getExtension();
        $fileName = UploadTypeConstant::FEEDS . '/' . $fileName;
        $file->fileName = $fileName;
        return $this->upload($file, $id);
    }
    /**
     * @param $message
     *
     * @return array
     */
    protected function getError($message)
    {
        $this->logger->error($message);
        return ['error' => ['code' => 404 , 'http_code' => 200, 'message' => $message]];
    }
}
