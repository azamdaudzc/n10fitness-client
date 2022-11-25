<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBuilderDayExerciseSet extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_week_days',
        'set_no',
        'rep_min_no',
        'rep_max_no',
        'rpe_no',
        'load_text',
        'rest_time',
        'notes',
    ];
}
