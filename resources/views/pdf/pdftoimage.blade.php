<div id="image-form-data"></div>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
    let url = '{{$download_link}}';
    const parseResult = new DOMParser().parseFromString(url, "text/html");
    url = parseResult.documentElement.textContent;

    let thePdf = null;
    let scale = 1;
    const pageNumber = 1;
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    let canvas = document.createElement("canvas");
    pdfjsLib.getDocument(url).promise.then(function (pdf) {
        pdf.getPage(pageNumber)
            .then(function (page) {
                const viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                page.render({
                    canvasContext: canvas.getContext('2d'),
                    viewport: viewport
                }).promise.then(function () {
                    const img = canvas.toDataURL();
                    document.getElementById('image-form-data').textContent = img;
                });
            });
    });
</script>
