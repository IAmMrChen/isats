<?php 
namespace App\Services;

class ExaminationServices {
	// 重组数据格式
	public function ArrayFormatReBuild ($datas) {
		$datas = json_decode($datas, true);

      	if ($datas['status_code'] == 200) {
      		$order = 0;
            $result = [];

      		// 重组成自己想要的格式
      		foreach ($datas['data']['examination_paper_detail'] as $item => $infos) {
      			foreach ($infos['examination_group_cat_ref'] as $temp => $catInfos) {

      				// 同一个类型的题目放在一个组
      				// type 1.Mathematics(数学),2.English(英语),3.logic(逻辑)
      				if ($infos['type'] == 1 && !array_key_exists($infos['examination_type']['config_name'], $result)) {
      					$result[$infos['examination_type']['config_name']] = [];
      				}

      				if ($infos['type'] == 2 && !array_key_exists($infos['examination_type']['config_name'], $result)) {
      					$result[$infos['examination_type']['config_name']] = [];
      				}
  					
  					if ($infos['type'] == 3 && !array_key_exists($infos['examination_type']['config_name'], $result)) {
      					$result[$infos['examination_type']['config_name']] = [];
      				}

      				// 判断每个组只取多少个题目,并放入对应种类的数组中
      				if ($temp < $infos['examination_group']['cat_num']) {
      					$loop = count($result[$infos['examination_type']['config_name']]);

  	        			$result[$infos['examination_type']['config_name']][$loop]['examination_name'] = $datas['data']['examination']['examination_name'];
  	        			$result[$infos['examination_type']['config_name']][$loop]['examination_paper_name'] = $datas['data']['examination_paper']['examination_paper_name'];
                        $result[$infos['examination_type']['config_name']][$loop]['subject_cat'] = $catInfos['subject_cat']['cat_content'];
                        $result[$infos['examination_type']['config_name']][$loop]['group_name'] = $infos['examination_group']['group_name'];
                        $result[$infos['examination_type']['config_name']][$loop]['examination_id'] = $datas['data']['examination_id'];
                        $result[$infos['examination_type']['config_name']][$loop]['examination_paper_id'] = $infos['examination_paper_id'];
                        $result[$infos['examination_type']['config_name']][$loop]['group_id'] = $infos['group_id'];
                        $result[$infos['examination_type']['config_name']][$loop]['group_type'] = $infos['type'];
                        $result[$infos['examination_type']['config_name']][$loop]['cat_id'] = $catInfos['cat_id'];
                        $result[$infos['examination_type']['config_name']][$loop]['remain_time'] = 0;

                        foreach ($catInfos['subject'] as $index => $subjectInfos) {
                            // 判断这个cat下最多取几个subject
                            if ($index < $catInfos['subject_cat']['subject_num']) {
                                $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject'] = $subjectInfos['subject_content'];
                                $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_answer'] = $subjectInfos['subject_answer'];
                                $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_score'] = $subjectInfos['subject_score'];
                                $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_type'] = $subjectInfos['subject_type'];
                                $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_id'] = $subjectInfos['subject_id'];
                                
                                $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_detail'] = [];

                                if (count($subjectInfos['subject_detail']) > 0) {
                                    foreach ($subjectInfos['subject_detail'] as $key => $details) {
                                        $select = ($key == 0)?'A':($key == 1?'B':($key == 2?'C':($key == 3?'D':'')));
                                        $select = '['.$select.']'.' ';
                                        $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_detail'][$key] = str_replace('(( options ))', $select, $details);
                                    }
                                }
                            }
                        }
      				}
      			}
      		}

      		// 给题目生成一个按顺序的序号，从1开始
      		// 固定从数学先开始考，数学/英语/逻辑
      		foreach ($result as $key => $value) {
                // 这三个if是一开始三个类型的题目放在一份试卷上时候用的
      			// if ($key == 'Mathematics') {
      			// 	$order = 1;
      			// }

      			// if ($key == 'English') {
      			// 	$order = count($result['Mathematics']) + 1;
      			// }

      			// if ($key == 'Logic') {
      			// 	$order = count($result['English']) + count($result['Mathematics']) + 1;
      			// }

                // 改成了一份试卷只有一种类型

      			foreach ($value as $item => $infos) {
					$result[$key][$item]['order'] = $item + 1;
					// $order++;
				}
      		}

      		$datas['data'] = $result;
      	}

      	return $datas;
	}

