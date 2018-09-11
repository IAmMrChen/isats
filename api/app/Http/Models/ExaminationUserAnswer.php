<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ExaminationUserAnswer extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isata_examination_user_answer';

    protected $dates = ['deleted_at'];

    public function Examination () {
    	return $this->hasOne('App\Http\Models\Examination', 'examination_id', 'examination_id');
    }

    public function ExaminationPaper () {
    	return $this->hasOne('App\Http\Models\ExaminationPaper', 'examination_paper_id', 'examination_paper_id');
    }

    public function GroupType () {
    	return $this->hasOne('App\Http\Models\SysConfig', 'config_value', 'group_type');
    }

    public function SubjectCat () {
    	return $this->hasOne('App\Http\Models\SubjectCat', 'cat_id', 'cat_id');
    }

    public function Subject () {
        return $this->hasOne('App\Http\Models\Subject', 'subject_id', 'subject_id');
    }

    public function SubjectDetail () {
    	return $this->hasOne('App\Http\Models\SubjectDetail', 'detail_id', 'user_answer');
    }

    public function AddUserExaminationAnswer ($result_array) {
		return DB::table('isata_examination_user_answer')->insert($result_array);
    }

    public function GetUserExaminationAnswer ($examination_id, $user_id, $examination_paper_id) {
    	$res = ExaminationUserAnswer::where('user_id', $user_id)
    								->where('examination_id', $examination_id)
                                    ->when($examination_paper_id > 0, function ($query) use ($examination_paper_id) {
                                        return $query->where('examination_paper_id', $examination_paper_id);
                                    })
    								->with([
    									'ExaminationPaper' => function ($query) {
    										$query->select('examination_paper_id', 'examination_paper_name');
    									},
    									'Examination' => function ($query) {
    										$query->select('examination_name', 'examination_id');
    									},
    									'SubjectCat' => function ($query) {
    										$query->select('cat_content', 'cat_id', 'subject_num');
    									},
    									'Subject' => function ($query) {
    										$query->with([
    											'SubjectDetail' => function ($query) {
    												$query->select('detail_id', 'detail_content', 'subject_id');
    											},
                                                'SubjectAnswers' => function ($query) {
                                                    $query->select('detail_id', 'detail_content');
                                                }
    										]);
    									},
    									'GroupType' => function ($query) {
    										$query->where('config_code', 'examination_type')
    											  ->select('config_value', 'config_name');
    									},
    								])
    								->select()
                                    ->orderBy('group_type', 'asc');

    	return $res;
    }
}
