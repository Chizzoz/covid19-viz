<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidCase extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batch', 'fips', 'admin', 'province_state', 'country_region', 'lastupdate', 'latitude', 'longitude', 'confirmed', 'deaths', 'recovered', 'active', 'combined_key', 'unique_source',
    ];
}
