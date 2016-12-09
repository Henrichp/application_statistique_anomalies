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
        $alldata = $this->afficherGraphique($cote);

        return view('cotes_graphiques')
            ->with('data',json_encode($alldata[0],JSON_NUMERIC_CHECK))
            ->with('moyenne',json_encode($alldata[1],JSON_NUMERIC_CHECK))
            ->with('sigma_sup',json_encode($alldata[2],JSON_NUMERIC_CHECK))
            ->with('sigma_inf',json_encode($alldata[3],JSON_NUMERIC_CHECK))
            ->with('categories',json_encode($alldata[4],JSON_NUMERIC_CHECK))
            ->with('cote',$cote);

    }

    public function boutGraphique($cote)
    {
        $cote = $cote;
        $alldata = $this->afficherGraphique($cote);

        return view('cotes_graphiques')
            ->with('data',json_encode($alldata[0],JSON_NUMERIC_CHECK))
            ->with('moyenne',json_encode($alldata[1],JSON_NUMERIC_CHECK))
            ->with('sigma_sup',json_encode($alldata[2],JSON_NUMERIC_CHECK))
            ->with('sigma_inf',json_encode($alldata[3],JSON_NUMERIC_CHECK))
            ->with('categories',json_encode($alldata[4],JSON_NUMERIC_CHECK))
            ->with('cote',$cote);

    }

    public function index()
    {

        //cote affiché par défaut
        $cote = "ABG";
        $alldata = $this->afficherGraphique($cote);

        return view('cotes_graphiques')
            ->with('data',json_encode($alldata[0],JSON_NUMERIC_CHECK))
            ->with('moyenne',json_encode($alldata[1],JSON_NUMERIC_CHECK))
            ->with('sigma_sup',json_encode($alldata[2],JSON_NUMERIC_CHECK))
            ->with('sigma_inf',json_encode($alldata[3],JSON_NUMERIC_CHECK))
            ->with('categories',json_encode($alldata[4],JSON_NUMERIC_CHECK))
            ->with('cote',$cote);

    }


    public function afficherGraphique($cote){

        $data = array();
        $moy = array();
        $categories = array();
        $sigma_sup = array();
        $sigma_inf = array();
        $alldata = array();

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

        }
        array_push($alldata, $data);
        array_push($alldata, $moy);
        array_push($alldata, $sigma_sup);
        array_push($alldata, $sigma_inf);
        array_push($alldata, $categories);

        return $alldata;

    }


}
