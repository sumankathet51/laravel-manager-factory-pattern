<?php

namespace App\Enums;

enum LedgerTypeEnum: string
{
    case CREDIT = 'credit';
    case DEBIT = 'debit';
}
