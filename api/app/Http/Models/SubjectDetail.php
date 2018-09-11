<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class SubjectDetail extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_subject_detail';

    protected $dates = ['deleted_at'];

    public function CreateSubjectDetail ($subject_id, $detail_content) {
        $subjectDetail = new SubjectDetail();

        $subjectDetail->subject_id = $subject_id;
        $subjectDetail->detail_content = $detail_content;

        if ($subjectDetail->save()) {
            return $subjectDetail->id;
        } else {
            return 0;
        }
    }
}
