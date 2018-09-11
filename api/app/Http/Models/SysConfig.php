<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class SysConfig extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_sys_config';

    protected $dates = ['deleted_at'];
}
