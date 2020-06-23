<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;

class CategoryController extends Controller
{
    public function categories() {
        $categories = Category::get();

        return view('admin.categories.categories')
            ->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request) {
        if($request->ajax()) {
            $data = request()->all();

            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])
                ->update(['status'=>$status]);

            return response()->json(
                ['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null) {
        if($id=="") {
            $title = "Add Category";
        } else {
            $title = "Edit Category";
        }

        //Get Sections
        $getSections = Section::get();

        return view('admin.categories.addEditCategory')
            ->with(compact('title', 'getSections'));
    }
}
