<?php

namespace App\Controllers;
use App\Models\BooksModel;

class Books extends BaseController
{
    protected $booksModel;
    public function __construct()
    {
        $this->booksModel = new BooksModel();
    }
    public function index()
    {

        $books = $this->booksModel->getBooks();

        $data = [
            'title' => 'Daftar Buku',
            'books' => $this->booksModel->findAll(),
        ];

        return view('books/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Buku',
            'books' => $this->booksModel->getBooks($slug)
        ];

        if (empty($data['books'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul buku ' . $slug . ' tidak ditemukan.');
        }
        return view('books/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Buku',
            'validation' => session()->getFlashdata('validation'),
        ];
        return view('books/create', $data);
    }
    public function save()
    {

        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[books.judul]',
                'errors' => [
                    'required' => '{field} buku harus diisi.',
                    'is_unique' => '{field} buku sudah terdaftar.'
                ]
                ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
                ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
                ],
            'sampul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ]

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/books/create')->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->booksModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil ditambahkan.');

        return redirect()->to('/books');
    }
    public function delete($id)
    {
        $this->booksModel->delete($id);
        session()->setFlashdata('pesan', 'Data buku berhasil dihapus.');
        return redirect()->to('/books');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Buku',
            'validation' => session()->getFlashdata('validation'),
            'books' => $this->booksModel->getBooks($slug)
        ];

        if (empty($data['books'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul buku ' . $slug . ' tidak ditemukan.');
        }
        return view('books/edit', $data);
    }
    public function update($id)
    {
        $booksLama = $this->booksModel->getBooks($this->request->getVar('slug'));
        if ($booksLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[books.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus diisi.',
                    'is_unique' => '{field} buku sudah terdaftar.'
                ]
            ]
        ])) {
           return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', \Config\Services::validation());
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->booksModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil diubah.');
        return redirect()->to('/books');
    }
}