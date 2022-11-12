<?php

namespace App\Components\Api\Services;

use Illuminate\Http\JsonResponse;

class ApiResponseService
{
    private mixed $data = [];
    private int $status = 200;
    private array $headers = [];
    private int $options = 0;

    public function json(): JsonResponse {
        return response()->json($this->data, $this->status, $this->headers, $this->options);
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
