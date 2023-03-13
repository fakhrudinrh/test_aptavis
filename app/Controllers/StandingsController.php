<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StandingsModel;

class StandingsController extends BaseController
{
    protected $standingsModel;

    public function __construct()
    {
        $this->standingsModel = new StandingsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Standings Liga 1 Indonesia'
        ];

        return view('index', $data);
    }

    public function fetch()
    {
        $standings = $this->standingsModel->join('clubs', 'clubs.club_id = standings.club_id')
            ->orderBy("points", "DESC")->findAll();
        $data = [
            'response' => 'success',
            'standings' => $standings
        ];

        return $this->response->setJSON($data);
    }

    private function updateStandings($homeClubId, $awayClubId, $homeScore, $awayScore)
    {
        foreach (array_keys($homeClubId) as $key) {
            $standingsHome = $this->standingsModel->where('club_id', $homeClubId[$key])->first();
            $standingsAway = $this->standingsModel->where('club_id', $awayClubId[$key])->first();
            if ($homeScore[$key] == $awayScore[$key]) {
                $homePoints = 1;
                $homeWon = 0;
                $homeDraw = 1;
                $homeLost = 0;
                $awayPoints = 1;
                $awayWon = 0;
                $awayDraw = 1;
                $awayLost = 0;
            } elseif ($homeScore[$key] > $awayScore[$key]) {
                $homePoints = 3;
                $homeWon = 1;
                $homeDraw = 0;
                $homeLost = 0;
                $awayPoints = 0;
                $awayWon = 0;
                $awayDraw = 0;
                $awayLost = 1;
            } else {
                $homePoints = 0;
                $homeWon = 0;
                $homeDraw = 0;
                $homeLost = 1;
                $awayPoints = 3;
                $awayWon = 1;
                $awayDraw = 0;
                $awayLost = 0;
            }

            $data = [
                [
                    'club_id'       => $homeClubId[$key],
                    'played'        => $standingsHome['played'] + 1,
                    'won'           => $standingsHome['won'] + $homeWon,
                    'draw'          => $standingsHome['draw'] + $homeDraw,
                    'lost'          => $standingsHome['lost'] + $homeLost,
                    'goals_for'     => $standingsHome['goals_for'] + $homeScore[$key],
                    'goals_againts' => $standingsHome['goals_againts'] + $awayScore[$key],
                    'points'        => $standingsHome['points'] + $homePoints
                ], [
                    'club_id'       => $awayClubId[$key],
                    'played'        => $standingsAway['played'] + 1,
                    'won'           => $standingsAway['won'] + $awayWon,
                    'draw'          => $standingsAway['draw'] + $awayDraw,
                    'lost'          => $standingsAway['lost'] + $awayLost,
                    'goals_for'     => $standingsAway['goals_for'] + $awayScore[$key],
                    'goals_againts' => $standingsAway['goals_againts'] + $homeScore[$key],
                    'points'        => $standingsAway['points'] + $awayPoints
                ]
            ];
            $this->standingsModel->updateBatch($data, 'club_id');
        }
    }

    private function validationMatch($homeClubId, $awayClubId)
    {
        $sameHomeAway = false;
        $sameMatch = false;

        foreach (array_keys($homeClubId) as $key) {
            $currentMatch = [$homeClubId[$key], $awayClubId[$key]];
            if ($homeClubId[$key] == $awayClubId[$key]) {
                $sameHomeAway = true;
                break;
            }
            for ($i = $key + 1; $i < count($homeClubId); $i++) {
                $nextMatch = [$homeClubId[$i], $awayClubId[$i]];
                if ($currentMatch == $nextMatch) {
                    $sameMatch = true;
                    break 2;
                }
            }
        }

        if ($sameHomeAway) {
            $response = [
                'message' => "error"
            ];
        } else {
            if ($sameMatch) {
                $response = [
                    'message' => "error"
                ];
            } else {
                $response = [
                    'message' => "success"
                ];
            }
        }

        return $response;
    }

    public function create()
    {
        $homeClubId = $this->request->getVar('homeSelect');
        $awayClubId = $this->request->getVar('awaySelect');
        $homeScore = $this->request->getVar('homeScore');
        $awayScore = $this->request->getVar('awayScore');

        $response = $this->validationMatch($homeClubId, $awayClubId);
        if ($response['message'] == "success") {
            $this->updateStandings($homeClubId, $awayClubId, $homeScore, $awayScore);
        }

        return $this->response->setJSON($response);
    }
}
