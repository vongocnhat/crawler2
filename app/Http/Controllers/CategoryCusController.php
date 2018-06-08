<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryCusController extends Controller
{
	public function show(Request $request, $categoryID)
	{
		$categories = Category::all();
		$contents = Category::findOrFail($categoryID)->contents()->where('active', 1)->orderBy('pubDate', 'DESC');
		$toDayNewsCount = 0;
		$searchStr = $request->input('searchStr');
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
		return view('home', compact('contents', 'categories', 'searchStr', 'toDayNewsCount', 'categoryID'));
	}
}