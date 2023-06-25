<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Support\Str;
use Exception;

class CategoryService extends BaseService
{
    public function __construct(protected Category $category)
    {
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return $this->category::create($data);
    }

    public function list()
    {
        return Category::query()
            ->get()->map(fn($category) => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug
            ])->toArray();
    }
}
