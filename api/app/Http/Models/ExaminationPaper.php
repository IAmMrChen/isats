<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ExaminationPaper extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_examination_paper';

    protected $dates = ['deleted_at'];
}
