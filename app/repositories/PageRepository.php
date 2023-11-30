<?php

namespace App\repositories;

use App\Models\Page;

class PageRepository
{

    public static function getAllPagesOrderByUpdatedAt(int $userID): object
    {
        $pages = Page::where('id_user', $userID)
            ->orderby('updated_at', 'DESC')
            ->get();

        return $pages;
    }

    public static function getAllPagesOrderById(int $userID): object
    {
        $pages = Page::where('id_user', $userID)
            ->orderby('id', 'DESC')
            ->get();

        return $pages;
    }

    public static function getPageBySlugAndUser(string $slug, int $userID): object
    {
        $pages = Page::where('slug', $slug)
            ->where('id_user', $userID)
            ->first();

        return $pages;
    }

    public static function getPageBySlug(string $slug): object | null
    {
        $pages = Page::where('slug', $slug)->first();

        return $pages;
    }

    public static function getPageBySlugByIdByUser(string $slug, int $pageID, int $userID): object | null
    {
        $page = Page::where('slug', $slug)
            ->where('id', $pageID)
            ->where('id_user', $userID)
            ->first();

        return $page;
    }

    public static function getAllPagesByUser(int $userID): object
    {
        $pages = Page::where('id_user', $userID)->get();

        return $pages;
    }

}
