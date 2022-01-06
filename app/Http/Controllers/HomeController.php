<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $per_page = 5;
        $questionnaires = Questionnaire::paginate($per_page);
        return view('home', compact('questionnaires'));
    }

    public function questionnaire($id)
    {
        $questionnaire = Questionnaire::where('id', '=', $id)->get();
        $answers = Answer::where('questionnaire_id', '=', $id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('questionnaire', compact('questionnaire', 'answers'));
    }

    public function make()
    {
        return view('make');
    }

    public function makedQuestionnaire(Request $request)
    {
        $posts = $request->all();

        $request->validate([
            'title' => 'required',
            'question1' => 'required',
            'question2' => 'required',
        ]);

        DB::transaction( function() use($posts) {
            Questionnaire::insert([
                'title' => $posts['title'],
                'user_id' => Auth::id(),
                'question1' => $posts['question1'],
                'question2' => $posts['question2']
            ]);
        });

        return redirect(route('home'));
    }

    public function answer($id)
    {
        $questionnaire = Questionnaire::where('id', '=', $id)->get();
        return view('answer', compact('questionnaire'));
    }

    public function saveAnswer(Request $request)
    {
        $posts = $request->all();

        $request->validate([
            'answer1' => 'required',
            'answer2' => 'required',
        ]);

        DB::transaction(function() use($posts) {
            Answer::insert([
                'questionnaire_id' => $posts['questionnaire_id'],
                'user_id' => Auth::id(),
                'answer1' => $posts['answer1'],
                'answer2' => $posts['answer2']
            ]);
        });

        return redirect(route('home'));
    }
}
