import './bootstrap';
import 'bootstrap-fileinput/css/fileinput.min.css';
import 'bootstrap-fileinput/js/fileinput.min';
document.addEventListener('DOMContentLoaded', function() {
    $('#file-0').fileinput({
        theme: 'fa',
        uploadUrl: '/path-to-your-upload-url',
        allowedFileExtensions: ['jpg', 'png', 'gif']
    });
});

