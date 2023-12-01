<?php

namespace App\Repositories;

use App\Models\View;

class ViewRepository
{
    public static function getTotalViewsOfPage(int $pageID): int
    {
        $totalViews = View::where('id_page', $pageID)->sum('total');

        return $totalViews;
    }

    public static function getTotalViewsOfPageInTheLast48Hours(string $dateLimit, int $pageID): int
    {
        $totalViews = View::where('view_date', '>', $dateLimit)
            ->where('id_page', $pageID)
            ->sum('total');

        return $totalViews;
    }

    public static function firstOrNew(int $pageID): object
    {
        $view = View::firstOrNew([
            'id_page' => $pageID,
            'view_date' => date('Y-m-d')
        ]);

        return $view;
    }
}
