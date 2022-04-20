<?php

namespace App\Services;

use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Libs\StringUtils;
use App\Models\Category;
use App\Models\Document;
use App\Models\Keyword;
use App\Models\User;
use Illuminate\Support\Str;

class DocumentManager
{

    public static function updateCategories(Document $document, array $categories)
    {
        $categories_id = [];

        foreach ($categories as $category) {
            $slug = Str::slug($category);

            $categories_id[] = Category::create([
                'name' => $categories,
                'slug' => $slug,
            ])->id;
        }

        foreach ($categories_id as $category_id) {
            $document = Document::find($document->id);
            $document->categories()->attach($category_id);
        }
    }

    public static function updateUser(Document $document, array $users)
    {
        $users_id = [];

        foreach ($users as $user) {
            $domain_mail = "@gmail.com";
            $password = \Hash::make('12345678');
            $email = strtolower(preg_replace('/\s/', '_', $user)) . $domain_mail;

            $check_email = User::where('email', $email)->first();

            if ($check_email) {
                $users_id[] = $check_email->id;
            } else {
                $users_id[] = User::create([
                    'name' => $user,
                    'email' => $email,
                    'password' => $password,
                ])->id;
            }
        }

        foreach ($users_id as $user_id) {
            $document = Document::find($document->id);
            $document->users()->attach($user_id);
        }
    }

    public static function updateContentFile(Document $document, string $content, bool $force = true)
    {
        if (!empty($document->content_file)) {
            if (!$force) return true;
            $path_info = $document->content_file;
            $new_file = false;
        } else {
            $disk = config('crawl.document_disk');
            $path = 'docs/' . IdToPath::make($document->id, 'txt');
            $path_info = new DiskPathInfo($disk, $path);
            $new_file = true;
        }

        if ($path_info->put($content)) {
            if ($new_file) {
                $document->content_file = $path_info;
                return $document->save();
            }
            return true;
        } else {
            \Log::error("Can't not update content for document [$document->id] : ");
            return false;
        }
    }

    public static function updateKeywords(Document $document, array $keywords)
    {
        $keywords_id = [];
        foreach ($keywords as $keyword) {
            if (mb_strlen($keyword) > 190 || empty($keyword)) continue;
            try {
                $entry = self::getKeyword($keyword);
                $id = $entry->id;
            } catch (\Exception) {
                continue;
            }
            if (in_array($id, $keywords_id)) continue;
            $keywords_id[] = $id;
        }
        //        $keywords_count = count($keywords_id);
        //        $document->update(['keywords_count' => $keywords_count]);
        $changed = $document->keywords()->sync($keywords_id);
        //        \DB::beginTransaction();
        //        if (count($changed['attached'])) {
        //            \DB::table('keywords')->whereIn('id', $changed['attached'])->increment('documents_count');
        //        }
        //        if (count($changed['detached'])) {
        //            \DB::table('keywords')->whereIn('id', $changed['detached'])->decrement('documents_count');
        //        }
        //        \DB::commit();

        return count($keywords_id);
    }

    /**
     * Find or create keyword from origin string
     *
     * @param string $string
     * @return Keyword
     */
    public static function getKeyword(string $string): Keyword
    {
        $content_hash = md5(StringUtils::normalize($string));

        return Keyword::firstOrCreate([
            'content_hash' => $content_hash,
        ], [
            'content' => StringUtils::trim($string),
            'length' => StringUtils::charactersCount($string),
        ]);
    }
}
