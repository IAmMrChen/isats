<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImportSubjectController extends Controller
{
    public function ImportSubject () {
        return;
        set_time_limit(0);

        $filelists = [
            "General Knowledge Stage 6 Easy.htm",
            "General Knowledge Stage 6 Hard.htm",
            "Logic Stage 6 Easy.htm",
            "Logic Stage 6 Hard.htm",
        ];

        $currenIndex = 3;
        $timufeng = '<p class=MsoNormal><span lang=EN-US style=\'font-size:18.0pt;font-family:"Cambria","serif"\'>&lt;__question&gt;</span></p>';
        $quyufeng = '<p class=MsoNormal><span lang=EN-US style=\'font-size:18.0pt;font-family:"Cambria","serif"\'>&lt;__block&gt;</span></p>';

        $contents = Storage::disk("public")->get('/uploads/isats_subjects/other/logic/' . $filelists[$currenIndex]);

        $contents = explode("<body lang=ZH-CN style='text-justify-trim:punctuation'>", $contents)[1];
        $contents = str_replace("</body>", "", $contents);
        $contents = str_replace("</html>", "", $contents);
        $contents = explode($timufeng, $contents);

        $subject_title = $contents[0];
        $group_id = 0;

        // 创建group
        $responseGroup = $this->doPost("/api/import/importgroup", [
            "group_name" => $subject_title,
        ]);

        $responseGroup = json_decode($responseGroup, true);

        $group_id = $responseGroup["data"][0];

        foreach ($contents as $key => $value) {
            // 1是单选
            // 2是填空
            if ($key > 0) {
                $contentTemp = explode($quyufeng, $contents[$key]);
                
                $type = $contentTemp[0];
                $subject = $contentTemp[1];
                $answer = $contentTemp[count($contentTemp) - 1];

                if (strstr($type, "Type=1")) {
                    // 单选
                    if (strstr($answer, "[A]")) {
                        $answer = 1;
                    } else if (strstr($answer, "[B]")) {
                        $answer = 2;
                    } else if (strstr($answer, "[C]")) {
                        $answer = 3;
                    } else if (strstr($answer, "[D]")) {
                        $answer = 4;
                    }

                    $xuanxiang1 = str_replace("[A]", "(( options ))", $contentTemp[2]);
                    $xuanxiang2 = str_replace("[B]", "(( options ))", $contentTemp[3]);
                    $xuanxiang3 = str_replace("[C]", "(( options ))", $contentTemp[4]);
                    $xuanxiang4 = str_replace("[D]", "(( options ))", $contentTemp[5]);

                    $type = 1;
                } else if (strstr($type, "Type=2")) {
                    // 填空
                    $type = 2;
                    $xuanxiang1 = "";
                    $xuanxiang2 = "";
                    $xuanxiang3 = "";
                    $xuanxiang4 = "";
                }

                $params = [
                    'type' => $type,
                    'subject' => $subject,
                    'answer' => $answer,
                    'xuanxiang1' => $xuanxiang1,
                    'xuanxiang2' => $xuanxiang2,
                    'xuanxiang3' => $xuanxiang3,
                    'xuanxiang4' => $xuanxiang4,
                    "group_id" => $group_id,
                ];

                // var_dump($params);die;

                $response = $this->doPost('/api/import/importsubject', $params);

                // return $response;
            }
        }
    }
}
