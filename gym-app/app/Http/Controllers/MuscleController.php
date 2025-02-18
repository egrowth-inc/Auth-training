<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muscle;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muscle;

class MuscleController extends Controller
{
    public function show($name)
    {
        $muscle = Muscle::where('name', $name)->first();

        if (!$muscle) {
            return response()->json(['error' => '筋トレ情報が見つかりません'], 404);
        }

        return response()->json($muscle);
    }
}


