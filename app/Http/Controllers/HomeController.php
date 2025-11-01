<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Process;
use App\Models\Gallery;
use App\Models\Team;
use App\Models\Counter;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Partner;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $service;
    private $testimonial;
    private $team;
    private $process;
    private $counter;
    private $portfolio;
    private $faq;
    // private $settings;
    private $teams;
    private $partners;

    public function __construct(Service $service, Testimonial $testimonial, Team $team, Process $process, Counter $counter, Gallery $portfolio,Faq $faq,Team $teams,Partner $partners)
    {
        $this->service = $service;
        $this->testimonial = $testimonial;
        $this->team = $team;
        $this->process = $process;
        $this->counter = $counter;
        $this->portfolio = $portfolio;
        $this->faq=$faq;
        $this->teams=$teams;
        // $this->settings=$settings;
        $this->partners=$partners;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            return redirect()->route('admin.login-view');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}