<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Models\PagesModel;
use App\Models\TagsModel;

class SitemapGenerate extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/search'));

        PagesModel::select('slug')->get()->each(function (PagesModel $pages) use ($sitemap) {
            $sitemap->add(Url::create("/page/{$pages->slug}"));
        });

        TagsModel::select('name')->each(function (TagsModel $tags) use ($sitemap) {
            $sitemap->add(Url::create("/tags/{$tags->name}"));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
