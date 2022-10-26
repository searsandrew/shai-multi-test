<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Storage;

use App\Models\Campaign;
use Spatie\Tags\Tag;

use Auth;

class ImportCSV
{
    use AsAction;

    public function handle($path)
    {
        $explodedPath = explode('/', $path);
        $campaign = Campaign::where('uuid', $explodedPath[1])->first();

        $headers = json_decode($campaign->organization->getMeta('firstRow'), true);
        $presets = json_decode($campaign->organization->getMeta('uploadPreset'), true);
        $preset = array_flip($presets);
        $tags = array_keys($presets, 'tag');

        $file = fopen(Storage::path($path), "r"); $i = 1;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            if($i != 1)
            {
                $recipient = $campaign->recipients()->create([
                    'ref_id' => $getData[$preset['ref_id']],
                    'internal_ref_slug' => array_key_exists('internal_ref_slug', $preset) ? $getData[$preset['internal_ref_slug']] : 'Not Applicable',
                    'family' => array_key_exists('family', $preset) ? $getData[$preset['family']] : 'Not Applicable',
                    'name' => $getData[$preset['name']],
                    'description' => array_key_exists('description', $preset) ? $getData[$preset['description']] : 'Not Applicable',
                ]);

                foreach ($tags as $tag)
                {
                    $tagWithType = Tag::findOrCreate(($getData[$tag] != '' ? $getData[$tag] : 'Non-disclosed'), $headers[$tag]);
                    $recipient->attachTag($tagWithType);
                }
            }
            $i++;
        }
    }
}
