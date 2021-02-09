<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property UsersPermiso[] $usersPermisos
 */
class Permisos extends Model
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
    protected $fillable = ['nombre', 'descripcion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersPermisos()
    {
        return $this->hasMany('App\Models\UsersPermiso', 'idpermisos');
    }
}
