<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Exception;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Retrieve a listing of the categories.
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection($this->categoryRepository->all())
            ->additional([
                'success' => true,
                'message' => 'All categories retrieved',
            ]);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CreateRequest $request): CategoryResource
    {
        $category = $this->categoryRepository->create($request);

        return CategoryResource::make($category->refresh())
            ->additional([
                'success' => true,
                'message' => 'Category created successfully',
            ]);
    }

    /**
     * Display the specified category.
     */
    public function show($category): CategoryResource
    {
        if (!$this->categoryRepository->find($category)) {
            return CategoryResource::make(null)
                ->additional(['success' => false, 'message' => 'Category not found']);
        }

        return CategoryResource::make($this->categoryRepository->find($category))
            ->additional([
                'success' => true,
                'message' => 'Category retrieved successfully',
            ]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(UpdateRequest $request, $category): CategoryResource
    {
        if (!$this->categoryRepository->find($category)) {
            return CategoryResource::make(null)
                ->additional(['success' => false, 'message' => 'Category not found']);
        }

        $category = $this->categoryRepository->update($category, $request);
        return CategoryResource::make($category->refresh())
            ->additional([
                'success' => true,
                'message' => 'Category updated successfully',
            ]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @throws Exception
     */
    public function destroy($category): JsonResponse
    {
        if (!$this->categoryRepository->find($category)) {
            return response()->json(null, 404);
        }

        $this->categoryRepository->delete($category);
        return response()->json(null, 204);
    }
}
