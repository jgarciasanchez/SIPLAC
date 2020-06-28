<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests;
use Artisan;
use Log;
use Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Respaldo;


class BackupController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

    $backups = new Collection();
    foreach (config('backup.backup.destination.disks') as $disk_name) {
        $disk = Storage::disk($disk_name);
        $adapter = $disk->getDriver()->getAdapter();
        $files = $disk->allFiles();

      
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups
                ->push(new Respaldo(str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                  ((($disk->size($f)/1024)/1024)), $disk->lastModified($f),$f));
                
            }

        }

    }
          
        $this->backups = $this->paginates($backups);
        return view("Backups.index")->with(compact('backups'));
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run --only-db');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            return;
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return ;
        }
    }
   public function store()
    {
        try {
            // start the backup process
            Artisan::call('backup:run --only-db');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            return;
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return ;
        }
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file =  $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
           return back()->with('error','No se puede descargar el archivo en estos momentos');
        }
    }

    /**
     * Deletes a backup file.
     */
    public function destroy($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists($file_name)) {
            $disk->delete($file_name);
            return;
        } else {
          return;
        }
      }

    public function show(){}


    public function paginates($items, $perPage = 15, $page = null, $baseUrl = null, $options = [])
  {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

      $items = $items instanceof Collection ? $items : Collection::make($items);

      $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

      if ($baseUrl) {
          $lap->setPath($baseUrl);
      }

      return $lap;
  }

}
