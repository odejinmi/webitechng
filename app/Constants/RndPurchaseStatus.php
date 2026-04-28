<?php

namespace App\Constants;

class RndPurchaseStatus
{
    const PROCESSING = 'processing';
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const DECLINED = 'declined';

    public static function all()
    {
        return [
            self::PROCESSING => 'Processing',
            self::PENDING => 'Pending Approval',
            self::APPROVED => 'Approved',
            self::DECLINED => 'Declined',
        ];
    }

    public static function getBadge($status)
    {
        $badges = [
            self::PROCESSING => '<span class="badge badge-warning">Processing</span>',
            self::PENDING => '<span class="badge badge-info">Pending Approval</span>',
            self::APPROVED => '<span class="badge badge-success">Approved</span>',
            self::DECLINED => '<span class="badge badge-danger">Declined</span>',
        ];

        return $badges[$status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }
}
