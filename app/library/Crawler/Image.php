<?php
namespace Lackky\Crawler;

use Phalcon\Mvc\User\Component;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Image
 *
 * @package Lackky\Crawler
 */
class Image extends Component
{
    /**
     * @var string the link website you want to get image
     */
    private $link;

    public function __construct($link)
    {
        $this->link = $link;
    }

    public function getHtml()
    {
        return file_get_contents($this->link);
    }

    /**
     * @return string|null
     */
    public function getThumbnailUrl()
    {
        $crawler = new Crawler($this->getHtml());
        $crawler = $crawler->filterXPath("//meta[@property='og:image']")->extract(array('content'));
        return $crawler[0] ?? null;
    }
    public function extractFromHtml()
    {
        $crawler = new Crawler($this->getHtml());
        $title = trim($crawler->filter('h1')->text());
        $tags = trim($crawler->filter('h3')->text()) ?? null;
        return [
            'name'         => $title,
            'tags'         => $tags,
            'urlSource'    => $this->link
        ];
    }
}
