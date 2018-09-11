<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ExaminationGroupCatRef extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_examination_group_cat_ref';

    protected $dates = ['deleted_at'];

    public function SubjectCat () {
    	return $this->hasOne('App\Http\Models\SubjectCat', 'cat_id', 'cat_id');
    }

    public function Subject () {
    	return $this->hasMany('App\Http\Models\Subject', 'cat_id', 'cat_id');
    }

    public function CreateGroupSubjectCatRef ($groupId, $subjectCatId) {
        $examinationGroupCatRef = new ExaminationGroupCatRef();

        $examinationGroupCatRef->group_id = $groupId;
        $examinationGroupCatRef->cat_id = $subjectCatId;
        
        return $examinationGroupCatRef->save();
    }
}
