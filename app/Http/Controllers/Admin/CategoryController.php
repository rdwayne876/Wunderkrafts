<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Image;
use Session;

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

            $category = new Category;
        } else {
            $title = "Edit Category";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            //Category Validations
            $rules = [
                'category_name'  => 'required|regex:/^[\pL\s\-]+$/u',
                'category_image' => 'mimes:jpeg,jpg,png,gif'
            ];

            $customMessages = [
                'category_name.regex'   => 'Valid Category Name is required',
                'category_image.mimes'  => 'Valid image is required'
            ];

            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('category_image')) {
                $tempImage = $request->file('category_image');
                if ($tempImage->isValid()) {
                    //get extension
                    $extension = $tempImage->getClientOriginalExtension();

                    //generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'img/category/'.$imageName;

                    //upload the image
                    Image::make($tempImage)->save($imagePath);

                    //save Category Image
                    $category->category_image = $imageName;
                }
            }

            if(empty($data['category_discount'])) {
                $data['category_discount'] = "";
            }
            if(empty($data['description'])) {
                $data['description'] = "";
            }
            if(empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }
            
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = $data['status'];
            $category->save();

            Session::flash('success','Category added succesfully');
            return redirect('admin/categories');
        }

        //Get Sections
        $getSections = Section::get();

        return view('admin.categories.addEditCategory')
            ->with(compact('title', 'getSections'));
    }
}
