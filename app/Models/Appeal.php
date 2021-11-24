<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string surname
 * @property string|null patronymic
 * @property integer age
 * @property integer gender
 * @property string phone
 * @property string email
 * @property string message
 */

class Appeal extends Model
{
    use HasFactory;
}
