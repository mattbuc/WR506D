<?php

namespace App\Service;

use Symfony\Component\String\Slugger\AsciiSlugger;

class SentenceSlug
{
    public function slugify($sentence): string
    {
        $slugger = new AsciiSlugger();
        $slug = $slugger->slug($sentence);
        return $slug;
    }
}
