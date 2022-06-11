<?php

namespace App\Http\Livewire;

use App\Crawler\Browsers\BrowserManager;
use App\Libs\DiskPathTools\DiskPathInfo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class Pestdownload extends Component
{
    public $link;

    protected $rules = [
        'link' => 'required|min:6|url',
    ];

    protected $messages = [
        'link.required' => 'Vui lòng nhập đầy đủ link quiz cần tải.',
        'link.min' => 'Độ dài của link quá ngắn.',
        'link.url' => 'Vui lòng nhập chính xác link quiz cần tải',
    ];

    public function submit()
    {
        $validate = $this->validate();

        if (!preg_match('/^https:\/\/pesthubt.com\/quiz/', $validate['link'])) {
            session()->flash('error', 'Link quiz không khả dụng , vui lòng nhập lại.');
        } else {
            //GET HTML
            try {
                $html = BrowserManager::get('puppeteer')->getHtml($validate['link']);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
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

                return response()->streamDownload(
                    fn() => print($pdf),
                    createSlug($data['title']) . ".pdf",
                    ['Content-Type' => 'application/pdf']
                );
            } catch (\Exception $exception) {
                Log::error($exception);
                session()->flash('error', 'Link quiz này hiện tại không hỗ trợ , vui lòng thử link khác.');
            }
        }
    }

    public function render()
    {
        return view('livewire.pestdownload');
    }
}
