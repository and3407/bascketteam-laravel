<?php

namespace App\Components\Api\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiResponseService
{
    private mixed $data = [];
    private int $status = 200;
    private array $headers = [];
    private int $options = 0;

    public function ok(): JsonResponse {
        return response()->json($this->data, Response::HTTP_OK, $this->headers, $this->options);
    }

    public function notFound(): JsonResponse {
        return response()->json($this->data, Response::HTTP_NOT_FOUND, $this->headers, $this->options);
    }

    public function json(): JsonResponse {
        return response()->json($this->data, $this->status, $this->headers, $this->options);
    }

    public function badRequest(): JsonResponse {
        return response()->json($this->data, Response::HTTP_BAD_REQUEST, $this->headers, $this->options);
    }

    public function setMessage(string $message): self
    {
        $this->data = ['message' => $message];

        return $this;
    }

    public function setData(mixed $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function setOptions(int $options): self
    {
        $this->options = $options;

        return $this;
    }


}
