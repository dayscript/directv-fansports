<?php

namespace App\Http\Controllers;

use App\Match;
use App\Prediction;
use App\Round;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Round matches
     * @param Round $round
     * @return array
     */
    public function roundmatches(Round $round)
    {
        $results = [];
        $results['round'] = $round;
        $matches = $round->matches;
        $results['matches'] = [];
        foreach ($matches as $match){
            $prediction = Prediction::firstOrCreate(['user_id'=>request()->user()->id,'match_id'=>$match->id]);
            $match->prediction = $prediction->value;
            $match->points = $prediction->points;
            $match->editable = request()->user()->can('update',$prediction);
            $results['matches'][] = $match;
        }
        $results['status'] = 'success';
        $results['message'] = 'Ronda cargada';

        return $results;
    }
    /**
     * Updates match prediction for current user
     * @param Match $match
     * @return array
     */
    public function updatePrediction(Match $match)
    {
        $results = [];
        $prediction = Prediction::firstOrCreate(['user_id'=>request()->user()->id,'match_id'=>$match->id]);
        if( ($value = request()->get('value')) && ($value != $prediction->value) ){
            if(request()->user()->can('update', $prediction)){
                $prediction->value = $value;
                $prediction->save();
                $results['status'] = 'success';
                $results['message'] = 'Predicción modificada';
            } else {
                $results['status'] = 'error';
                $results['message'] = 'No se ha podido actualizar';
            }
            $match->editable = request()->user()->can('update',$prediction);
            $match->prediction = $prediction->value;
            $match->points = $prediction->points;
        }
        $results['match'] = $match;
        return $results;
    }
}
