<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use DOMDocument;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Promise;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use App\Content;
use App\RSS;
use App\Category;
ini_set('max_execution_time', 86400);

class RSSController extends Controller
{

    private $LoadLimit = 1;

    private $hasError = false;

    private $linkSuccesses = [];

    private $linkErrors = [];

    private $listLinkInserted = [];
    
    public function index()
    {
        $RSSs = RSS::all();
        $links = [];
        $categories = Category::with('keywords')->get();
        // get table contents
        $contents = Content::all();
        // get table contents
        $client = new GuzzleClient();
        $requests = function () use ($RSSs) {
            foreach ($RSSs as $key => $RSS) {
                yield new GuzzleRequest('GET', $RSS->link);
            }
        };
        $pool = new Pool($client, $requests(), [
            'concurrency' => $this->LoadLimit,
            'fulfilled' => function ($response, $index) use ($RSSs, $contents, $categories) {
                $rssPage = new Crawler();
                $rssPage->addHtmlContent((string) $response->getBody());
                $hrefs = $rssPage->filter('a');
                $hrefInserted = [];
                for ($i = 0; $i < $hrefs->count(); $i ++) {
                    $checkIgnore = false;
                    // //24h.com.vn/upload/rss/tintuctrongngay.rss
                    $href = str_replace(' ', '', $hrefs->eq($i)->attr('href'));
                    $fullHref = $href;
                    if (isset($RSSs->get($index)->website)) {
                        $fullHref = $RSSs->get($index)->website . $href;
                    }
                    // kiểm tra không trùng href
                    if (!in_array($fullHref, $hrefInserted)) {
                        $isRSS = substr($href, strlen($href) - 4, 4);
                        if ($isRSS == '.rss') {
                            // ignore rss after splice
                            $ignoreRSSs = explode(';', $RSSs->get($index)->ignoreRSS);
                            foreach ($ignoreRSSs as $key => $ignoreRSS) {
                                // bỏ tất cả đấu space
                                $ignoreRSS = trim($ignoreRSS);
                                if ($ignoreRSS == trim($href) || $ignoreRSS == trim($fullHref)) {
                                    $checkIgnore = true;
                                    break;
                                }
                            }
                            if ($checkIgnore == false) {
                                // thêm href đã dùng vào mảng
                                array_push($hrefInserted, $fullHref);
                                //$baseRSSlink = https://www.24h.com.vn/guest/RSS/;
                                $baseRSSlink = $RSSs->get($index)->link;
                                $this->getNewsRSS($fullHref, $contents, $categories, $baseRSSlink);
                            }
                        }
                    }
                }
            },
            'rejected' => function ($reason, $index) {
                // this is delivered each failed request
                $this->hasError = true;
                // array_push($this->linkErrors, $);
            }
        ]);
        // Initiate the transfers and create a promise
        $promise = $pool->promise();
        // Force the pool of requests to complete.
        $promise->wait();
        // 60s tải 1 lần
        $refreshTime = 600000;
        echo '<span style="color: green">Tải Tin Thành Công Tải Lại Sau: ' . ($refreshTime / 1000) . ' Giây</span>';
        $linkSuccesses = $this->linkSuccesses;
        $linkErrors = $this->linkErrors;
        return view('admin.rss', compact('refreshTime', 'linkSuccesses', 'linkErrors'));
    }

    private function getNewsRSS($href, $contents, $categories, $baseRSSlink)
    {
        $client = new GuzzleClient();
        $requests = function () use ($href) {
            yield new GuzzleRequest('GET', $href);
        };
        $pool = new Pool($client, $requests(), [
            'concurrency' => $this->LoadLimit,
            'fulfilled' => function ($response, $index) use ($href, $contents, $categories, $baseRSSlink) {
                $str = str_replace('<link>', '<linkHref>', $response->getBody());
                $str = str_replace('</link>', '</linkHref>', $str);
                $str = str_replace('<![CDATA[', '', $str);
                $str = str_replace(']]>', '', $str);
                $tempDocument = new Crawler();
                $tempDocument->addHtmlContent($str);
                if ($tempDocument->count() > 0) {
                    $RSSContent = $tempDocument->html();
                    $this->saveRSSToDB($RSSContent, $contents, $categories, $href, $baseRSSlink);
                    array_push($this->linkSuccesses, $href);
                } else {
                    $this->hasError = true;
                    array_push($this->linkErrors, $href);
                }
            },
            'rejected' => function ($reason, $index) use ($href) {
                // this is delivered each failed request
                $this->hasError = true;
                array_push($this->linkErrors, $href);
            }
        ]);
        // Initiate the transfers and create a promise
        $promise = $pool->promise();
        // Force the pool of requests to complete.
        $promise->wait();
    }

