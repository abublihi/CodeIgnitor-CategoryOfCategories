<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category as CategoryModel;

class Category extends BaseController
{
    public function index()
    {
        return view('category/create');
    }

    public function store() 
    {
        $validation = $this->validate([
            'name' => 'required',
        ]);

        if (!$validation) {
            return redirect()
                ->to('/category')
                ->withInput()
                ->with('validation', $this->validator);
        }

        $data = [
            'parent_id' => $this->request->getPost('parent_id')?: null,
            'name' => $this->request->getPost('name'),
        ];

        $category = new CategoryModel;
        $category->insert($data);

        return redirect()->to('/category')->with('msg', 'Category Added');

    }

    public function selector() {
        $categoryModel = new CategoryModel;        
        $parentCategories = $categoryModel
            ->where('parent_id', null)
            ->get()
            ->getResult();

        return view('category/selector', [
            'parentCategories' => $parentCategories,
        ]);
    }

    public function get($id) {
        $categoryModel = new CategoryModel;
        $results = $categoryModel
            ->where('parent_id', $id)
            ->get()
            ->getResult();
        return $this->response
            ->setContentType('application/json')
            ->setJSON(json_encode($results));
        // return $categoryModel
        //     ->where('parent_id', $id)
        //     ->get()
        //     ->getResult('array');
    }
}
