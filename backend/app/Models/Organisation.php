<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    /** @use HasFactory<\Database\Factories\OrganisationFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "registration_number",
        "registration_date",
        "description",
        "legal_status",
        "email",
        "website",
        "phone",
        "address",
        "country",
        "verified",
        "logo",
        "president_id",
        "is_active",
    ];

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
