<?php

namespace App\Http\Controllers\API;

use App\Models\Poll;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les questions
        // $questions = Questions::all();
        // On retourne les informations des questions en JSON
        
        $questions = DB::table('questions')
            ->leftjoin('polls', 'polls.id', '=', 'questions.polls_id')
            ->select('questions.*','nameSondage')
            ->get()
            ->toArray();

            return response()->json($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nameQuestion' => 'required',
            'polls_id' => 'required',
        ]);

         // On crée une nouvelle question
         $questions = Question::create([
            'nameQuestion' => $request->nameQuestion,
            'polls_id' => $request->polls_id,
        ]);
        // On retourne les informations de la nouvelle question en JSON
        return response()->json($questions, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question = DB::table('questions')
        ->join('polls', 'polls.id', '=', 'questions.polls_id')
        ->join('answers', 'questions.id', '=', 'answers.questions_id')
        ->select('questions.*', 'nameSondage', 'nameAnswer', 'question.id')
        // ->where('questions.id', '=', $question->id)
        ->get();
        
       return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request, [
            'nameQuestion' => 'required',
            'polls_id' => 'required',
       ]);

       // On modifie la question
       $question->update([
        'nameQuestion' => $request->nameQuestion,
        'polls_id' => $request->polls_id,
    ]);
    // On retourne les informations de la question modifiée en JSON
    return response()->json($question, 201);
    }

    public function toto(Poll $id)
    {
        $questionPoll = DB::table('questions')
        ->select('nameQuestion','id')
        ->where('questions.polls_id', '=', $id->id)
        ->get();
        // dd($id);
       return response()->json($questionPoll);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // On supprime la question
        $question->delete();
        return response()->json([
            'status' => 'Supprimer avec succès avec succèss']);
    }

  
}
