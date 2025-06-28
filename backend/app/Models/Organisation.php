<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    /** @use HasFactory<\Database\Factories\OrganisationFactory> */
    use HasFactory;
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

}
