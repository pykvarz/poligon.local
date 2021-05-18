<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;


class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        // TODO: Implement getModelClass() method.
        return Model::class;
    }

    /**
     * Получить список статей для вывода в списке (Admin)
     *
     * @return LengthAwarePaginator;
     */
    public function getAllWithPaginate()
    {
        $columns = ['id','title', 'slug', 'is_published', 'published_at',  'user_id', 'category_id'];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with('category', 'user')
            ->paginate(25);

        return $result;
    }
}
