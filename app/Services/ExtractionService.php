<?php

namespace App\Services;

use App\Models\Extraction;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

/**
 * Class ExtractionService.
 */
class ExtractionService
{
    use FileTrait;
    public function __construct(protected Extraction $extraction) {
    }
    public function extract(array $data): Extraction
    {
        $image_url = $this->loadFile($this->uploadFile('extract',$data['image']));
        $textDataJson = Http::get("https://api.ocr.space/parse/imageurl?apikey=helloworld&url=$image_url");

        $textData = json_decode($textDataJson);
        $extracted_text = $textData->ParsedResults[0]->ParsedText;

        $extraction = $this->extraction->create(compact('image_url','extracted_text'));
        return $extraction;
    }

    public function login(array $data) : bool
    {
        return auth()->attempt($data);
    }

}
