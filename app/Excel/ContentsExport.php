<?php

namespace App\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Symfony\Component\DomCrawler\Crawler;
use App\Content;

class ContentsExport implements FromCollection, ShouldAutoSize
{

    public function collection()
    {
    	$contents = Content::orderByRaw("CASE WHEN DAYNAME(pubDate) IS NOT NULL THEN pubDate END DESC")->orderBy('id', 'DESC')->get(['title', 'description','pubDate', 'sourceOfNews'])->toArray();
    	$contentsWithOrder = collect([['THỨ TỰ', 'TIÊU ĐỀ TIN', 'TÓM LƯỢC TIN', 'NGÀY GIỜ', 'NGUỒN LẤY']]);
    	$description = '';
    	foreach ($contents as $key => $content) {
    		array_unshift($content, $key + 1);
		    $content['title'] = html_entity_decode($content['title']);
		    $document = new Crawler();
		    $document->addHtmlContent($content['description']);
		    if ($document->count() > 0)
		    	$description = $document->text();
			$content['description'] = html_entity_decode($description);
			$pubDateTemp = date('H:i:s d/m/Y', strtotime($content['pubDate']));
            if (strtotime($content['pubDate']) <= strtotime('1971-01-01')) {
                $pubDateTemp = $content['pubDate'];
            }
			$content['pubDate'] = $pubDateTemp;
			$contentsWithOrder->push($content);
    	}
        return $contentsWithOrder;
    }
}
