<?php 
namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use App\Services\ExaminationServices;

class ExaminationController extends Controller
{

	public function QuestionDetail (Request $request) {
        $examination_id = $request->input('examination_id');
        $examination_paper_name = $request->input('examination_paper_name');
        $examination_paper_id = $request->input('examination_paper_id');

        return $this->ISASTView('examination.examinationquestion', [
            'examination_id' => $examination_id,
            'examination_paper_id' => $examination_paper_id,
            'examination_paper_name' => $examination_paper_name,
        ]);
    }
    
    public function GetExaminationSubjects (Request $request) {
        $examination_id = $request->input('examination_id');
        $examination_paper_id = $request->input('examination_paper_id');
        // 考试名作为缓存的名字
        // $name = 'examination'.$examination_id.$examination_paper_id;

        // 当缓存过以后就从缓存读取，缓存没值再去数据库读取,缓存时间单位为min
        // $response = Cache::remember($name, 1440, function () use ($examination_id, $examination_paper_id) {
            $response = $this->doPost('/api/examination/getexaminationsubjects', [
                'examination_id' => $examination_id,
                'examination_paper_id' => $examination_paper_id,
            ]);

            $examinationServices = new ExaminationServices();
            // 重新获取数组的数据格式
            $response = $examinationServices->ArrayFormatReBuild($response);

            return $response;
        // });

        return $response;
    }

    // 测试页面
    public function AllQuestionDetail (Request $request) {
        $examination_id = $request->input('examination_id');
        $examination_paper_id = $request->input('examination_paper_id');

        return $this->ISASTView('examination.testexaminationquestion', [
            'examination_id' => $examination_id,
            'examination_paper_id' => $examination_paper_id,
        ]);
    }

    // 测试页面使用
    public function GetAllExaminationSubjects (Request $request) {
        $examination_id = $request->input('examination_id');
        $examination_paper_id = $request->input('examination_paper_id');

        $response = $this->doPost('/api/examination/getallexaminationsubjects', [
            'examination_id' => $examination_id,
            'examination_paper_id' => $examination_paper_id,
        ]);

        $examinationServices = new ExaminationServices();
        // 重新获取数组的数据格式
        $response = $examinationServices->ArrayFormatReBuildForAll($response);

        return $response;
    }

    public function AddUserExaminationAnswer (Request $request) {
    	$result_array = $request->input('result_array');

		$response = $this->doPost('/api/examination/adduserexaminationanswer', [
			'result_array' => $result_array,
		]);

		return $response;
    }

    // 开始页面
    public function StartExami (Request $request) {
        $examination_id = $request->input('examination_id');
        $examination_paper_id = $request->input('examination_paper_id');
        $examination_paper_name = $request->input('examination_paper_name');

        return $this->ISASTView("examination.start", [
            'examination_id' => $examination_id,
            'examination_paper_id' => $examination_paper_id,
            'examination_paper_name' => $examination_paper_name,
        ]);
    }

    // 面试页面
    public function VideoInterView () {
        return $this->ISASTView("examination.videointerview");
    }

    public function UserExaminationUnswer () {
        return $this->ISASTView("examination.useranswerexamination");
    }

    public function GetUserExaminationAnswer (Request $request) {
        // $user_id = $request->input('user_id');
        // $examination_id = $request->input('examination_id');
        $user_id = 2;
        $examination_id = 2;
        $examination_paper_id = 3;
        $key = 'user_examinaition'.$user_id.$examination_id.$examination_paper_id;

        // 获取的数据做缓存
        $response = Cache::remember($key, 1440, function () use ($examination_id, $user_id, $examination_paper_id) {
            $response = $this->doPost("/api/examination/getexaminationanswer", [
                'user_id' => $user_id,
                'examination_id' => $examination_id,
                'examination_paper_id' => $examination_paper_id,
            ]);

            $examinationServices = new ExaminationServices();
            $response = $examinationServices->RebuildUserAnswerExam($response);

            return $response;
        });

        return $response;
    }

    public function ChooseExamination () {
        return $this->ISASTView('examination.chooseexamination');
    }

    public function TestChooseExamination () {
        return $this->ISASTView('examination.testchooseexamination');
    }

    public function GetExaminationName () {
        $response = $this->doPost('/api/examination/getexaminationname',[]);

        return $response;
    }
}