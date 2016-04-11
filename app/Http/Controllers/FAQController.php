<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use App\Http\Requests;
use App\FAQCategory;
use App\FAQItem;

class FAQController extends Controller
{
    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
    	$categories = FAQCategory::All();
        return view('faq/faq')->with('categories', $categories);
    }

    public function create($id = null)
    {
    	return $this->createView(null, $id);
    }

    public function make(Request $request)
    {
    	$validator = Validator::make($request->all(), [
        	'question' => 'required|max:255',
        	'anwser' => 'required|max:255',
        	'category' => 'required',
    	]);
    	if ($validator->fails()) {
            return redirect()
            			->route('faq::create')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$item = new FAQItem();
    	$item->user()->associate(Auth::user());
    	$category = FAQCategory::find($request->input('category'));
    	$item->category()->associate($category);
    	$item->question = $request->input('question');
    	$item->anwser = $request->input('anwser');
    	$item->save();

    	return redirect()->route('faq::index')->with('status', 'FAQ added!');
    }

    public function edit($id)
    {
    	$item = FAQItem::find($id);
    	return $this->createView($item, null);
    }

    public function postEdit(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
        	'question' => 'required|max:255',
        	'anwser' => 'required|max:255',
        	'category' => 'required',
    	]);
    	if ($validator->fails()) {
            return redirect()
            			->route('faq::create')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$item = FAQItem::findOrFail($id);
    	$item->user()->associate(Auth::user());
    	$category = FAQCategory::find($request->input('category'));
    	$item->category()->associate($category);
    	$item->question = $request->input('question');
    	$item->anwser = $request->input('anwser');
    	$item->save();

    	return redirect()->route('faq::index')->with('status', 'FAQ updated!');
    }

    public function createCategory()
    {
        return view('faq/createCategory');
    }

    public function makeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('faq::category::create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $item = new FAQCategory();
        $item->title = $request->input('title');
        $item->save();

        return redirect()->route('faq::index')->with('status', 'Category added!');
    }

    public function editCategory($id)
    {
        $item = FAQCategory::find($id);
        return view('faq/createCategory')->with('category', $item);
    }

    public function postEditCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('faq::category::edit', ["id" => $id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $item = FAQCategory::findOrFail($id);
        $item->title = $request->input('title');
        $item->save();

        return redirect()->route('faq::index')->with('status', 'Category updated!');
    }

    private function createView($old = null, $category = null)
    {
    	$categories = FAQCategory::All();

    	$data = [];
    	if(isset($old)){
    		$data['id'] = $old->id;
    		$data['question'] = $old->question;
    		$data['anwser'] = $old->anwser;
    		$data['categoryID'] = $old->category->id;
    		$data['update'] = true;
	    	return view('faq/create', ['id'=>$old->id])->with('data', $data)->with('categories', $categories);
    	} else {
	    	$data['categoryID'] = $category;
	    	$data['update'] = false;
	    	return view('faq/create')->with('data', $data)->with('categories', $categories);
	    }
    }
}
