<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ExaminationPaperDetail extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_examination_paper_detail';

    protected $dates = ['deleted_at'];

    public function ExaminationGroup () {
    	return $this->hasOne('App\Http\Models\ExaminationGroup', 'group_id', 'group_id');
    }

    public function ExaminationGroupCatRef () {
    	return $this->hasMany('App\Http\Models\ExaminationGroupCatRef', 'group_id', 'group_id');
    }

    public function ExaminationType () {
    	return $this->hasOne('App\Http\Models\SysConfig', 'config_value', 'type');
    }
}
