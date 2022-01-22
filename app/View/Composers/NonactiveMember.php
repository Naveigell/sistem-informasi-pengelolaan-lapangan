<?php


namespace App\View\Composers;


use App\Models\Member;
use App\Models\Pemesanan;
use Illuminate\View\View;

class NonactiveMember
{
    private $nonactiveMembers;

    /**
     * NonactiveMember constructor.
     */
    public function __construct()
    {
        $this->nonactiveMembers = Pemesanan::with('member')->whereHas('member', function ($query) {
                                                                        $query->where('status', Member::ACTIVE);
                                                                    })->whereIn('status', [Pemesanan::STATUS_PAID])
                                                                        ->whereDate('tanggal_sewa', '<', now()->subMonths(2)->toDateString())
                                                                        ->get();

    }

    public function compose(View $view)
    {
        $view->with('memberNotifications', $this->nonactiveMembers);
    }
}
