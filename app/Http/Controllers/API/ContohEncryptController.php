<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use SoareCostin\FileVault\Facades\FileVault;
use Illuminate\Support\Facades\Storage;
use App\Jobs\EncryptFile;
use App\Jobs\MoveFileToS3;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Helpers\ApiFormatter;

class ContohEncryptController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'isi' => 'required',
            ]);

            $file = $request->file('banner');

            // Get File Content
            $fileContent = $file->get();

            // Encrypt the Content
            $encryptedContent = encrypt($fileContent);

            $path = 'public/images/';

            // Store the encrypted Content
            $uploaded = Storage::put($path.'file.dat', $encryptedContent);

            $berita = Berita::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => Str::slug($request->judul),
                // 'banner' =>  $path.$image->hashName(),
            ]);

            $data = Berita::where('id', '=', $berita->id)->get();
            if ($data) {
                return ApiFormatter::createAPI(200, 'Success', $data);
            } else {
                return ApiFormatter::createAPI(400, 'Failed creating data.');
            }
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed updating data.');
        }
    }

    public function decrypt()
    {
        $encryptedContent = Storage::get('public/images/file.dat');
        $decryptedContent = decrypt($encryptedContent);

        return response()->streamDownload(function() use ($decryptedContent) {
            echo $decryptedContent;
        }, 'file.txt');
    }
}