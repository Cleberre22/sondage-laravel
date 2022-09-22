<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // On récupère tous les réponces
        // $answers = Answers::all();
        // On retourne les informations des réponses en JSON
        
        $answers = DB::table('answers')
            ->leftjoin('questions', 'questions.id', '=', 'answers.questions_id')
            ->select('answers.*','nameQuestion')
            ->get()
            ->toArray();

            return response()->json($answers);
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
            'nameAnswer' => 'required',
            'questions_id' => 'required',
        ]);

         // On crée une nouvelle réponse
         $answers = Answer::create([
            'nameAnswer' => $request->nameAnswer,
            'questions_id' => $request->questions_id,
        ]);
        // On retourne les informations de la nouvelle réponse en JSON
        return response()->json($answers, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        $answer = DB::table('answers')
        ->leftjoin('questions', 'questions.id', '=', 'answers.questions_id')
        ->select('answers.*','nameQuestion')
        ->where('answers.id', '=', $answer->id)
        ->get();
        
       return response()->json($answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $this->validate($request, [
            'nameAnswer' => 'required',
            'questions_id' => 'required',
       ]);

       // On modifie la réponse
       $answer->update([
        'nameAnswer' => $request->nameAnswer,
        'questions_id' => $request->questions_id,
    ]);
    // On retourne les informations de la réponse modifiée en JSON
    return response()->json($answer, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
       // On supprime la réponse
       $answer->delete();
       return response()->json([
           'status' => 'Supprimer avec succès avec succèss']);
    }
}
