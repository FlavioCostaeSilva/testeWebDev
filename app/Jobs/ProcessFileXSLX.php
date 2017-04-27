<?php

namespace App\Jobs;

use App\Models\Services\ProductService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

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

    public function handle()
    {
        $productService = new ProductService();
        $productService->processFileWithProducts($this->filename);
    }
}