    private function saveRSSToDB($RSSContent, $contents, $categories, $href, $baseRSSlink)
    {
        // table contents
        $title;
        $link;
        $description;
        $pubDate;
        $document = new Crawler();
        $document->addHtmlContent($RSSContent);
        $items = $document->filter('item');
        for ($i = 0; $i < $items->count(); $i ++) {
            $title = '';
            $link = '';
            $description = '';
            $pubDate = '';
            $item = $items->eq($i);
            $title = $item->filter('title');
            $link = $item->filter('linkHref');
            if ($title->count() > 0) {
                $title = $title->text();
            } else
                $title = '';
            if ($link->count() > 0) {
                $link = $link->text();
            } else if ($link->count() == 0 && $item->filter('guid')->count() > 0)
                $link = $item->filter('guid')->text();
            $description = $item->filter('description');
            if ($description->count() > 0)
                $description = $description->html();
            else
                $description = '';
            $pubDate = $item->filter('pubDate');
            if ($pubDate->count() > 0) {
                $pubDate = $pubDate->html();
            } else
                $pubDate = '';
            // add rss to database kiểm tra tin này đã có trong db chưa
            $available = false;
            foreach ($contents as $key => $item) {
                if ($link == $item->link) {
                    $available = true;
                    break;
                }
            }
            // chỉ lấy tin trong ngày, loại bỏ tin sai ngày
            $tempPubDate = date('Y-m-d', strtotime($pubDate));
            $dateNow = date('Y-m-d');
            if ($available == false && $tempPubDate == $dateNow && $tempPubDate != '1970-01-01') {
                foreach ($categories as $key => $category) {
                    $matchChar = false;
                    foreach ($category->keyWords as $keyWord) {
                        if ($keyWord->active)
                            if ($this->matchChar($title, $keyWord->name)) {
                                // break keyWords;
                                $matchChar = true;
                                break;
                            }
                    }
                    $inserted = in_array($link, $this->listLinkInserted);
                    if ($matchChar == true && $inserted == false) {
                        $content = new Content();
                        $content->category_id = $category->id;
                        //href rss
                        $content->sourceOfNews = $baseRSSlink;
                        $content->title = $title;
                        $content->link = $link;
                        // html_entity_decode to show "" '' / () or {!!!!}
                        $content->description = str_replace('#34;', '', $description);
                        // convert datetime
                        $pubDateTemp = date('Y-m-d H:i:s', strtotime($pubDate));
                        if (strtotime($pubDate) <= strtotime('1971-01-01')) {
                            $pubDateTemp = $pubDate;
                        }
                        // */convert datetime
                        $content->pubDate = $pubDateTemp;
                        $content->save();
                        array_push($this->listLinkInserted, $link);
                    }
                }
            }
        }
    }

    private function getContentBody($link)
    {}

    private function outerHTML($e)
    {
        $doc = new \DOMDocument();
        $doc->appendChild($doc->importNode($e, true));
        return $doc->saveHTML();
    }

    private function matchChar($string, $keyWord)
    {
        $string = ' ' . $string . ' ';
        $string = $this->removeSymbol($string);
        $keyWord = $this->removeSymbol($keyWord);
        $index = stripos($string, $keyWord);
        if ($index == true && gettype($index) == 'integer') {
            $indexBefore = $index - 1;
            $indexAfter = $index + strlen($keyWord);
            $charBefore = substr($string, $indexBefore, 1);
            $charAfter = substr($string, $indexAfter, 1);
            // '*How area you?*' contain 'how are' = false
            // '*How are" you?*' contain 'how are' = true
            if (! (ctype_alpha($charBefore) || ctype_alpha($charAfter)))
                return true;
        }
        return false;
    }

    private function removeSymbol($string)
    {
        $charStrings = str_split($string);
        $string = '';
        $asc = - 1;
        foreach ($charStrings as $value) {
            $asc = ord($value);
            if (! (($asc >= 33 && $asc <= 47) || ($asc >= 58 && $asc <= 64) || ($asc >= 91 && $asc <= 96) || ($asc >= 123 && $asc <= 126)))
                $string .= $value;
        }
        // thay thế nhiều dấu space thành 1 dấu
        $string = preg_replace('!\s+!', ' ', $string);
        return $string;
    }
}