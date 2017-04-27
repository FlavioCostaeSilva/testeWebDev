<?php

namespace App\Jobs;

use App\Models\Services\ProductService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessFileXSLX implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;

    /**
     * ProcessFileXSLX constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param ProductService $productService
     */
    public function handle(ProductService $productService)
    {
        $productService->processFileWithProducts($this->filename);
    }
}
