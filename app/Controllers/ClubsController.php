<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClubsModel;
use App\Models\StandingsModel;

class ClubsController extends BaseController
{
    protected $clubsModel;
    protected $standingsModel;

    public function __construct()
    {
        $this->clubsModel = new ClubsModel();
        $this->standingsModel = new StandingsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Clubs Liga 1 Indonesia',
        ];

        return view('clubs', $data);
    }

    public function fetch()
    {
        $clubs = $this->clubsModel->findAll();
        $response = [
            'messages' => 'success',
            'clubs' => $clubs
        ];

        return $this->response->setJSON($response);
    }

    public function create()
    {
        $validationRules      = [
            'clubName' => 'required|is_unique[clubs.club_name]',
            'clubCity' => 'required'
        ];
        $validationMessages   = [
            'clubName' => [
                'required'  => 'Club name cannot be empty',
                'is_unique' => 'Club name already exists'
            ],
            'clubCity' => [
                'required'  => 'Club city cannot be empty'
            ]
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            $response = [
                'message'     => "error",
                'validation'  => $this->validator->getErrors()
            ];
        } else {
            $data = [
                'club_name' => $this->request->getVar("clubName"),
                'club_city' => $this->request->getVar("clubCity"),
            ];
            $this->clubsModel->save($data);
            $id = $this->clubsModel->getInsertID();
            $this->standingsModel->insert(['club_id' => $id]);

            $response = [
                'message' => "success"
            ];
        }

        return $this->response->setJSON($response);
    }

    public function readById($id)
    {
        $data['clubs'] = $this->clubsModel->find($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = $this->clubsModel->find($id);
        if ($data['club_name'] == $this->request->getVar("clubName")) {
            $rule_clubName = 'required';
        } else {
            $rule_clubName = 'required|is_unique[clubs.club_name]';
        }

        $validationRules      = [
            'clubName' => $rule_clubName,
            'clubCity' => 'required'
        ];
        $validationMessages   = [
            'clubName' => [
                'required'  => 'Club name cannot be empty',
                'is_unique' => 'Club name already exists'
            ],
            'clubCity' => [
                'required'  => 'Club city cannot be empty'
            ]
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            $response = [
                'message'     => "error",
                'validation'  => $this->validator->getErrors()
            ];
        } else {
            $data = [
                'club_id' => $id,
                'club_name' => $this->request->getVar("clubName"),
                'club_city' => $this->request->getVar("clubCity"),
            ];
            $this->clubsModel->save($data);

            $response = [
                'message' => "success"
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $this->clubsModel->delete($id);
        $data = [
            'message' => 'success'
        ];

        return $this->response->setJSON($data);
    }
}
