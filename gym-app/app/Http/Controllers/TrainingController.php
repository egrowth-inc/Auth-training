<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muscle; // Muscle モデルを使う

class TrainingController extends Controller
{
    public function show($muscle = 'default')
    {
        // データベースから部位情報を取得（存在しない場合はデフォルト）
        $muscleData = Muscle::where('key', $muscle)->first();

        if (!$muscleData) {
            $muscleData = new Muscle([
                'key' => 'default',
                'name' => '不明な部位',
                'image' => 'default.png'
            ]);
        }

        return view('training', ['muscleData' => $muscleData]);
    }
}
