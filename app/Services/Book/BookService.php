<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Services\BaseService;
use Exception;

class BookService extends BaseService
{
    public function __construct(protected Book $book)
    {
    }

    /**
     * @param array $filters
     * @return mixed
     * @throws Exception
     */
    public function list(array $filters): array
    {
        try {
            $books = tap($this->book::query()
                ->with('category', 'type')
                ->filter($filters)
                ->paginate(10))->transform(fn($book) => [
                'id' => $book->id,
                'name' => $book->name,
                'code' => $book->code,
                'size' => $book->size . ' pages',
                'created_at' => $book->created_at,
                'category' => $book->category->name ?? null,
                'type' => $book->type->description
            ])->toArray();

            if (empty($books)) {
                throw new Exception('Nenhum livro encontrado');
            }

            return (array)$books;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function create(array $data): bool
    {
        try {
            return (bool)$this->book::create($data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getBook(int $id): array
    {
        try {
            $book = $this->book::query()
                ->where('id', $id)
                ->with('category', 'type')
                ->get()->map(fn($book) => [
                    'id' => $book->id,
                    'name' => $book->name,
                    'code' => $book->code,
                    'size' => $book->size . ' pages',
                    'created_at' => $book->created_at,
                    'category' => $book->category->name ?? null,
                    'type' => $book->type->description
                ])->toArray();

            if (!$book) {
                throw new Exception('Livro não encontrado');
            }

            return $book;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
