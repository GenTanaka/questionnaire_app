<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\lib\MyFunction;

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
        $dbQuestionnaire = new Questionnaire;
        $questionnaires = $dbQuestionnaire::where('user_id', '<>', Auth::id())
            ->where('is_release', true)
            ->where('deleted_at', NULL)
            ->orderBy('updated_at', 'DESC')
            ->paginate($per_page);
        $myQuestionnaires = $dbQuestionnaire::where('user_id', '=', Auth::id())
            ->where('deleted_at', NULL)
            ->orderBy('updated_at', 'DESC')
            ->paginate($per_page);
        return view('home', compact('questionnaires', 'myQuestionnaires'));
    }

    public function questionnaire($id)
    {
        $questionnaire = Questionnaire::where('id', '=', $id)->get();
        $answers = Answer::where('questionnaire_id', '=', $id)
            ->where('deleted_at', NULL)
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($answers as $answer) {
            $answer['answer1'] = MyFunction::sanitize_br($answer['answer1']);
            $answer['answer2'] = MyFunction::sanitize_br($answer['answer2']);
        }

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
                'question2' => $posts['question2'],
                'is_release' => isset($posts['is_release']) ? 1 : 0,
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

    public function edit($id)
    {
        $questionnaire = Questionnaire::where('id', '=', $id)->get();
        return view('edit', compact('questionnaire'));
    }

    public function saveEdit(Request $request)
    {
        $posts = $request->all();

        $request->validate([
            'title' => 'required',
            'question1' => 'required',
            'question2' => 'required',
        ]);

        DB::transaction(function() use($posts) {
            Questionnaire::where('id', '=', $posts['id'])
                ->update([
                    'title' => $posts['title'],
                    'question1' => $posts['question1'],
                    'question1' => $posts['question1'],
                    'is_release' => isset($posts['is_release']) ? 1 : 0,
                ]);

            if (isset($posts['is_delete_answers'])) {
                Answer::where('questionnaire_id', '=', $posts['id'])
                    ->update([
                        'deleted_at' => date("Y-m-d H:i:s", time()),
                    ]);
            }
        });

        return redirect(route('home'));
    }
}
