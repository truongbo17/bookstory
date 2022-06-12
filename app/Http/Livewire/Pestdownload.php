<?php

namespace App\Http\Livewire;

use App\Crawler\Browsers\BrowserManager;
use App\Crawler\Enum\PestStatus;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Models\LogPest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class Pestdownload extends Component
{
    public $link;
    public $type;

    protected $rules = [
        'link' => 'required|min:6|url',
        'type' => 'required|in:pdf',
    ];

    protected $messages = [
        'link.required' => 'Vui lòng nhập đầy đủ link quiz cần tải.',
        'link.min' => 'Độ dài của link quá ngắn.',
        'link.url' => 'Vui lòng nhập chính xác link quiz cần tải.',
        'type.required' => 'Vui lòng nhập định dạng file cần tải.',
        'type.in' => 'Hiện tại server chỉ hỗ trợ tải xuống định dạng PDF.',
    ];

    public function submit()
    {
        $validate = $this->validate();

        $log_pest = LogPest::create([
            'ip' => \Request::ip(),
            'url' => $validate['link'],
            'type' => $validate['type'],
            'status' => PestStatus::INIT,
        ]);

        if (!preg_match('/^https:\/\/pesthubt.com\/quiz/', $validate['link'])) {
            $log_pest->status = PestStatus::DO_NOT_LINK_PEST;
            $log_pest->save();
            session()->flash('error', 'Link quiz không khả dụng , vui lòng nhập lại.');
        } else {
            //GET HTML
            $html = '';
            try {
                $html = BrowserManager::get('puppeteer')->getHtml($validate['link']);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
                $log_pest->status = PestStatus::DO_NOT_GET_HTML;
                $log_pest->save();
                session()->flash('error', 'Đã xảy ra lỗi , vui lòng thử lại sau ít phút.');
            }

            //RETURN PDF
            try {
                $dom_crawler = new DomCrawler($html);

                $linkCrawler = $dom_crawler->filter('section.content.container-fluid.custom-content script')->text();
                $string = preg_replace('/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\];\':\"\\|,.<>\/?\s]*/', '', $linkCrawler);
                $string = preg_replace('/(\s)console\.log[a-zA-Z0-9!@#$%^&*()_+\-=\[\];\':\"\\|,.<>\/?\s]*/', '', $string);

                $array_data = json_decode($string, true);
                $data = $array_data['quiz'];

                if (!is_null($data['quiz_content'])) {
                    $data_pdf = [
                        'title' => $data['title'],
                        'quizs' => $data['quiz_content'],
                    ];
                    $pdf = PDF::loadView('pdf.pest', $data_pdf)->output();
                } else {
                    $data_pdf = [
                        'title' => $data['title'],
                        'quizs' => $data['questions'],
                    ];
                    $pdf = PDF::loadView('pdf.pestv2', $data_pdf)->output();
                }

                $log_pest->status = PestStatus::SUCCESS;
                $log_pest->save();

                session()->flash('success', "Tải xuống file " . createSlug($data['title']) . ".pdf thành công !!!.");
                return response()->streamDownload(
                    fn() => print($pdf),
                    createSlug($data['title']) . ".pdf",
                    [
                        'Content-Description' => 'File Transfer',
                        'Content-Disposition' => 'attachment; filename=' . createSlug($data['title']) . '.pdf',
                        'Content-Transfer-Encoding' => 'binary',
                        'Connection' => 'Keep-Alive',
                        'Expires' => 0,
                        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                        'Pragma' => 'public',
                        'Content-Type' => 'application/pdf',
                    ]
                );
            } catch (\Exception $exception) {
                Log::error($exception);
                $log_pest->status = PestStatus::FAIL_GET_PDF;
                $log_pest->save();
                session()->flash('error', 'Link quiz này hiện tại không hỗ trợ , vui lòng thử link khác.');
            }
        }
    }

    public function render()
    {
        return view('livewire.pestdownload');
    }
}
