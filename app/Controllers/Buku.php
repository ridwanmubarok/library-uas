<?php
namespace App\Controllers;

use App\Models\Book;
use App\Validation\BookValidation;
use App\Libraries\FileUploader;
use CodeIgniter\Controller;

class Buku extends Controller
{
    protected $helpers = ['form'];
public function index()
{
    $model = new Book();
    $keyword = $this->request->getGet('keyword');
    $perPage = 3;

    if ($keyword) {
        $buku = $model->like('title', $keyword)->orLike('author', $keyword)->paginate($perPage, 'buku');
    } else {
        $buku = $model->paginate($perPage, 'buku');
    }

    return view('buku/index', [
        'buku' => $buku,
        'pager' => $model->pager,
        'keyword' => $keyword,
    ]);
}

    public function detail($id)
    {
        $model = new Book();
        $buku = $model->find($id);
        if (!$buku)
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Buku tidak ditemukan');
        return view('buku/detail', ['buku' => $buku]);
    }

    public function create()
    {
        return view('buku/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules(BookValidation::getCreateRules(), BookValidation::getMessages());
        
        if (!$validation->withRequest($this->request)->run()) {
            return view('buku/create', ['validation' => $validation]);
        }

        $model = new Book();
        $data = $this->prepareBookData();
        
        if ($model->save($data)) {
            return redirect()->to('/buku')->with('toast', 'Buku berhasil ditambahkan!');
        }
        
        return redirect()->back()->with('toast', 'Gagal menambahkan buku!');
    }

    public function edit($id)
    {
        $model = new Book();
        $buku = $model->find($id);
        if (!$buku)
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Buku tidak ditemukan');
        return view('buku/edit', ['buku' => $buku]);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules(BookValidation::getUpdateRules(), BookValidation::getMessages());

        if (!$validation->withRequest($this->request)->run()) {
            $model = new Book();
            $buku = $model->find($id);
            return view('buku/edit', ['buku' => $buku, 'validation' => $validation]);
        }

        $model = new Book();
        $data = $this->prepareBookData();
        
        if ($model->update($id, $data)) {
            return redirect()->to('/buku')->with('toast', 'Buku berhasil diupdate!');
        }
        
        return redirect()->back()->with('toast', 'Gagal mengupdate buku!');
    }

    public function delete($id)
    {
        $model = new Book();
        
        if (!$model->find($id)) {
            return redirect()->to('/buku')->with('toast', 'Buku tidak ditemukan!');
        }
        
        if ($model->delete($id)) {
            return redirect()->to('/buku')->with('toast', 'Buku berhasil dihapus!');
        }
        
        return redirect()->to('/buku')->with('toast', 'Gagal menghapus buku!');
    }
    
    private function prepareBookData(): array
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'year' => $this->request->getPost('year') ?: null,
            'description' => $this->request->getPost('description'),
        ];
        
        $cover = $this->request->getFile('cover');
        if ($cover && $cover->isValid()) {
            $uploader = new FileUploader();
            $fileName = $uploader->upload($cover);
            if ($fileName) {
                $data['cover'] = $fileName;
            }
        }
        
        return $data;
    }
}