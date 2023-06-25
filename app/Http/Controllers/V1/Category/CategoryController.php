<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class  CategoryController extends Controller
{

    public function __construct(protected CategoryService $categoryService)
    {
    }

    /**
     * Display a listing of the categories.
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        try {
            $categories = $this->categoryService->list();

            if (empty($categories)) {
                return $this->responseAccepted('Nenhuma categoria encontrada');
            }

            return $this->responseOk($categories);
        } catch (\Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }

    /**
     * Store a newly created category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $this->categoryService->create($data);

            return $this->responseCreated('Categoria criada');
        } catch (\Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }
}
