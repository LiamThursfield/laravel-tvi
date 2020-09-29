<?php

namespace App\Actions\FileManager;


use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManagerFileStoreAction
{
    /** @var string The file system disk to use for Directory management */
    protected $storage_disk;


    /**
     * FileManagerFileStoreAction constructor.
     * @param $storage_disk
     */
    public function __construct($storage_disk)
    {
        $this->storage_disk = $storage_disk;
    }

    /**
     * @param string $directory
     * @param UploadedFile $file
     * @return false|string
     */
    public function handle(string $directory, UploadedFile $file)
    {
        $directory = $this->formatDirectory($directory);
        $filename = $this->getFileName($directory, $file);

        return $file->storeAs($directory, $filename, $this->storage_disk);
    }

    /**
     * @param string $directory
     * @return string
     */
    public function formatDirectory(string $directory)
    {
        if (!Str::startsWith($directory, '/')) {
            $directory = "/" . $directory;
        }

        if (!Str::endsWith($directory, '/')) {
            $directory .= '/';
        }

        return $directory;
    }

    /**
     * @param String $directory
     * @param UploadedFile $file
     * @return string
     */
    public function getFileName(String $directory, UploadedFile $file)
    {
        $formatted_filename = $file->getClientOriginalName();

        // Slugify the name
        $formatted_filename = explode('.', $formatted_filename);
        foreach ($formatted_filename as $index => $part) {
            $formatted_filename[$index] = Str::slug($part);
        }
        $formatted_filename = implode('.', $formatted_filename);

        // If the file already exists, add a timestamp
        if (Storage::disk($this->storage_disk)->exists($directory . $formatted_filename)) {
            $formatted_filename = Carbon::now()->timestamp . '-'. $formatted_filename;
        }

        return $formatted_filename;
    }
}
