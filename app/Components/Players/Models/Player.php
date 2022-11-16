<?php

namespace App\Components\Players\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $high
 * @property bool $active
 */
class Player extends Model
{
    use HasFactory;

    protected $guarded = [];
}
