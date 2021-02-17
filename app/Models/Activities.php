<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_category
 * @property integer $id_point_a
 * @property integer $id_point_b
 * @property string $name
 * @property string $description
 * @property string $icon
 * @property float $distance
 * @property float $duration
 * @property int $dificulty
 * @property string $perfil
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property Point $point
 * @property Point $point
 */
class Activities extends Model
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
    protected $fillable = ['id_category', 'id_point_a', 'id_point_b', 'name', 'description', 'icon', 'distance', 'duration', 'dificulty', 'perfil', 'status','created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'id_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pointA()
    {
        return $this->belongsTo('App\Models\Point', 'id_point_a');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pointB()
    {
        return $this->belongsTo('App\Models\Point', 'id_point_b');
    }
}
