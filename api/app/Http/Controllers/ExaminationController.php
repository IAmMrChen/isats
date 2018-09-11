<?php
namespace App\Http\Controllers;

use DB;
use Cache;
use Illuminate\Http\Request;
use App\Http\Models\Examination;
use App\Http\Models\ExaminationUserAnswer;
use App\Http\Models\ExaminationAndPaperRef;
use App\Http\Models\ExaminationPaperDetail;

class ExaminationController extends Controller
{
    // 获取试卷题目
    public function GetExaminationSubjects (Request $request) {
        $examination_id = $request->input('examination_id');
        $examination_paper_id = $request->input('examination_paper_id');
        $name = 'examination'.$examination_id.$examination_paper_id;
        
        $res['status_code'] = 200;
        $res['message'] = 'ok';
        $res['data'] = [];

        $response = Cache::remember($name, 1440, function () use ($examination_id, $examination_paper_id, &$res) {
            $examinationRef = new ExaminationAndPaperRef();
            $resData = $examinationRef->GetExaminationSubjects($examination_id, $examination_paper_id)->first();

            if ($resData && $resData->count() > 0) {
            	$res['data'] = $resData;
            } else { 
            	$res['status_code'] = 201;
            	$res['message'] = 'Get Failed.';
            }
        });

        return $res;
    }

    // 测试
    public function GetAllExaminationSubjects (Request $request) {
        $examination_id = $request->input('examination_id');
        $examination_paper_id = $request->input('examination_paper_id');

        $res['status_code'] = 200;
        $res['message'] = 'ok';
        $res['data'] = [];

        $examinationRef = new ExaminationAndPaperRef();
        $resData = $examinationRef->GetAllExaminationSubjects($examination_id, $examination_paper_id)->first();

        if ($resData && $resData->count() > 0) {
            $res['data'] = $resData;
        } else {
            $res['status_code'] = 201;
            $res['message'] = 'Get Failed.';
        }

        return $res;
    }

    public function AddUserExaminationAnswer (Request $request) {
        $result_array = $request->input('result_array');

		$res['status_code'] = 200;
        $res['message'] = 'ok';
        $res['data'] = [];

        DB::beginTransaction();
        $examination_user_answer = new ExaminationUserAnswer();
        $resAdd = $examination_user_answer->AddUserExaminationAnswer($result_array);

        if (!$resAdd) {
        	$res['status_code'] = 201;
        	$res['message'] = 'Add Failed.';
        	DB::rollback();
        	return $res;
        }

        DB::commit();
        return $res;
    }

    public function GetUserExaminationAnswer (Request $request) {
        $user_id = $request->input('user_id');
        $examination_id = $request->input('examination_id');
        $examination_paper_id = $request->input('examination_paper_id');

        $res['status_code'] = 200;
        $res['message'] = 'ok';
        $res['data'] = [];

        $userExamination = new ExaminationUserAnswer();
        $resData = $userExamination->GetUserExaminationAnswer($examination_id, $user_id, $examination_paper_id)->get();

        if ($resData && $resData->count() > 0) {
            $res['data'] = $resData;
        } else {
            $res['message'] = 'Get Failed.';
            $res['status_code'] = 201;
        }

        return $res;
    }

    public function GetExaminationName () {
        $res['status_code'] = 200;
        $res['message'] = 'ok';
        $res['data'] = [];

        $examination = new Examination();
        $resData = $examination->GetExaminationName()->get();

        if ($resData && $resData->count() > 0) {
            $res['data'] = $resData;
        } else {
            $res['message'] = 'Get Failed.';
            $res['status_code'] = 201;
        }

        return $res;
    }
}
