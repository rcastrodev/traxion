<?php

namespace App;

use App\Company;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = ['company_id', 'description', 'address', 'email', 'email2', 'email3', 'phone1', 'phone2', 'phone3', 'logo_header', 'logo_footer', 'facebook', 'instagram', 'linkedin', 'youtube'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
