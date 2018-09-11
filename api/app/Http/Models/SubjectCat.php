<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class SubjectCat extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_subject_cat';

    protected $dates = ['deleted_at'];

    public function CreateSubjectCat ($cat_content) {
        $subjectCat = new SubjectCat();

        $subjectCat->cat_content = "";

        if ($subjectCat->save()) {
            return $subjectCat->id;
        } else {
            return 0;
        }
    }
}
