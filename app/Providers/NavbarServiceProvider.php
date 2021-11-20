<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Messages;
use Illuminate\Support\Facades\DB;
use DateTime;

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public $messages;

    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composerMessages();
    }

    
    private function composerMessages()
    {
        $this->messages = array();

        $msg = Messages::where('isRead', '0')->latest()->get();
        foreach ($msg as $value) {
            $obj = (object)[
                "id" => $value->id,
                "email" => $value->email,
                "time_ago" =>$this->time_elapsed_string($value->updated_at)
            ];
            array_push($this->messages, $obj);
        }

        view()->composer('includes.navbar', function ($view) {
            $view->with(['messages' => $this->messages, 'count' => sizeof($this->messages)]);
        });
    }

    private function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
