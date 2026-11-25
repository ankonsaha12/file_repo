<?php
// upload_rules.php — which file types users may upload.
// Uploads keep their extension on disk, so executable types (.php, .phtml, .phar, ...)
// must never be accepted, or an uploaded script could run on the server.

const ALLOWED_UPLOAD_EXTENSIONS = [
    'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'csv', 'txt', 'md',
    'zip', 'rar', '7z', 'png', 'jpg', 'jpeg', 'gif', 'webp',
    'sql', 'py', 'java', 'c', 'cpp', 'js', 'css', 'ipynb',
];

function upload_extension_allowed(string $filename): bool {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return $ext !== '' && in_array($ext, ALLOWED_UPLOAD_EXTENSIONS, true);
}
