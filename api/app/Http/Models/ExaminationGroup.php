<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ExaminationGroup extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_examination_group';

    protected $dates = ['deleted_at'];

    public function CreateGroup ($group_name) {
        $examinationGroup = new ExaminationGroup();

        $examinationGroup->group_name = $group_name;
        $examinationGroup->cat_num = 10;

        if ($examinationGroup->save()) {
            return $examinationGroup->id;
        } else {
            return 0;
        }
    }
}
