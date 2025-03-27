<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index(Request $request) {
        $pageTitle = 'All Categories';
        $categories = Category::latest()->searchable(['name'])->paginate(getPaginate());
        return view('admin.category.index', compact('pageTitle', 'categories'));
    }

    public function store(Request $request, $id = 0) {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        if ($id) {
            $category = Category::findOrFail($id);
            $message = 'Category updated successfully';
        } else {
            $category = new Category();
            $message = 'Category added successfully';
        }

        $category->name = $request->name;
        $category->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return Category::changeStatus($id);
    }

    public function delete($id) {
     $category = Category::whereId($id)->firstOrFail();
     $category->delete();
     $notify[] = ['success', 'Category Deleted Successfuly'];
     return back()->withNotify($notify);
    }
}
