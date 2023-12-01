<?php

namespace App\Repositories;

use App\Models\Link;

class LinkRepository
{
    public static function getTotalLinksByPageId(int $pageID): int
    {
        $totalLinks = Link::where('id_page', $pageID)->count();

        return $totalLinks;
    }

    public static function getLinkByPageIdAndLinkId(int $pageID, int $linkID): object
    {
        $link = Link::where('id_page', $pageID)
            ->where('id', $linkID)
            ->first();

        return $link;
    }

    public static function getAllLinksOrderByOrder(int $pageID): object
    {
        $links = Link::where('id_page', $pageID)
            ->orderBy('order', 'ASC')
            ->get();

        return $links;
    }

    public static function getAllLinksWithStatus1(int $pageID): object
    {
        $links = Link::where('id_page', $pageID)
            ->where('status', 1)
            ->orderBy('order')
            ->get();

        return $links;
    }

    public static function getAfterLinks(int $pageID, int $position): object
    {
        $afterLinks = Link::where('id_page', $pageID)
            ->where('order', '>=', $position)
            ->get();

        return $afterLinks;
    }

    public static function getBeforeLinks(int $pageID, int $position): object
    {
        $beforeLinks = Link::where('id_page', $pageID)
            ->where('order', '<=', $position)
            ->get();

        return $beforeLinks;
    }

    public static function findById(int $linkID): object
    {
        $link = Link::find($linkID);;

        return $link;
    }
}
