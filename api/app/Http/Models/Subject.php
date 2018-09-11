<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Subject extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_subject';

    protected $dates = ['deleted_at'];

    public function SubjectDetail () {
    	return $this->hasMany('App\Http\Models\SubjectDetail', 'subject_id', 'subject_id');
    }

    public function SubjectAnswers () {
        return $this->hasOne('App\Http\Models\SubjectDetail', 'detail_id', 'subject_answer');
    }

    public function CreateSubject ($subject_type, $subject_content, $subject_answer, $cat_id, $subject_score) {
        $subject = new Subject();

        $subject->subject_type = $subject_type;
        $subject->subject_content = $subject_content;
        $subject->subject_answer = $subject_answer;
        $subject->cat_id = $cat_id;
        $subject->subject_score = $subject_score;

        if ($subject->save()) {
            return $subject->id;
        } else {
            return 0;
        }
    }

    public function UpdateAnswer ($subject_id, $detail_id) {
        $res = Subject::where('subject_id', "=", $subject_id)->update([
            'subject_answer' => $detail_id,
        ]);

        return $res;
    }
}
