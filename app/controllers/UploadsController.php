<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Controllers;

use Exception;
use Lackky\Models\Services\MediaDataService;

/**
 * Class UploadsController
 *
 * @package Lackky\Controllers
 */
class UploadsController extends ControllerBase
{
    /**
     * @var MediaDataService
     */
    protected $fileService;

    public function onConstruct()
    {
        $this->fileService = new MediaDataService();
    }

    public function indexAction()
    {
    }
    public function createAction()
    {
        if (!$this->auth->getUserId()) {
            return  $this->respondWithError('You have not permission to create an upload file');
        }
        $type = $this->request->get('type');
        try {
            if (!in_array($type, ['image', 'video', 'file'])) {
                return $this->respondWithError('You need choose type upload file');
            }
            if ($this->request->get('item') > 1) {
                $item = $this->uploadFileMultiple();
            } else {
                $item = $this->uploadFile();
            }
            return $this->respondWithArray($item);
        } catch (Exception $e) {
            $this->logger->error('[createAction]' . $e->getMessage());
            return $this->respondWithError('File item not found');
        }
    }
    public function updateAction($id)
    {
        $type = $this->request->get('type');
        try {
            if (!in_array($type, ['image', 'file', 'video'])) {
                return $this->respondWithError('You need choose type upload file');
            }
            if (!$this->fileService->getFirstById($id)) {
                return $this->respondWithError('File have not exits');
            }
            if ($this->request->get('item') > 1) {
                $item = $this->uploadFileMultiple($id);
            } else {
                $item = $this->uploadFile($id);
            }
            return $this->respondWithArray($item);
        } catch (Exception $e) {
            $this->logger->error('[updateAction]' . $e->getMessage());
            return $this->respondWithError('File item not found');
        }
    }

    /**
     * @param null $id
     *
     * @return array
     */
    protected function uploadFile($id = null)
    {
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();
            $type = $this->request->get('type');
            if ($type == 'image') {
                return $this->storage->uploadImage($files[0], $id);
            } elseif ($type == 'video') {
                return $this->storage->uploadVideo($files[0], $id);
            } else {
                return $this->storage->uploadFile($files[0], $id);
            }
        }
        return ['error' => ['code' => 404 , 'message' => 'Upload file not success']];
    }

    /**
     * @param null $id
     *
     * @return array
     */
    protected function uploadFileMultiple($id = null)
    {
        $files = $this->request->getUploadedFiles();
        $type = $this->request->get('type');
        $result = [];
        if ($this->request->hasFiles()) {
            foreach ($files as $file) {
                if ($type == 'image') {
                    $item = $this->storage->uploadImage($file, $id);
                } elseif ($type == 'video') {
                    $item = $this->storage->uploadVideo($file, $id);
                } else {
                    $item = $this->storage->uploadFile($file, $id);
                }
                $result[] = $item;
            }
        }
        return $result;
    }
}
