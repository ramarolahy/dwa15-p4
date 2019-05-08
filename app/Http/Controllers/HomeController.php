<?php

namespace App\Http\Controllers;

use App\Poster;
use Illuminate\Http\Request;
use App\Http\Controllers\QuoteController;

class HomeController extends Controller
{

    /**
     * Method to GET the quotes route and display all posters from the db
     * @param int $posterId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home (int $posterId = null) {
        $QuoteController = new QuoteController();
        if ($posterId) {
            $poster = Poster::where ('id', '=', $posterId)->first ();
        }
        else {
            $poster = null;
        }
        $state = [
            'posters'  => $QuoteController->listPosters (),
            'poster'   => $poster,
        ];

        //dump($posters);
        return view ('pages.home', $state);
    }

    /**
     * Method to search for poster by author or keyword in quotes.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search (Request $request) {
        $validateData = $request->validate ([
                                                'filter'     => 'required',
                                                'searchTerm' => 'required',
                                            ]);
        $filter = $validateData['filter'];
        $searchTerm = htmlentities ($validateData['searchTerm']);
        $term = '%'.$searchTerm.'%';
        $posters = Poster::where ($filter, 'LIKE', $term)->get ();
        $state = [
            'posters' => $posters,
        ];
        return view ('pages.home', $state);
    }
}
