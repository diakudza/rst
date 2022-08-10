<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Group",
 *     description="Group model",
 *     @OA\Xml(
 *         name="Group"
 *     )
 * )
 */


class Group extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
