<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Models\SubjectCat;
use App\Http\Models\Subject;
use App\Http\Models\SubjectDetail;
use App\Http\Models\ExaminationGroup;
use App\Http\Models\ExaminationGroupCatRef;
use DB;

class ImportSubjectController extends Controller
{
    public function ImportSubject (Request $request) {
        $type = $request->input('type');
        $subject_content = $request->input('subject');
        $answer = $request->input('answer');
        $xuanxiang1 = $request->input('xuanxiang1');
        $xuanxiang2 = $request->input('xuanxiang2');
        $xuanxiang3 = $request->input('xuanxiang3');
        $xuanxiang4 = $request->input('xuanxiang4');
        $group_id = $request->input('group_id');

        $res['data'] = [];
        $res['message'] = 'ok';
        $res['status_code'] = 200;

        $subjectCat = new SubjectCat();
        $subject = new Subject();
        $subjectDetail = new SubjectDetail();
        $examinationGroupCatRef = new ExaminationGroupCatRef();

        DB::beginTransaction();

        $resCat = $subjectCat->CreateSubjectCat("");

        if ($resCat) {
            $resGroupRef = $examinationGroupCatRef->CreateGroupSubjectCatRef($group_id, $resCat);
            
            if (!$resGroupRef) {
                $res['message'] = 'Import failed';
                $res['status_code'] = 207;
                DB::rollBack();
                return $res;
            }
        }

        if ($resCat) {
            $resSubject = $subject->CreateSubject($type, $subject_content, $answer, $resCat, 1);

            if ($resSubject && $type == 1) {
                $resXX1 = $subjectDetail->CreateSubjectDetail($resSubject, $xuanxiang1);
                if (!$resXX1) {
                    $res['message'] = 'Import failed';
                    $res['status_code'] = 203;
                    DB::rollBack();
                    return $res;
                }

                $resXX2 = $subjectDetail->CreateSubjectDetail($resSubject, $xuanxiang2);
                if (!$resXX2) {
                    $res['message'] = 'Import failed';
                    $res['status_code'] = 204;
                    DB::rollBack();
                    return $res;
                }

                $resXX3 = $subjectDetail->CreateSubjectDetail($resSubject, $xuanxiang3);
                if (!$resXX3) {
                    $res['message'] = 'Import failed';
                    $res['status_code'] = 205;
                    DB::rollBack();
                    return $res;
                }

                $resXX4 = $subjectDetail->CreateSubjectDetail($resSubject, $xuanxiang4);
                if (!$resXX4) {
                    $res['message'] = 'Import failed';
                    $res['status_code'] = 206;
                    DB::rollBack();
                    return $res;
                }

                $resAnswer = false;

                if ($answer == 1) {
                    $resAnswer = $subject->UpdateAnswer($resSubject, $resXX1);
                } else if ($answer == 2) {
                    $resAnswer = $subject->UpdateAnswer($resSubject, $resXX2);
                } else if ($answer == 3) {
                    $resAnswer = $subject->UpdateAnswer($resSubject, $resXX3);
                } else if ($answer == 4) {
                    $resAnswer = $subject->UpdateAnswer($resSubject, $resXX4);
                }

                if (!$resAnswer) {
                    $res['message'] = 'Import failed';
                    $res['status_code'] = 208;
                    DB::rollBack();
                    return $res;
                }
            } else if (!$resSubject) {
                $res['message'] = 'Import failed';
                $res['status_code'] = 202;
                DB::rollBack();
                return $res;
            }
        } else {
            $res['message'] = 'Import failed';
            $res['status_code'] = 201;
            DB::rollBack();
            return $res;
        }

        DB::commit();
        return $res;
    }

    public function ImportGroup (Request $request) {
        $group_name = $request->input('group_name');

        $res['data'] = [];
        $res['message'] = 'ok';
        $res['status_code'] = 200;

        $examinationGroup = new ExaminationGroup();

        $resAdd = $examinationGroup->CreateGroup($group_name);

        if (!$resAdd) {
            $res['message'] = 'Add failed';
            $res['status_code'] = 201;
        } else {
            $res['data'] = [$resAdd];
        }

        return $res;
    }
}
