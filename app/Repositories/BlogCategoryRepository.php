<?php


namespace App\Repositories;
use App\Models\BlogCategory as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */

class BlogCategoryRepository extends CoreRepository
{
    /**
     * Получить категории для вывода пагинатором.
     *
     * @param int|null @perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null) {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions() // Клон модели ****
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

    /**
     * Получить модель для редактирования в админки
     * @param int $id
     * @return string
     */
    public function getEdit($id) {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить список категорий для вывода в выпадающем списке
     * @return Collection
     */
    public function getForComboBox() {

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

//        $result[] = $this->startConditions()->all();
//        $result[] = $this
//            ->startConditions()
//            ->select('blog_categories.*',
//                \DB::raw('CONCAT (id, ". ", title) AS id_title'))
//            ->toBase()
//            ->get();

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;
    }

    /**
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }


}
