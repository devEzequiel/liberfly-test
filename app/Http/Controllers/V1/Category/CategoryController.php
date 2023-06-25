<?php

namespace App\Http\Controllers\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class  CategoryController extends Controller
{

    public function __construct(protected CategoryService $categoryService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/categories",
     *     operationId="getCategoriesList",
     *     tags={"Categories"},
     *     summary="Get list of categories",
     *     @OA\Response(response="200", description="List of categories"),
     * )
     */
    public function list(): JsonResponse
    {
        try {
            $categories = $this->categoryService->list();
            if (empty($categories)) {
                return $this->responseAccepted('Nenhuma categoria encontrada');
            }

            return $this->responseOk($categories);
        } catch (Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/categories",
     *     operationId="createCategory",
     *     tags={"Categories"},
     *     summary="Create a new category",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *         ),
     *     ),
     *     @OA\Response(response="201", description="Book created successfully"),
     *     @OA\Response(response="422", description="Invalid input"),
     * )
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->categoryService->create($data);

            return $this->responseCreated('Categoria criada');
        } catch (Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }
}
