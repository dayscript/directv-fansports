<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['opta_id','name'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at','when'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['localId','visitId'];
    /**
     * Round relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roundId()
    {
        return $this->belongsTo(Round::class,'round_id');
    }
    /**
     * Round relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function round()
    {
        return $this->roundId;
    }

    /**
     * Local team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function local()
    {
        return $this->localId;
    }
    /**
     * Visit team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visit()
    {
        return $this->visitId;
    }
    /**
     * Local team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function localId()
    {
        return $this->belongsTo(Team::class,'local_id');
    }
    /**
     * Visitor team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitId()
    {
        return $this->belongsTo(Team::class,'visit_id');
    }

    /**
     * Returns all predictions for this match
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    /**
     * Calculates user points
     */
    public function calculatePoints()
    {
//        $points = Voyager::setting('winner_points');
        if( !is_null($this->local_score) && !is_null($this->visit_score)){
            if($this->local_score > $this->visit_score)$result = 'local';
            elseif($this->local_score < $this->visit_score)$result = 'visit';
            else $result = 'draw';
        } else {
            $result = 'undefined';
        }
        foreach ($this->predictions as $prediction){
//            if ($code = Code::where('round_id',$this->roundId->id)->where('user_id',auth()->user()->id)->first()){
//                $points = 2*$points;
//            }
            if($this->roundId->special){
                $points = 3*Voyager::setting('winner_points');
            } else {
                $points = Voyager::setting('winner_points');
            }
            if($result == $prediction->value && $this->status != 'pending'){
                $prediction->points = $points;
            } else {
                $prediction->points = 0;
            }
            $prediction->save();
        }
        $users = User::all();
        foreach ($users as $user){
            $user->updatePoints();
        }
    }

    /**
     * Updates from opta services
     */
    public function updateOptaData()
    {
        $client = new Client();
        $url = 'https://winsports.dayscript.com/matches/'.$this->opta_id.'/summary';
        $res     = $client->get($url);
        $content = $res->getBody();
        $json_content = json_decode($content);
        if($json_content->period == 'PreMatch' || $json_content->period == 'Postponed'){
            $this->status = 'pending';
        } else if($json_content->period == 'FullTime'){
            $this->status = 'finished';
        } else {
            $this->status = 'playing';
        }
        $team = Team::firstOrCreate(['name'=>$json_content->home->name]);
        $this->localId()->associate($team);
        if(!$team->image){
            $url = 'http://images.akamai.opta.net/football/team/badges_150/'. $json_content->home->id.'.png';
            Storage::disk('public')->put('teams/'.$team->id.'/'.str_slug($team->name).'.png',file_get_contents($url));
            $team->image = 'teams/'.$team->id.'/'.str_slug($team->name).'.png';
            $img = Image::make(public_path('storage/'.$team->image));
            $img->widen(150,function ($constraint) {
                $constraint->upsize();
            })->widen(75)->save(public_path('storage/teams/'.$team->id.'/'.str_slug($team->name).'-medium.png'))
                ->widen(38)->save(public_path('storage/teams/'.$team->id.'/'.str_slug($team->name).'-small.png'));
            $team->save();
        }
        $team = Team::firstOrCreate(['name'=>$json_content->away->name]);
        $this->visitId()->associate($team);
        if(!$team->image){
            $url = 'http://images.akamai.opta.net/football/team/badges_150/'. $json_content->away->id.'.png';
            Storage::disk('public')->put('teams/'.$team->id.'/'.str_slug($team->name).'.png',file_get_contents($url));
            $team->image = 'teams/'.$team->id.'/'.str_slug($team->name).'.png';
            $img = Image::make(public_path('storage/'.$team->image));
            $img->widen(150,function ($constraint) {
                $constraint->upsize();
            })->widen(75)->save(public_path('storage/teams/'.$team->id.'/'.str_slug($team->name).'-medium.png'))
                ->widen(38)->save(public_path('storage/teams/'.$team->id.'/'.str_slug($team->name).'-small.png'));
            $team->save();
        }
        if($this->when != $json_content->date)$this->when = $json_content->date;
        $local_score = $json_content->home->score;
        $visit_score = $json_content->away->score;
        if($local_score !== $this->local_score || $visit_score !== $this->visit_score){
            $this->local_score = $local_score;
            $this->visit_score = $visit_score;
            $this->calculatePoints();
        }
        $this->save();
    }
}
