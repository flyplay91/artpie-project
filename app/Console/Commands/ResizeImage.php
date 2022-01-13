<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResizeImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResizeImage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function resizeImage($srcPath, $targetWidth)
    {
        if (!file_exists($srcPath) || is_dir($srcPath)) {
            Log::error(__FUNCTION__.': Invalid path: '.$srcPath);
            return false;
        }

        if (!$targetWidth) {
            return false;
        }

        // Read source file
        $image = \Image::make($srcPath);

        // Generate new filename
        $filename = pathinfo($srcPath, PATHINFO_FILENAME);
        $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
        $filenameResized = $filename . '_resized_'.$targetWidth.'x.'.$ext;
        $pathResized = pathinfo($srcPath, PATHINFO_DIRNAME).DIRECTORY_SEPARATOR.$filenameResized;

        // Resize to 400x
        $image->resize($targetWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image->save($pathResized);

        echo $srcPath . ' ==> '. $pathResized."\n";

        return true;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Loop a directory and read source files only and resize to 400x and 800x width
        $dir = public_path().'/images';
        $h = opendir($dir);

        // Delete files that were resized from older version
        while ($f = readdir($h)) {
            if ($f === '.' || $f === '..') {
                continue;
            }

            $path = $dir.'/'.$f;

            if (strpos($f, '_resized.') !== false || strpos($f, '_resized_') !== false) {
                unlink($path);
                echo "DELETED: ".$path."\n";
                continue;
            }
        }

        rewinddir();

        // Generate 400x and 800x images for all source images
        while ($f = readdir($h)) {
            if ($f === '.' || $f === '..') {
                continue;
            }

            $path = $dir.'/'.$f;

            // Resize to 400x and 800x
            $this->resizeImage($path, 400);
            $this->resizeImage($path, 800);
            $this->resizeImage($path, 2400);
        }

        if ($h) {
            closedir($h);
        }

        return 0;
    }
}
