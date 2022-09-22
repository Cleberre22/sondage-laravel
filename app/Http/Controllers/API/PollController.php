<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les sondages
$polls = Poll::all();
// On retourne les informations des sondages en JSON
return response()->json($polls);
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
            'nameSondage' => 'required|max:100',
            ]);
            // On crée un nouveau sondage
            $poll = Poll::create([
            'nameSondage' => $request->nameSondage,
            ]);
            // On retourne les informations du nouveau sondage en JSON
            return response()->json([
            'status' => 'Success',
            'data' => $poll,
            ]);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        // On retourne les informations du sondage en JSON
return response()->json($poll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $this->validate($request, [
            'nameSondage' => 'required|max:100',
            ]);
            // On modifie le sondage
            $poll->update([
            'nameSondage' => $request->nameSondage,
            ]);
            // On retourne les informations du sondage modifié en JSON
            return response()->json([
            'status' => 'Mise à jour avec succèss']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        // On supprime le sondage
$poll->delete();
// On retourne la réponse JSON
return response()->json([
'status' => 'Supprimer avec succès avec succèss']);
    }
}