    // 创建demo页面数据，包含获取回来的所有题目
    public function ArrayFormatReBuildForAll ($datas) {
        $datas = json_decode($datas, true);

        if ($datas['status_code'] == 200) {
            $order = 0;
            $result = [];

            // 重组成自己想要的格式
            foreach ($datas['data']['examination_paper_detail'] as $item => $infos) {
                foreach ($infos['examination_group_cat_ref'] as $temp => $catInfos) {

                    // 同一个类型的题目放在一个组
                    // type 1.Mathematics(数学),2.English(英语),3.logic(逻辑)
                    if ($infos['type'] == 1 && !array_key_exists($infos['examination_type']['config_name'], $result)) {
                        $result[$infos['examination_type']['config_name']] = [];
                    }

                    if ($infos['type'] == 2 && !array_key_exists($infos['examination_type']['config_name'], $result)) {
                        $result[$infos['examination_type']['config_name']] = [];
                    }
                    
                    if ($infos['type'] == 3 && !array_key_exists($infos['examination_type']['config_name'], $result)) {
                        $result[$infos['examination_type']['config_name']] = [];
                    }

                    $loop = count($result[$infos['examination_type']['config_name']]);

                    $result[$infos['examination_type']['config_name']][$loop]['examination_name'] = $datas['data']['examination']['examination_name'];
                    $result[$infos['examination_type']['config_name']][$loop]['examination_paper_name'] = $datas['data']['examination_paper']['examination_paper_name'];
                    $result[$infos['examination_type']['config_name']][$loop]['subject_cat'] = $catInfos['subject_cat']['cat_content'];
                    $result[$infos['examination_type']['config_name']][$loop]['group_name'] = $infos['examination_group']['group_name'];
                    $result[$infos['examination_type']['config_name']][$loop]['examination_id'] = $datas['data']['examination_id'];
                    $result[$infos['examination_type']['config_name']][$loop]['examination_paper_id'] = $infos['examination_paper_id'];
                    $result[$infos['examination_type']['config_name']][$loop]['group_id'] = $infos['group_id'];
                    $result[$infos['examination_type']['config_name']][$loop]['group_type'] = $infos['type'];
                    $result[$infos['examination_type']['config_name']][$loop]['cat_id'] = $catInfos['cat_id'];
                    $result[$infos['examination_type']['config_name']][$loop]['remain_time'] = 0;

                    foreach ($catInfos['subject'] as $index => $subjectInfos) {
                        $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject'] = $subjectInfos['subject_content'];
                        $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_answer'] = $subjectInfos['subject_answer'];
                        $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_score'] = $subjectInfos['subject_score'];
                        $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_type'] = $subjectInfos['subject_type'];
                        $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_id'] = $subjectInfos['subject_id'];
                        
                        $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_detail'] = [];

                        if (count($subjectInfos['subject_detail']) > 0) {
                            foreach ($subjectInfos['subject_detail'] as $key => $details) {
                                $select = ($key == 0)?'A':($key == 1?'B':($key == 2?'C':($key == 3?'D':'')));
                                $select = '['.$select.']';
                                $result[$infos['examination_type']['config_name']][$loop]['cat'][$index]['subject_detail'][$key] = str_replace('(( options ))', $select, $details);
                            }
                        }
                    }

                }
            }

            // 给题目生成一个按顺序的序号，从1开始
            // 固定从数学先开始考，数学/英语/逻辑
            foreach ($result as $key => $value) {
                // if ($key == 'Mathematics') {
                //     $order = 1;
                // }

                // if ($key == 'English') {
                //     $order = count($result['Mathematics']) + 1;
                // }

                // if ($key == 'Logic') {
                //     $order = count($result['English']) + count($result['Mathematics']) + 1;
                // }

                // foreach ($value as $item => $infos) {
                //     $result[$key][$item]['order'] = $order;
                //     $order++;
                // }

                foreach ($value as $item => $infos) {
                    $result[$key][$item]['order'] = $item + 1;
                    // $order++;
                }
            }

            $datas['data'] = $result;
        }

        return $datas;
    }

    // 重组学生答完题的试卷
    public function RebuildUserAnswerExam ($datas) {
        $datas = json_decode($datas, true);

        $result['Mathematics'] = [];
        $result['Logic'] = [];
        $result['English'] = [];

        if ($datas['status_code'] == 200) {
            $datas['data'] = collect($datas['data'])->each(function ($item, $key) use (&$result) {

                foreach ($item['subject']['subject_detail'] as $temp => $value) {
                    $select = ($temp == 0)?'A':($temp == 1?'B':($temp == 2?'C':($temp == 3?'D':'')));
                    $select = '['.$select.']';

                    $item['subject']['subject_detail'][$temp]['detail_content'] = str_replace('(( options ))', $select, $value['detail_content']);
                }

                $item['user_answer'] = is_numeric($item['user_answer'])?(int)$item['user_answer']:$item['user_answer'];

                if (!empty($item['subject']['subject_answers'])) {
                    $item['subject']['subject_answers']['detail_content'] = str_replace('(( options ))', '', $item['subject']['subject_answers']['detail_content']);
                }

                if ($item['group_type']['config_value'] == 1) {
                    $result['Mathematics'][$item['cat_id']][] = $item;
                } else if ($item['group_type']['config_value'] == 2) {
                    $result['English'][$item['cat_id']][] = $item;
                } else if ($item['group_type']['config_value'] == 3) {
                    $result['Logic'][$item['cat_id']][] = $item;
                }
            });

            $result['Logic'] = array_values($result['Logic']);
            $result['English'] = array_values($result['English']);
            $result['Mathematics'] = array_values($result['Mathematics']);
            $datas['data'] = $result;
        }

        return $datas;
    }
}