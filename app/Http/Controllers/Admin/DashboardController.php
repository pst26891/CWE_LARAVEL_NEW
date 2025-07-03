<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use App\Models\Admin\Article;
use App\Models\Admin\Author;
use App\Models\Admin\Widget;
use App\Models\Admin\Issue;
use App\Models\Admin\Volume;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends MyController
{
    public function index()
    {
        $articleCount = Article::count();
        $authorCount = Author::count();
        $widgetCount = Widget::count();
        $issueCount = Issue::count();
        $volumeCount = Volume::count();
        $totalDownloads = DB::table('downloads')->sum('download');
        $totalViews = DB::table('views')->sum('view');

        // Example: Articles per month (for chart)
        $articlesByMonth = Article::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $downloadsData =  $this->showDownloadChart();
        $viewsData =  $this->showViewCharts();
        $locationWiseData = $this->locationWiseDownloadView();

        return $this->adminView('admin.dashboard.dashboard', $data = [
            'articleCount' => $articleCount,
            'authorCount' => $authorCount,
            'widgetCount' => $widgetCount,
            'issueCount' => $issueCount,
            'volumeCount' => $volumeCount,
            'articlesByMonth' => $articlesByMonth,
            'labels' => $downloadsData['labels'],
            'downloadData' => $downloadsData['downloadData'],
            'vlabels' => $viewsData['labels'],
            'viewsData' => $viewsData['viewData'],
            'totalDownloads' => $totalDownloads,
            'totalViews' => $totalViews,
            'locationLabelsDownload' => $locationWiseData['locationLabelsDownload'],
            'locationLabelsView' => $locationWiseData['locationLabelsView'],
            'locationDownloadData' => $locationWiseData['locationDownloadData'],
            'locationViewData' => $locationWiseData['locationViewData'],
        ]);
    }
   
    protected function showDownloadChart()
    {
        // Get last 7 days of downloads
        $downloads = DB::table('downloads')
            ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(download) as total_downloads'))
            ->whereBetween('date', [Carbon::now()->subDays(6)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Prepare data for the chart
        $labels = [];
        $downloadData = [];

        $dates = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i);
        });

        foreach ($dates as $date) {
            $label = $date->format('M d');
            $labels[] = $label;

            $dayDownload = $downloads->firstWhere('date', $date->format('Y-m-d'));
            $downloadData[] = $dayDownload ? (int) $dayDownload->total_downloads : 0;
        }

        return  $downloadData = [
            'labels' => $labels,
            'downloadData' => $downloadData,
        ];
    }

    public function showViewCharts()
    {
        $startDate = Carbon::now()->subDays(6)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');

        // Views data

        $views = DB::table('views')
            ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(view) as total_views'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Prepare labels and data
        $labels = [];
        $viewData = [];

        $dates = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i);
        });

        foreach ($dates as $date) {
            $formattedDate = $date->format('Y-m-d');
            $labels[] = $date->format('M d');
            $dayView = $views->firstWhere('date', $formattedDate);
            $viewData[] = $dayView ? (int) $dayView->total_views : 0;
        }


        return  $viewData = [
            'labels' => $labels,
            'viewData' => $viewData,
        ];
    }

    protected function locationWiseDownloadView()
    {

        // Top 10 locations by downloads
        $topDownloadLocations = DB::table('downloads')
            ->select('location', DB::raw('SUM(download) as total_downloads'))
            ->groupBy('location')
            ->orderByDesc('total_downloads')
            ->limit(10)
            ->get();

        // Top 10 locations by views
        $topViewLocations = DB::table('views')
            ->select('location', DB::raw('SUM(view) as total_views'))
            ->groupBy('location')
            ->orderByDesc('total_views')
            ->limit(10)
            ->get();

        // Prepare data for chart
        $downloadLabels = $topDownloadLocations->pluck('location')->map(fn($loc) => $loc ?: 'Unknown');
        $downloadData = $topDownloadLocations->pluck('total_downloads')->map(fn($val) => (int)$val);

        $viewLabels = $topViewLocations->pluck('location')->map(fn($loc) => $loc ?: 'Unknown');
        $viewData = $topViewLocations->pluck('total_views')->map(fn($val) => (int)$val);
        return [
            'locationLabelsDownload' => $downloadLabels,
            'locationLabelsView' => $viewLabels,
            'locationDownloadData' => $downloadData,
            'locationViewData' => $viewData,
        ];
    }
}
