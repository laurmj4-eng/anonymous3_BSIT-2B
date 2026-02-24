<?php

namespace App\Controllers;

use App\Models\SubjectModel;
use App\Models\LogModel;
use CodeIgniter\Controller;

class Subject extends Controller
{
    public function index(){
        return view('subject/index');
    }

    public function save(){
        $model = new SubjectModel();
        $logModel = new LogModel();

        $data = [
            'name'        => $this->request->getPost('name'),
            'code'        => $this->request->getPost('code'),
            'description' => $this->request->getPost('description'),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        if ($model->insert($data)) {
            // Safety wrapper around the log so it doesn't crash the save
            try { $logModel->addLog('Added new subject: ' . $data['name'], 'ADD'); } catch (\Exception $e) {}
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save subject']);
        }
    }

    public function edit($id){
        $model = new SubjectModel();
        $subject = $model->find($id);

        if ($subject) {
            return $this->response->setJSON(['data' => $subject]);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Subject not found']);
        }
    }

    public function update(){
        $model = new SubjectModel();
        $logModel = new LogModel();
        
        $id = $this->request->getPost('id');

        if (empty($id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: Subject ID is missing.']);
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'code'        => $this->request->getPost('code'),
            'description' => $this->request->getPost('description'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        $updated = $model->set($data)->where('id', $id)->update();

        if ($updated) {
            try { $logModel->addLog('Updated subject: ' . $data['name'], 'UPDATED'); } catch (\Exception $e) {}
            return $this->response->setJSON(['success' => true, 'message' => 'Subject updated successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error updating subject. No changes were made.']);
        }
    }

    public function delete($id){
        $model = new SubjectModel();
        $logModel = new LogModel();
        $subject = $model->find($id);

        if (!$subject) {
            return $this->response->setJSON(['success' => false, 'message' => 'Subject not found.']);
        }

        if ($model->delete($id)) {
            try { $logModel->addLog('Deleted subject: ' . $subject['name'], 'DELETED'); } catch (\Exception $e) {}
            return $this->response->setJSON(['success' => true, 'message' => 'Subject deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete subject.']);
        }
    }

    public function fetchRecords()
    {
        $request = service('request');
        $model = new SubjectModel();

        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 10;
        
        // Fixed the search array warning so your table actually loads!
        $search = $request->getPost('search');
        $searchValue = isset($search['value']) ? $search['value'] : '';

        // Added where('deleted_at IS NULL') so deleted subjects don't count
        $totalRecords = $model->where('deleted_at IS NULL')->countAllResults();
        $result = $model->getRecords($start, $length, $searchValue);

        $data = [];
        $counter = $start + 1;
        foreach ($result['data'] as $row) {
            $row['row_number'] = $counter++;
            $data[] = $row;
        }

        return $this->response->setJSON([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $result['filtered'],
            'data' => $data,
        ]);
    }
}