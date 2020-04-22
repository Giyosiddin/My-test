<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
/**
 * Class BlogPostRepository.
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getPaginateAll()
    {
        $columns = [
            'id',
            'title',
            'category_id',
            'user_id',
            'published_at',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id','DESC')
            ->with([
                'category' => function($query){
                $query->select(['id', 'title']);
                },
                'user:id,name',
            ])
            ->paginate(25);

        return $result;
    }
}
