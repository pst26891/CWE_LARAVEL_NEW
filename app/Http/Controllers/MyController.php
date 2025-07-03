<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class MyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function adminView($view, $data = [], $paginate = false, $perpage = null)
    {
        // Ensure $data is an associative array
        if (!is_array($data)) {
            $data = [];
        }

        // Start with the master layout
        $views = [view('admin.elements.master')];

        // Check if pagination is enabled
        if ($paginate && $perpage) {
            $data['i'] = (request()->input('page', 1) - 1) * $perpage;
        }

        // Load the main content view
        $views[] = view($view, $data);

        // Load the footer
        $views[] = view('admin.elements.inc_footer');

        // Return all views together
        return implode('', array_map(fn($v) => $v->render(), $views));
    }

    
    function frontView($view, $data = [], $paginate = false, $perpage = null)
    {
        // Ensure $data is an associative array
        if (!is_array($data)) {
            $data = [];
        }

        // Start with header and navbar
        $views = [
            view('elements.header'),
            view('elements.navbar')
        ];

        // Check if pagination is enabled
        if ($paginate && $perpage) {
            $data['i'] = (request()->input('page', 1) - 1) * $perpage;
        }

        // Load the main content view
        $views[] = view($view, $data);

        // Load the footer
        $views[] = view('elements.footer');

        // Return all views together
        return implode('', array_map(fn($v) => $v->render(), $views));
    }
}
