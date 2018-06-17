<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Content;

class CategoryCusController extends Controller
{
	public function show(Request $request, $categoryID)
	{
		$toDayContentsCount = 0;
        $sumToDayContentsCount = 0;
        $categories = Category::with('contents')->get();
        $toDay = strtotime(date("Y-m-d"));
        foreach ($categories as $key => $category) {
            foreach ($category['contents'] as $key => $content) {
                if (strtotime($content->pubDate) >= $toDay) {
                    $toDayContentsCount++;
                }
            }
            if ($category->id == $categoryID) {
                $sumToDayContentsCount = $toDayContentsCount;
            }
            $category->toDayContentsCount = $toDayContentsCount;
            $toDayContentsCount = 0;
        }
		$contents = $categories->find($categoryID)->contentsActive();
		$searchStr = $request->input('searchStr');
		if (!empty($searchStr)) {
            $contents = $contents->where('title', 'like', '%'.$searchStr.'%');
        }
        if (session()->has('perPage')) {
            if (isset($request->perPage)) {
                session()->put('perPage', $request->perPage);
            }
        } else {
            session()->put('perPage', 20);
        }
        $contents = $contents->orderByRaw("CASE WHEN DAYNAME(pubDate) IS NOT NULL THEN pubDate END DESC")->orderBy('id', 'DESC')->paginate(session()->get('perPage'));
        $contents->toDayContentsCount = $sumToDayContentsCount;
        if ($request->ajax()) {
            return view('contents-ajax', compact('contents'));  
        }
		return view('homePage', compact('contents', 'categories', 'searchStr', 'categoryID'));
	}
}