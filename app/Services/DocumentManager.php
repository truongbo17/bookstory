<?php

namespace App\Services;

use App\Crawler\HandlePdf\PdfToImage;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Libs\PdfJsToImage;
use App\Libs\StringUtils;
use App\Libs\TitleToImage;
use App\Models\Category;
use App\Models\Document;
use App\Models\Keyword;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Support\Str;
use Log;
use Vuh\CliEcho\CliEcho;

class DocumentManager
{
    private static array $not_users = ['XML', 'HTML', 'PDF', 'Citations'];

    public static function savePdf(Document $document, string $download_link, bool $check_pdf_to_image = true)
    {
        $pdf_to_image = new PdfToImage();
        try {
            $path = $pdf_to_image->savePdf($document->id, $download_link);
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
            return false;
        }

        $document->download_link = $path;
        $document->save();

        if (getCountPagePdf($download_link) > config('crawl.max_pdf_count_page')) {
            if (is_null($document->count_page)) $document->count_page = getCountPagePdf($download_link);
            $img = new TitleToImage();
            $img->createImage($document->title);
            $document->image = $img->saveImage($document)->__toString();
        } else {
            self::pdfToImage($document, $pdf_to_image);
        }

        $document->save();
    }

    public static function pdfToImage(Document $document, $pdf_to_image)
    {
        $pdf_to_image = $pdf_to_image->saveImageFromPdf($document);

        $document->image = $pdf_to_image['image']->__toString();
        if (is_null($document->count_page)) $document->count_page = $pdf_to_image['count_page'];
    }

    public static function updateUser(Document $document, array $users)
    {
        $users_id = [];

        foreach ($users as $user) {
            //Not user
            if (in_array($user, self::$not_users)) continue;

            //User rác toàn là số thì bỏ đi
            $check_number = 0;
            for ($i = 0; $i < mb_strlen($user, 'UTF-8'); $i++) {
                if (is_numeric($user[$i])) ++$check_number;
            }
            if ($check_number > 8) continue;

            $domain_mail = "@gmail.com";

            $user_name = self::stripVN($user);

            $email = strtolower(preg_replace('/\s/', '_', $user_name)) . $domain_mail;
            $password = Hash::make($email . uniqid()); //random password

            $check_email = User::where('email', $email)->first();

            if ($check_email) {
                $users_id[] = $check_email->id;
            } else {
                $users_id[] = User::create(['name' => $user, 'email' => $email, 'password' => $password, 'is_crawl' => 1,])->id;
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
            $path = config('crawl.path.content_file') . '/' . IdToPath::make($document->id, 'txt');
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
            Log::error("Can't not update content for document [$document->id] : ");
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
            } catch (Exception) {
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

        return Keyword::firstOrCreate(['content_hash' => $content_hash,], ['content' => StringUtils::trim($string), 'length' => StringUtils::charactersCount($string),]);
    }

    public static function stripVN(string $str): string
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
}
