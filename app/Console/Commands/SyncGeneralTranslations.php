<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class SyncGeneralTranslations extends Command
{
    protected $signature = 'translations:sync-general';
    protected $description = 'Sync general translations for en, ar, fr locales';

    protected $locales = ['en', 'ar'];
    protected $translationFile = 'general.php';

    public function handle()
    {
        $files = new Filesystem();
        $allKeys = [];
    
        // Scan resources/views + app for __('general.xxx') & @lang('general.xxx')
        $paths = [resource_path('views'), app_path()];
    
        foreach ($paths as $path) {
            foreach ($files->allFiles($path) as $file) {
                $contents = $files->get($file->getPathname());
    
                preg_match_all("/__\(['\"]general\.([a-zA-Z0-9_]+)['\"]\)/", $contents, $matches1);
                preg_match_all("/@lang\(['\"]general\.([a-zA-Z0-9_]+)['\"]\)/", $contents, $matches2);
    
                $allKeys = array_merge($allKeys, $matches1[1], $matches2[1]);
            }
        }
    
        $allKeys = array_unique($allKeys);
    
        foreach ($this->locales as $locale) {
            $path = lang_path("$locale/{$this->translationFile}");
    
            if (!$files->exists($path)) {
                $files->put($path, "<?php\n\nreturn [\n\n];\n");
            }
    
            $translations = include $path;
    
            if (!is_array($translations)) {
                $this->error("Invalid translation file: $path");
                continue;
            }
    
            $newKeys = [];
            foreach ($allKeys as $key) {
                if (!array_key_exists($key, $translations)) {
                    $translations[$key] = '';
                    $newKeys[$key] = '';
                }
            }
    
            // لو مفيش جديد خلاص
            if (empty($newKeys)) {
                $this->info("No new keys for $locale");
                continue;
            }
    
            // اقرأ الملف الأصلي زي ما هو
            $content = trim($files->get($path));
            $content = preg_replace('/\];$/', '', $content); // شيل آخر ]
    
            // أضف الجديد
            $content .= "\n    // New keys added on " . now()->toDateTimeString() . "\n";
            foreach ($newKeys as $k => $v) {
                $content .= "    '$k' => '',\n";
            }
    
            $content .= "];\n";
    
            $files->put($path, $content);
    
            $this->info("Added " . count($newKeys) . " new keys to: $path");
        }
    
        $this->info("Translations synced successfully!");
    }
    
}