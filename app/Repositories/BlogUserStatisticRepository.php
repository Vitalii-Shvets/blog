<?php

namespace App\Repositories;
use App\Models\BlogUserStatistic as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */


class BlogUserStatisticRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function  getModelClass()
    {
        return Model::class;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function getUserStatistic()
    {
        return DB::table('blog_user_statistics')
            ->select(DB::raw('count(browser) as count_browser, browser'))
            ->groupBy('browser')->orderBy('count_browser', 'desc')
            ->get();
    }


}
