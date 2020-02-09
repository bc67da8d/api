<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Models\Services;

use Lackky\Models\Services\Exceptions\EntityNotFoundException;
use Lackky\Models\MediaData;

class MediaDataService extends Service
{

    /**
     * @param $id
     *
     * @return MediaData|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstById($id)
    {
        $item = MediaData::query()
            ->where('id = :id:', ['id' => $id])
            ->limit(1)
            ->execute();
        return $item->getFirst() ?:  null;
    }

    /**
     * @param $id
     *
     * @return MediaData|\Phalcon\Mvc\ModelInterface|null
     * @throws EntityNotFoundException
     */
    public function getFirstById($id)
    {
        if (!$item = $this->findFirstById($id)) {
            throw new EntityNotFoundException($id);
        }
        return $item;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function getMetadata($id)
    {
        try {
            $item = $this->getFirstById($id)->toArray();
            $item['cdn'] = env('CDN') . '/' . $item['key'];
            return $item;
        } catch (EntityNotFoundException $e) {
            container('logger')->error('[getMetadata]' . $e->getMessage());
        }
    }
}
