<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function all();
    public function find($category);
    public function create(Request $request);
    public function update($category, Request $request);
    public function delete($category);
}
