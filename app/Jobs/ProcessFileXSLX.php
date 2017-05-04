<?php

namespace App\Jobs;

use App\Models\Services\ProductService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ProcessFileXSLX
 * @package App\Jobs
 */
class ProcessFileXSLX implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var $filename string */
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
