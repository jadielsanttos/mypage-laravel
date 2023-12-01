<?php

namespace App\Repositories;

use App\Models\CLick;

class ClickRepository
{
    public static function getTotalClicksOfPage(int $pageID): int
    {
        $totalClicks = Click::where('id_page', $pageID)->sum('total');

        return $totalClicks;
    }

    public static function firstOrNew(int $linkID, int $pageID): object
    {
        $click = Click::firstOrNew([
            'id_link' => $linkID,
            'id_page' => $pageID,
            'click_date' => date('Y-m-d')
        ]);

        return $click;
    }
}
