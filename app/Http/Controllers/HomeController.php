<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\KeyWord;
use App\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $refreshTime = 15;
        $refreshTime *= 1000;
        $toDayNewsCount = 0;
        $searchStr = $request->input('searchStr');
        // dd ($request);
        $contents = Content::where('active', 1)->orderBy('pubDate', 'DESC');
        $categories = Category::with('keyWords')->get();
        if ($searchStr == '')
            foreach ($contents->get() as $item) {
                $pubDate = date("Y-m-d", strtotime($item->pubDate));
                $toDate = date("Y-m-d");
                if($pubDate == $toDate)
                    $toDayNewsCount++;
            }
        else
            $contents = $contents->where('title', 'like', '%'.$searchStr.'%');
        $contents = $contents->paginate(5);
        return view('home', compact('contents', 'toDayNewsCount', 'refreshTime', 'searchStr', 'categories'));
    }

    //get detail news
    public function getNews(Request $request) {
    	$link = $request->input('href');
    	$content = Content::where('link', $link)->get();
    	foreach ($content as $key => $value) {
            echo html_entity_decode('<iframe name="iframe1" scrolling="auto" id="iframe1" src="'.$value->link.'" width="100%" style="overflow: hidden; height: -webkit-fill-available" frameborder="0" allowfullscreen>');

            // $client = new \GuzzleHttp\Client();
            // $res = $client->request('GET', $value->link);
            // echo $res->getBody();
    	}
    }

    public function changeLink($id) {
        $content = Content::findOrFail($id);
        $html = file_get_contents($content->link);
        echo $html;
    }

    private function matchChar($string, $keyWord) {
        $string = ' '.$string.' ';
        $string = $this->removeSymbol($string);
        $keyWord = $this->removeSymbol($keyWord);
        $index = stripos($string, $keyWord);
        if($index == true && gettype($index) == 'integer')
        {
            $indexBefore = $index-1;
            $indexAfter = $index+strlen($keyWord);
            $charBefore = substr($string, $indexBefore, 1);
            $charAfter = substr($string, $indexAfter, 1);
            // '*How area you?*' contain 'how are' = false
            // '*How are" you?*' contain 'how are' = true
            if(!(ctype_alpha($charBefore) || ctype_alpha($charAfter)))
                return true;
        }
        return false;
    }
    private function removeSymbol($string) {
        $charStrings = str_split($string);
        $string = '';
        $asc = -1;
        foreach ($charStrings as $value) {
            $asc = ord($value);
            if(!(($asc >= 33 && $asc <= 47) || ($asc >= 58 && $asc <= 64) || ($asc >= 91 && $asc <= 96) || ($asc >= 123 && $asc <= 126)))
                $string .= $value;
        }
        // thay nhiều dấu space thành 1 dấu
        $string = preg_replace('!\s+!', ' ', $string);
        return $string;
    }
}