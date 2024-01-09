<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function find($category)
    {
        return Category::find($category);
    }

    public function create(Request $request)
    {
        try{
            $icon = FileUploadService::upload($request->file('icon'), $path = '/public/categories');

            return Category::create([
                'name' => $request->name ?? '',
                'slug' => slugify($request->name ?? '') ?? '',
                'description' => $request->description ?? '',
                'icon' => $icon->uploaded_path.'/'.$icon->uploaded_name ?? '',
            ]);

        }catch (Exception $exception){

            return  $exception;
        }
    }

    public function update($category, Request $request)
    {
        try{
            $category = Category::findOrFail($category);

            ($request->hasFile('icon')) ? FileUploadService::delete('public/'.$category->icon) : Null ;

            $iconURL = $request->hasFile('icon')
                ? (function ($icon) {
                    return $icon->uploaded_path.'/'.$icon->uploaded_name;
                })(FileUploadService::upload($request->file('icon'), '/public/categories'))
                : $category->icon;

            $category->update([
                'name' => $request->name ?? '',
                'slug' => slugify($request->name ?? '') ?? '',
                'description' => $request->description ?? '',
                'icon' => $iconURL,
            ]);
            return $category;

        }catch (Exception $exception){

            return  $exception;
        }
    }

    public function delete($category)
    {
        $category = Category::findOrFail($category);
        FileUploadService::delete('public/'.$category->icon);
        $category->delete();
    }
}
