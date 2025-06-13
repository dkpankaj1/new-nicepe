<?php

namespace App\Enums;

enum UserType: string
{
    case ADMIN = 'admin';
    case APICLIENT = 'api_client';
    case SUPERDISTRIBUTOR = 'super_distributor';
    case DISTRIBUTOR = 'distributor';
    case RETAILER = 'retailer';

    /**
     * Get the human-readable label for the role.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::APICLIENT => 'API Client',
            self::SUPERDISTRIBUTOR => 'Super Distributor',
            self::DISTRIBUTOR => 'Distributor',
            self::RETAILER => 'Retailer',
        };
    }

    /**
     * Get all available roles as an array.
     *
     * @return array
     */
    public static function getAllRoles(): array
    {
        return [
            self::ADMIN,
            self::APICLIENT,
            self::SUPERDISTRIBUTOR,
            self::DISTRIBUTOR,
            self::RETAILER,
        ];
    }
}
