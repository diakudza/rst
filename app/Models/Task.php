<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Task",
 *     description="Task model",
 *     @OA\Xml(
 *         name="Task"
 *     )
 * )
 */

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['frequency', 'string', 'repetitions', 'salt', 'status', 'group_id', 'hash'];

    public function group()
    {
        return $this->hasOne(Group::class);
    }

    public function statusAll()
    {
        return $this->select('id', 'status')->get();
    }

}
