<?php
namespace App\Http\Controllers;

use Cache;

class CacheController {
	// 清除缓存
    public function ClearCache () {
        Cache::flush();

        // 清除缓存的同时添加新的缓存
        // $examination = new ExaminationController();
        // $examination->GetExaminationSubjects();

        return '清除成功';
    }

    // 清除对应键的缓存
    public function ClearKeyCache ($key) {
        Cache::forget($key);

        // $examination = new ExaminationController();
        // $examination->GetExaminationSubjects();

        return '清除成功';
    }
}

