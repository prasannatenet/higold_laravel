<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public const TYPES = ['Individual', 'Commercial'];

    public const INTERESTS = [
        'Kitchen Hardware',
        'Wardrobe Accessories',
        'Furniture Fittings',
        'Outdoor Furniture',
    ];

    protected $fillable = [
        'customer_type', 'name', 'mobile', 'contact_number', 'city', 'pincode', 'email', 'interests',
    ];

    protected function casts(): array
    {
        return ['interests' => 'array'];
    }
}
