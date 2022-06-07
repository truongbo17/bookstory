<style>
    #pdf-viewer {
        width: 100%;
        height: 70vh;
        background: rgba(0, 0, 0, 0.1);
        overflow: auto;
    }

    .pdf-page-canvas {
        display: block;
        margin: 5px auto;
        border: 1px solid rgba(0, 0, 0, 0.2);
    }
</style>
<div id="readDocument" tabindex="-1"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-7xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Read Document Online
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="readDocument">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div id='pdf-viewer'></div>
                <a href="{{$download_link}}" onclick="downloadHandle()"
                   class="button w-full bg-indigo-600 border border-black border-transparent rounded-md py-2 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">
                    Download to read in full
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
    let url = '{{$read_link}}';
    const parseResult = new DOMParser().parseFromString(url, "text/html");
    url = parseResult.documentElement.textContent;

    let thePdf = null;
    let scale = 1;
    let numberPageView = 5;

    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    pdfjsLib.getDocument(url).promise.then(function (pdf) {
        thePdf = pdf;
        viewer = document.getElementById('pdf-viewer');

        if (numberPageView > pdf.numPages) numberPageView = pdf.numPages;

        for (let page = 1; page <= numberPageView; page++) {
            const canvas = document.createElement("canvas");
            canvas.className = 'pdf-page-canvas';

            const numberPage = document.createElement("p");
            numberPage.className = 'bg-indigo-700 text-white text-sm text-center w-full';
            numberPage.textContent = 'Page ' + page + ' of ' + pdf.numPages;

            viewer.appendChild(numberPage);
            viewer.appendChild(canvas);
            renderPage(page, canvas);
        }
    });

    function renderPage(pageNumber, canvas) {
        thePdf.getPage(pageNumber).then(function (page) {
            const viewport = page.getViewport({scale: scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            page.render({canvasContext: canvas.getContext('2d'), viewport: viewport});
        });
    }
</script>
