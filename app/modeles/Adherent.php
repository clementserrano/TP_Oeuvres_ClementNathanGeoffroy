<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;

class Adherent extends Model
{
    public function getAdherents()
    {
        $adherents = DB::table('Adherent')
            ->select()
            ->get();
        return $adherents;
    }
}
