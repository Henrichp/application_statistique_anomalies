<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use DB;


class GraphiquesController extends Controller
{

    //Toutes les pages où l'on doit être connecté doivent implémenter le middleware auth.
    public function __construct()
    {
        $this->middleware('auth');
     }

    public function recherche(Request $request)
    {
        $cote = $request->cote;
        //print_r($cote);

        /*
        $userfound = User::where('id', '<>', $userme->id)
            ->Where(function ($query) use ($cote) {
                $query->where('nom', 'LIKE', '%' . $prenom . '%')
                    ->orWhere('email', 'LIKE', '%' . $prenom . '%')
                    ->orWhere('prenom', 'LIKE', '%' . $prenom . '%');
            })
            ->get();*/

        $data = array();
        $moy = array();
        $categories = array();
        $sigma_sup = array();
        $sigma_inf = array();

        /*$dataQuery = DB::table('bourse_stats.historique AS h')
            ->join ('bourse_stats.historique_stats AS h_stats', 'h_stats.s_cote', '=' , 'h.cote')
            ->select("h.jour","h.fermeture","h_stats.moyenne","h_stats.sigma")
            ->orderBy('h.jour')
            ->where('h.cote',$cote)
            ->whereraw("h_stats.s_jour <= h.jour")
            ->get();*/

        $dataQuery = DB::select("SELECT DISTINCT ON (h.jour) h.jour, h.fermeture, h_stats.moyenne, h_stats.sigma  
                                FROM bourse_stats.historique AS h
                                LEFT JOIN bourse_stats.historique_stats AS h_stats
                                ON h.jour>=h_stats.s_jour
                                WHERE h.cote = h_stats.s_cote
                                AND h.cote = '$cote'
                                ORDER BY h.jour DESC,h_stats.s_jour DESC;");


        foreach ($dataQuery as $key => $value){

            array_unshift($data , [$value->jour,$value->fermeture]);
            array_unshift($moy , [$value->jour,$value->moyenne]);
            array_unshift($sigma_sup , [$moy[0][1]+$value->sigma]);
            array_unshift($sigma_inf , [$moy[0][1]-$value->sigma]);
            array_unshift($categories , $value->jour);

            /*$data[$key] = [$value->jour,$value->fermeture];
            $moy[$key] = [$value->jour,$value->moyenne];
            $sigma_sup[$key] = [$moy[$key][1]+$value->sigma];
            $sigma_inf[$key] = [$moy[$key][1]-$value->sigma];
            $categories[$key] = $value->jour;*/
        }

        return view('cotes_graphiques')
            ->with('data',json_encode($data,JSON_NUMERIC_CHECK))
            ->with('categories',json_encode($categories,JSON_NUMERIC_CHECK))
            ->with('moyenne',json_encode($moy,JSON_NUMERIC_CHECK))
            ->with('sigma_sup',json_encode($sigma_sup,JSON_NUMERIC_CHECK))
            ->with('sigma_inf',json_encode($sigma_inf,JSON_NUMERIC_CHECK))
            ->with('cote',$cote);

    }


    public function index()
    {
        $data = array();
        $moy = array();
        $categories = array();
        $sigma_sup = array();
        $sigma_inf = array();

        //cote affiché par défaut
        $cote = 'A';

        $dataQuery = DB::table('bourse_stats.historique AS h')
            ->join ('bourse_stats.historique_stats AS h_stats', 'h_stats.s_cote', '=' , 'h.cote')
            ->select("h.jour","h.fermeture","h_stats.moyenne","h_stats.sigma")
            ->orderBy('h.jour')
            ->where('h.cote','A')
            ->get();

        foreach ($dataQuery as $key => $value){
            $data[$key] = [$value->jour,$value->fermeture];
            $moy[$key] = [$value->jour,$value->moyenne];
            $sigma_sup[$key] = [$moy[$key][1]+$value->sigma];
            $sigma_inf[$key] = [$moy[$key][1]-$value->sigma];
            $categories[$key] = $value->jour;
        }

        return view('cotes_graphiques')
            ->with('data',json_encode($data,JSON_NUMERIC_CHECK))
            ->with('categories',json_encode($categories,JSON_NUMERIC_CHECK))
            ->with('moyenne',json_encode($moy,JSON_NUMERIC_CHECK))
            ->with('sigma_sup',json_encode($sigma_sup,JSON_NUMERIC_CHECK))
            ->with('sigma_inf',json_encode($sigma_inf,JSON_NUMERIC_CHECK))
            ->with('cote',$cote);
    }




}
