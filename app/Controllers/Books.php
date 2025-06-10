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
                'rules' => 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in' => 'Yang anda pilih bukan gambar dengan format jpg, jpeg, atau png.'
                ]
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/books/create')->withInput()->with('validation', $validation);
            return redirect()->to('/books/create')->withInput()->with('validation', \Config\Services::validation());

        }

        // Ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // Cek apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg'; // Gambar default jika tidak ada yang diupload
        } else {
            //nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // Cek apakah tidak ada gambar yang diupload
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->booksModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil ditambahkan.');

        return redirect()->to('/books');
    }
    public function delete($id)
    {
        $books = $this->booksModel->find($id);

        if ($books['sampul'] != 'no-cover.jpg') { // Cek apakah sampul bukan gambar default
            unlink('img/' . $books['sampul']); // Hapus gambar dari folder img
        }
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
                ],
            'sampul' => [
                'rules' => 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in' => 'Yang anda pilih bukan gambar dengan format jpg, jpeg, atau png.'
                ]
            ]
            ]
        ])) {
           return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        // Cek apakah gambar tidak diganti
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama'); // Gunakan sampul lama
        } else {
            // Cek apakah ada gambar yang diupload
            if ($this->request->getVar('sampulLama') != 'default.jpg') {
                unlink('img/' . $this->request->getVar('sampulLama')); // Hapus gambar lama
            }
            // Ganti dengan gambar baru
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);

            unlink('img/' . $this->request->getVar('sampulLama')); // Hapus gambar lama
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->booksModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil diubah.');
        return redirect()->to('/books');
    }
}