<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Post;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class PostController extends BaseController
{
    use ResponseTrait;

    private Post $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    /**
     * @return ResponseInterface
     */
    public function index(): ResponseInterface
    {
        $perPage = $this->request->getVar('perPage') ?? null;
        $page = $this->request->getVar('page') ?? null;

        $response = [
            'data' => $this->model->paginate($perPage, 'default', $page)
        ];

        if (!is_null($perPage)) $response['pager'] = $this->model->pager->getDetails();

        return $this->respond($response);
    }

    /**
     * @return ResponseInterface
     */
    public function create(): ResponseInterface
    {
        $rules = [
            'title' => 'required|max_length[255]|is_unique[posts.title]',
            'content' => 'required',
            'author' => 'required|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $data = json_decode($this->request->getBody());
            $id = $this->model->insert($data);

            return $this->respondCreated([
                'message' => 'Post successfully created',
                'data' => $this->model->find($id)
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Something went wrong. Please try again.');
        }
    }

    /**
     * @param int $id
     * @return ResponseInterface
     */
    public function show(int $id): ResponseInterface
    {
        $post = $this->model->find($id);

        if(is_null($post)) return $this->failNotFound('Resource not found');

        return $this->respond($post);
    }

    /**
     * @param int $id
     * @return ResponseInterface
     */
    public function update(int $id): ResponseInterface
    {
        $rules = [
            'title' => 'required|max_length[255]|is_unique[posts.title,id,'.$id.']',
            'content' => 'required',
            'author' => 'required|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $data = json_decode($this->request->getBody());
            $id = $this->model->update($id, $data);

            return $this->respondCreated([
                'message' => 'Post successfully updated',
                'data' => $this->model->find($id)
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Something went wrong. Please try again.');
        }

    }

    /**
     * @param int $id
     * @return ResponseInterface
     */
    public function delete(int $id): ResponseInterface
    {
        try {
            $this->model->find($id);
            $this->model->delete($id);
            return $this->respondDeleted(['message' => 'Post successfully deleted.']);
        } catch (\Exception $e) {
            return $this->failServerError('Something went wrong. Please try again.');
        }
    }
}
