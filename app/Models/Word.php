<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'words';

    protected $primaryKey = 'No';

    public $incrementing = true;

    protected $keyType = 'int';

    const UPDATED_AT = null;

    protected $fillable = [
        'Word',
        'Meaning',
        'Sentence',
    ];
}
