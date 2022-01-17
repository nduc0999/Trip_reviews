<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function Post()
    {
        return $this->hasMany(Post::class,'id_location');
    }

    public static function getCountPost(){
        $regionBac = Location::where('region', 'Miền Bắc')->get('id');
        $regionTrung = Location::where('region', 'Miền Trung')->get('id');
        $regionNam = Location::where('region', 'Miền Nam')->get('id');
        $bac = Post::whereIn('id_location', $regionBac)->get('id');
        $trung = Post::whereIn('id_location', $regionTrung)->get('id');
        $nam = Post::whereIn('id_location', $regionNam)->get('id');
        $arrCountPost = array();
        $arrCountPost['bac'] = $bac->count();
        $arrCountPost['trung'] = $trung->count();
        $arrCountPost['nam'] = $nam->count();
        return $arrCountPost;
    }
}
