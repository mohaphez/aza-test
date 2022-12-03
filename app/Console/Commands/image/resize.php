<?php

namespace App\Console\Commands\image;

use App\Service\Image\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class resize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:resize {--width=100} {--height=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize images to custom width and height';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Image $image)
    {
        $width = $this->option('width');
        $height = $this->option('height');

        $basepath = storage_path('app/public/');
        $targetFolder = $basepath . "images/" . $width . "X" . $height . "/";
        $this->checkDirectory($targetFolder);

        $images  = Storage::disk('public')->files('images/main');
        foreach ($images as $item) {
            $target_file = $targetFolder . time() . "_" . basename($item);
            $image->load($basepath . $item)
                ->resize($width, $height)
                ->save($target_file);
        }

        $this->info("All images resized successfully");
        return Command::SUCCESS;
    }


    private function checkDirectory($directory)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
    }
}
