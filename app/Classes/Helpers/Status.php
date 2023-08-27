<?php

namespace App\Classes\Helpers;

class Status
{

    static $active_choice = [
        '1' => ['class' => 'badge rounded-pill badge-success', 'text' => 'Active'],
        '0' => ['class' => 'badge rounded-pill badge-danger', 'text' => 'Inactive']
    ];

    static $status_choice = [
        'active'  => ['class' => 'badge rounded-pill badge-success', 'text' => 'Active'],
        'completed'  => ['class' => 'badge rounded-pill badge-success', 'text' => 'Completed'],
        'approved'  => ['class' => 'badge rounded-pill badge-success', 'text' => 'Completed'],
        'hold'  => ['class' => 'badge rounded-pill badge-warning', 'text' => 'Hold'],
        'rejected'  => ['class' => 'badge rounded-pill badge-danger', 'text' => 'Rejected'],
        'reject'  => ['class' => 'badge rounded-pill badge-danger', 'text' => 'Rejected'],
        'cancelled'  => ['class' => 'badge rounded-pill badge-danger', 'text' => 'Cancelled'],
        'cancel'  => ['class' => 'badge rounded-pill badge-danger', 'text' => 'Cancelled'],
        'pending'  => ['class' => 'badge rounded-pill badge-info', 'text' => 'Pending'],
        'draft' => ['class' => 'badge rounded-pill badge-info', 'text' => 'Draft']
    ];

    public static function active_label($active)
    {
        if (!in_array($active, array_keys(self::$active_choice))) {
            return;
        }
        return "<span class='px-2 " . self::$active_choice[$active]['class'] . "'>" . self::$active_choice[$active]['text'] . "</span>";
    }

    public static function  status_label($status)
    {
        if (!in_array($status, array_keys(self::$status_choice))) {
            return;
        }
        return "<span class='" . self::$status_choice[$status]['class'] . "'>" . self::$status_choice[$status]['text'] . "</span>";
    }

    public static function label_text($text, $label_color = 'success')
    {
        return "<span class='badge rounded-pill mx-1 px-2 badge-" . $label_color . "'>" . $text . "</span>";
    }
}
