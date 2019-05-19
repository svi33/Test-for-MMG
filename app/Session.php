<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Jenssegers\Agent\Agent;

class Session extends Model
{
    public static function getUserAgents(){

        $getData = self::select('user_agent')->get()->toArray();
        $agent = new Agent();
        $array = array();
        foreach($getData as &$s){
            $agent->setUserAgent($s['user_agent']);
            $s['browser'] = $agent->browser();
            if(key_exists($s['browser'], $array)){
                $array[$s['browser']]++;
            }else{
                $array[$s['browser']] = 1;
            }
        }
        $result = '';
        foreach($array as $key=>$a){
            $result.=$key.': '. $a.', ';
        }
          $result = rtrim($result, ', ');
          return $result;

    }

}
