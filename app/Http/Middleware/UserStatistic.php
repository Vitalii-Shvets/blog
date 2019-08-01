<?php

namespace App\Http\Middleware;
use App\Repositories\BlogUserStatisticRepository;
use App\Services\UserStatisticsCollectService;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class UserStatistic
{
    private $userStatisticsCollectService;
    private $blogUserStatisticRepository;
    public function __construct(UserStatisticsCollectService $userStatisticsCollectService, BlogUserStatisticRepository $blogUserStatisticRepository)
    {
        $this->blogUserStatisticRepository = $blogUserStatisticRepository;
        $this->userStatisticsCollectService = $userStatisticsCollectService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $this->userStatisticsCollectService->saveUserData($request->ip(),$request->header('User-Agent'), $request->session()->has('session_start'));
        View::share('userStatistic', $this->blogUserStatisticRepository->getUserStatistic());
        return $next($request);
    }

}
