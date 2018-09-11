<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Examination extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isats_examination';

    protected $dates = ['deleted_at'];

    public function ExaminationPaperDetail () {
        return $this->hasMany('App\Http\Models\ExaminationPaperDetail', 'examination_paper_id', 'examination_paper_id');
    }

    public function ExaminationAndPaperRef () {
    	return $this->hasMany('App\Http\Models\ExaminationAndPaperRef', 'examination_id', 'examination_id');
    }

    public function ExaminationPaper () {
    	return $this->hasOne('App\Http\Models\ExaminationPaper', 'examination_paper_id', 'examination_paper_id');
    }

    public function GetExaminationName () {
        $res = Examination::with([
                              'ExaminationAndPaperRef' => function ($query) {
                                    $query->select('examination_id', 'examination_paper_id')
                                          ->with('ExaminationPaper');
                              }
                          ])
                          ->has('ExaminationAndPaperRef');

        return $res;
    }
}
