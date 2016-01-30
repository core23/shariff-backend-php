<?php

namespace Heise\Shariff\Backend;

use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Message\Response;

/**
 * Class Pinterest
 *
 * @package Heise\Shariff\Backend
 */
class Pinterest extends Request implements ServiceInterface
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'pinterest';
    }

    /**
     * @param string $url
     * @return \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface|\GuzzleHttp\Psr7\Request
     */
    public function getRequest($url)
    {
        $url = 'http://api.pinterest.com/v1/urls/count.json?callback=x&url='.urlencode($url);
        $request = $this->createRequest($url);

        return $request;
    }

    /**
     * @param string $content
     *
     * @return string
     */
    public function filterResponse($content)
    {
        return mb_substr($content, 2, mb_strlen($content) - 3);
    }

    /**
     * @param array $data
     * @return int
     */
    public function extractCount(array $data)
    {
        return isset($data['count']) ? $data['count'] : 0;
    }
}
