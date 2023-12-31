<?php

namespace App\Http\Controllers\V1\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\FilterBookRequest;
use App\Services\Book\BookService;
use Illuminate\Http\JsonResponse;
use Exception;

class BookController extends Controller
{
    public function __construct(protected BookService $bookService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/books",
     *     operationId="getBookssList",
     *     tags={"Books"},
     *     summary="Get list of books",
     *     @OA\Response(response="200", description="List of books"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function all(FilterBookRequest $request): JsonResponse
    {
        try {
            $filters = $request->validated();
            $books = $this->bookService->list($filters);

            return $this->responseOk($books);
        } catch (Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/books",
     *     operationId="createBook",
     *     tags={"Books"},
     *     summary="Create a new book",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="category_id", type="number"),
     *             @OA\Property(property="type_id", type="number"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="author", type="string"),
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="size", type="number"),
     *         ),
     *     ),
     *     @OA\Response(response="201", description="Book created successfully"),
     *     @OA\Response(response="422", description="Invalid input"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function store(CreateBookRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->bookService->create($data);

            return $this->responseCreated('Brook created successfully');
        } catch (Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/books/{id}",
     *     operationId="getBookById",
     *     tags={"Books"},
     *     summary="Get book by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", format="int64"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="size", type="string"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="category", type="string"),
     *             @OA\Property(property="type", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Book not found",
     *     ),
     *      security={{"bearerAuth": {}}}
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $book = $this->bookService->getBook($id);

            return $this->responseOk($book);
        } catch (Exception $e) {
            return $this->responseNotFound($e->getMessage());
        }
    }
}
