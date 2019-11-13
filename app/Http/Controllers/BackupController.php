<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $this->humanFilesize($disk->size($f)),
                    'last_modified' => $this->getDate($disk->lastModified($f)), //formatTimeStamp //diffTimeStamp
                ];
            }
        }
        $backups = array_reverse($backups);
        //dump($backups);
        return view("admin.backup.index",compact('backups'));
    }

    public function create()
    {
        try {
            //shell_exec('php artisan backup:run');
            Artisan::call('backup:run',['--only-db'=>true]);
            $output = Artisan::output();
            Log::info("Backpack\BackupManager Backup creado satisfactoriamente \r\n" . $output);
            return redirect()->back()->withFlash('Backup creado satisfactoriamente');

        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withFlash('Error al crear el backup');
        }
    }

    public function show($file_name) //download
    {
        ob_end_clean();
        $file = config('laravel-backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "El archivo backup no existe.");
        }
    }

    public function destroy($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "El archivo backup no existe.");
        }
    }

    function humanFilesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }
        return round($size, $precision).$units[$i];
    }

    function getDate($date_modify) {
        return Carbon::createFromTimestamp($date_modify)->formatLocalized('%d %B %Y %H:%M');
    }
}