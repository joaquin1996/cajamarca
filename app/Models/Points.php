<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property float $lon
 * @property float $lat
 * @property float $elevation
 * @property float $temp
 * @property float $temp_min
 * @property float $temp_max
 * @property string $created_at
 * @property string $updated_at
 * @property Activity[] $activities
 * @property Activity[] $activities
 */
class Points extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'lon', 'lat', 'elevation', 'temp', 'temp_min', 'temp_max', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activitiesA()
    {
        return $this->hasMany('App\Models\Activity', 'id_point_a');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activitiesB()
    {
        return $this->hasMany('App\Models\Activity', 'id_point_b');
    }
}
