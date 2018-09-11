<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;



class ExaminationAndPaperRef extends BaseModel
{
    use SoftDeletes;

	protected $table = 'isast_examination_and_paper_ref';

    protected $dates = ['deleted_at'];

    public function ExaminationPaperDetail () {
    	return $this->hasMany('App\Http\Models\ExaminationPaperDetail', 'examination_paper_id', 'examination_paper_id');
    }

    public function ExaminationPaper () {
    	return $this->hasOne('App\Http\Models\ExaminationPaper', 'examination_paper_id', 'examination_paper_id');
    }

    public function Examination () {
    	return $this->hasOne('App\Http\Models\Examination', 'examination_id', 'examination_id');
    }

    public function GetExaminationSubjects ($examination_id, $examination_paper_id) {

    	$res = ExaminationAndPaperRef::where('examination_id', $examination_id)
    								 ->where('examination_paper_id', $examination_paper_id)
    								 ->with([
		    					  		'ExaminationPaperDetail' => function ($query) {
		    					  			$query->with([
		    					  				'ExaminationGroup' => function ($query) {
		    					  					$query->select('group_id', 'group_name', 'cat_num');
		    					  				},
		    					  				'ExaminationGroupCatRef' => function ($query) {
		    					  					$query->with([
		    					  						'SubjectCat' => function ($query) {
		    					  							$query->select('cat_id', 'cat_content', 'subject_num');
		    					  						},
		    					  						'Subject' => function ($query) {
		    					  							$query->with([
		                                                        'SubjectDetail' => function ($query) {
		                                                            $query->select('detail_id', 'subject_id', 'detail_content')
		                                                            	  ->inRandomOrder();

		                                                        }
		                                                    ])
		                                                    ->select(
		                                                    	'subject_id'
		                                                      , 'subject_type'
		                                                      , 'subject_content'
		                                                      , 'cat_id'
		                                                      , 'subject_answer'
		                                                      , 'subject_score'
		                                                   );
		    					  						}
		    					  					])
		    					  					->select(
		    					  						'ref_id'
		    					  					   ,'group_id'
		    					  					   ,'cat_id'
		    					  					)
		    					  					->inRandomOrder();
		    					  				},
		    					  				'ExaminationType' => function ($query) {
				    					  			$query->where('config_code', 'examination_type');
				    					  		}
		    					  			])
		                                    ->orderBy('order_group', 'asc');
		    					  		},
		    					  		'ExaminationPaper' => function ($query) {
		    					  			$query->select('examination_paper_id', 'examination_paper_name');
		    					  		},
		    					  		'Examination' => function ($query) {
		    					  			$query->select('examination_id', 'examination_name');
		    					  		}
		    					  ]);

    	return $res;
    }

    public function GetAllExaminationSubjects ($examination_id, $examination_paper_id) {
    	$res = ExaminationAndPaperRef::where('examination_id', $examination_id)
    								 ->where('examination_paper_id', $examination_paper_id)
    								 ->with([
		    					  		'ExaminationPaperDetail' => function ($query) {
		    					  			$query->with([
		    					  				'ExaminationGroup' => function ($query) {
		    					  					$query->select('group_id', 'group_name', 'cat_num');
		    					  				},
		    					  				'ExaminationGroupCatRef' => function ($query) {
		    					  					$query->with([
		    					  						'SubjectCat' => function ($query) {
		    					  							$query->select('cat_id', 'cat_content', 'subject_num');
		    					  						},
		    					  						'Subject' => function ($query) {
		    					  							$query->with([
		                                                        'SubjectDetail' => function ($query) {
		                                                            $query->select('detail_id', 'subject_id', 'detail_content');

		                                                        }
		                                                    ])
		                                                    ->select(
		                                                    	'subject_id'
		                                                      , 'subject_type'
		                                                      , 'subject_content'
		                                                      , 'cat_id'
		                                                      , 'subject_answer'
		                                                      , 'subject_score'
		                                                   );
		    					  						}
		    					  					])
		    					  					->select(
		    					  						'ref_id'
		    					  					   ,'group_id'
		    					  					   ,'cat_id'
		    					  					);
		    					  				},
		    					  				'ExaminationType' => function ($query) {
				    					  			$query->where('config_code', 'examination_type');
				    					  		}
		    					  			])
		                                    ->orderBy('order_group', 'asc');
		    					  		},
		    					  		'ExaminationPaper' => function ($query) {
		    					  			$query->select('examination_paper_id', 'examination_paper_name');
		    					  		},
		    					  		'Examination' => function ($query) {
		    					  			$query->select('examination_id', 'examination_name');
		    					  		}
		    					  ]);

    	return $res;
    }
}