<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Staff = 'staff';
    case Retailer = 'retailer';
    case Distributor = 'distributor';
    case SuperDistributor = 'super-distributor';
}
