<?php
//Load file content
$pdf_content = file_get_contents('https://journals.plos.org/plosone/article/file?id=10.1371/journal.pone.0000686&type=printable');
header("Content-Type: application/pdf");
readfile("https://journals.plos.org/plosone/article/file?id=10.1371/journal.pone.0000686&type=printable");
