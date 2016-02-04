<?php

namespace App\Model;

use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Model;

class Flows extends Model
{
    protected $primaryKey = 'user_id';

    /**
     * Charge combo flows.
     * @param $month how many months to charge.
     */
    public function ComboFlowsCharge($flows, $month)
    {
        $now = new DateTime("", new DateTimeZone('CST'));
        $end = new DateTime($this->combo_end_date, new DateTimeZone('CST'));

        // No combo flows
        if ($now > $end) {
            $end = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') + $month, date('D') + 1, date('Y')));
        }

        // Have combo flows, update.
        if ($end > $now) {
            $end = $end->add(new DateInterval("P{$month}M"));
        }

        $this->combo_flows = $flows;
        $this->combo_end_date = $end;
        return $this->save();
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
