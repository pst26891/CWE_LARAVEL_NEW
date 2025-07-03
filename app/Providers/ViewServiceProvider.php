<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Models\Admin\Menu;
use App\Models\Admin\MenuItem;
use App\Models\Admin\Article;
use App\Models\Admin\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            // Top Navigation
            $topNavFront = Menu::where('title', 'Header')->first();
            $topNavFrontItems = $this->decodeMenuContent($topNavFront);

            $this->enrichMenuTree($topNavFrontItems);

            // Footer Navigation
            $fooNav = Menu::where('title', 'Footer_new')->first();
            $fooNavItems = $this->decodeMenuContent($fooNav);
            $this->enrichMenuTree($fooNavItems);

            // Meta Data
            // $routeArray = app('request')->route()->getAction();
            // $controllerAction = class_basename($routeArray['controller']);
            // list($controller, $action) = explode('@', $controllerAction);
            
$route = app('request')->route();
$meta = null; // Default

if ($route && $route->getActionName()) {
    $actionName = $route->getActionName();

    if (strpos($actionName, '@') !== false) {
        list($controller, $action) = explode('@', class_basename($actionName));

        if ($controller === 'HomeController' && $action === 'showPage') {
            $meta = DB::table('pages')->where('url', request()->segment(1))->first();
        } elseif ($controller === 'HomeController' && $action === 'showChiled') {
            $meta = DB::table('pages')->where('url', request()->segment(3))->first();
        } elseif ($controller === 'HomeController' && $action === 'index') {
            $meta = DB::table('pages')->where('url', 'home')->first();
        } elseif ($controller === 'ArticleController' && $action === 'viewArticle') {
            $meta = Article::with('author', 'volume', 'issue')
                        ->where('url', request()->segment(2))->first();
        } else {
            $meta = DB::table('pages')->where('url', 'home')->first();
        }
    }
}

if (!$meta) {
    // Fallback to home if no metadata found
    $meta = DB::table('pages')->where('url', 'home')->first();
}
            $settings = Setting::first();

            // Share with views
            $view->with('topNavFrontItems', $topNavFrontItems)
                 ->with('fooNavItems', $fooNavItems)
                 ->with('meta', $meta)
                 ->with('setting', $settings);
        });
    }

    /**
     * Decode the stored JSON content into an array of stdClass menu item objects.
     * Returns an empty array if content is missing or invalid.
     */
protected function decodeMenuContent($menu)
{
    if (empty($menu) || empty($menu->content)) {
        return [];
    }

    $data = is_string($menu->content)
        ? json_decode($menu->content)
        : $menu->content;

    // Case: content is a single object
    if (is_object($data)) {
        return [$data];
    }

    // Case: content is a wrapped array (e.g., [[{...}, {...}]])
    if (is_array($data)) {
        // Case: outer array has a nested array as its first element
        if (isset($data[0]) && is_array($data[0])) {
            return $data[0]; // ✅ Return the full inner array (not just one item)
        }

        // Case: already a flat array of menu items
        return $data;
    }

    return [];
}


    /**
     * Recursively enrich a tree of stdClass menu item objects with model data.
     * Expects an array of stdClass objects.
     */
    protected function enrichMenuTree(array &$itemsFront)
    {
        foreach ($itemsFront as &$itemFront) {
            if (!is_object($itemFront) || !isset($itemFront->id)) {
                // Ensure slug, target, and title exist to avoid undefined property errors elsewhere
                if (is_object($itemFront)) {
                    if (!isset($itemFront->slug)) {
                        $itemFront->slug = '';
                    }
                    if (!isset($itemFront->target)) {
                        $itemFront->target = '';
                    }
                    if (!isset($itemFront->title)) {
                        $itemFront->title = '';
                    }
                }
                continue;
            }

            // Enrich current node
            $model = MenuItem::find($itemFront->id);
            if ($model) {
                $itemFront->title  = $model->title;
                $itemFront->name   = $model->name;
                $itemFront->slug   = $model->slug;
                $itemFront->target = $model->target;
                $itemFront->type   = $model->type;
            } else {
                // Set default values if model not found
                $itemFront->slug = $itemFront->slug ?? '';
                $itemFront->target = $itemFront->target ?? '';
                $itemFront->title = $itemFront->title ?? '';
            }

            // Normalize children property
            $children = [];
            if (isset($itemFront->children) && is_array($itemFront->children)) {
                $raw = $itemFront->children[0] ?? $itemFront->children;
                if (is_array($raw)) {
                    $children = $raw;
                }
            }

            $itemFront->children = [];
            if (!empty($children)) {
                $this->enrichMenuTree($children);
                $itemFront->children = $children;
            }
        }
    }

    public function register()
    {
        //
    }
}
