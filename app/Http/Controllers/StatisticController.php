<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\StatisticService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class StatisticController extends Controller
{
    private $statisticService;

    public function __construct()
    {
        $this->statisticService = App::make(StatisticService::class);
    }

    public function getMonthlySpendingsByCategory(Request $request)
    {
        $cacheId = 'monthlySpendingsByCategory' . auth()->user()->id;
        if (Cache::has($cacheId)) {
            return response()->json(Cache::get($cacheId));
        }
        $spendings = $this->statisticService->getMonthlySpendingsByCategory(auth()->user()->id, $request['year']);
        Cache::put($cacheId, $spendings, 60);
        return response()->json($spendings);
    }

    public function getAverageSpendingsOfOtherUsers(Request $request)
    {
        return response()->json($this->statisticService->getAverageSpendingsOfOtherUsers(auth()->user()->id, $request['year']));
    }

    public function getAverageMonthlySpendingsByUsers(Request $request)
    {
        $cacheId = 'averageMonthlySpendingsByUsers' . auth()->user()->id;
        if (Cache::has($cacheId)) {
            return response()->json(Cache::get($cacheId));
        }
        $spendings = $this->statisticService->getAverageMonthlySpendingsByUsers(auth()->user()->id, $request['year']);
        Cache::put($cacheId, $spendings, 60);
        return response()->json($spendings);
    }
}
