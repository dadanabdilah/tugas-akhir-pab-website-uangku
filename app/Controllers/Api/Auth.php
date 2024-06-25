<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\HTTP\Response;

class Auth extends BaseController
{
    private $secretKey;

    public function __construct()
    {
        $this->secretKey = getenv('JWT_SECRET_KEY');
    }

    public function login()
    {
        $fields = [
            'email' => 'Masukkan email yang valid',
            'password' => 'Password tidak boleh kosong'
        ];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required'
            ];

            if (!$this->validate($rules)) {
                return $this->getResponse(
                    ['status' => 'failed', 'message' => $fields[array_keys($this->validator->getErrors())[0]]],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $email = $this->request->getVar('email');
            $password = md5($this->request->getVar('password'));

            $pengguna = $this->Pengguna->where('email', $email)->where('password', $password)->first();

            if (!$pengguna) {
                return $this->getResponse(
                    ['status' => 'failed', 'message' => 'Data anda tidak ditemukan'],
                    Response::HTTP_UNAUTHORIZED
                );
            }

            $payload = [
                'iat' => time(),
                'exp' => time() + 86400, // 86400 adalah 1 hari dalam detik (24 jam * 60 menit * 60 detik)
                'id'  => $pengguna->id,
                'pengguna' => $pengguna,
            ];

            $token = JWT::encode($payload, $this->secretKey, 'HS256');

            return $this->getResponse(
                ['status' => 'success', 'token' => $token, 'message' => 'Login successful']
            );
        }

        return $this->getResponse(
            ['status' => 'failed', 'message' => 'Invalid request method'],
            Response::HTTP_METHOD_NOT_ALLOWED
        );
    }

    public function daftar()
    {
        $fields = [
            'nama_pengguna' => 'Cek nama pengguna',
            'email' => 'cek email anda',
            'password' => 'Cek password anda',
        ];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_pengguna' => 'required',
                'email' => 'required|valid_email|is_unique[pengguna.email]',
                'password' => 'required|min_length[6]',
            ];

            if (!$this->validate($rules)) {
                return $this->getResponse(
                    [
                        'status' => 'failed',
                        'message' => $fields[array_keys($this->validator->getErrors())[0]]
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $data = [
                'nama_pengguna' => $this->request->getVar('nama_pengguna'),
                'email' => $this->request->getVar('email'),
                'password' => md5($this->request->getVar('password')),
                'jabatan' => 'Customer' // default role
            ];

            $this->Pengguna->insert($data);

            return $this->getResponse(
                ['status' => 'success', 'message' => 'Registrasi berhasil. Silahkan login.']
            );
        }

        return $this->getResponse(
            ['status' => 'failed', 'message' => 'Invalid request method'],
            Response::HTTP_METHOD_NOT_ALLOWED
        );
    }

    public function logout()
    {
        return $this->getResponse(
            ['status' => 'failed', 'message' => 'Logout successful. Discard the token.']
        );
    }

    private function getResponse(array $responseBody, int $code = Response::HTTP_OK)
    {
        return $this->response->setStatusCode($code)->setJSON($responseBody);
    }
}
