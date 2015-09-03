<p>Don't forget to print your document!</p>
<iframe src="/path/to/your/pdfgenerator.php" id="mypdf"></iframe>

<script>
function printIframe(id) {
    var iframe = document.frames ? document.frames[id] : document.getElementById(id);
    var ifWin = iframe.contentWindow || iframe;
    iframe.focus();
    ifWin.printPage();
    return false;
}
</script>