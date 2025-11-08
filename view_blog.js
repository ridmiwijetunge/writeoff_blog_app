// Parse the blog content as Markdown using EasyMDE
document.addEventListener("DOMContentLoaded", function() {
    var content = document.getElementById("markdown-content");
    if (content) {
        // Initialize EasyMDE in read-only mode
        var easyMDE = new EasyMDE({
            element: content,
            toolbar: false,
            status: false,
            autoDownloadFontAwesome: false,
            spellChecker: false,
            forceSync: true,
            initialValue: content.textContent,
            renderingConfig: {
                singleLineBreaks: false,
                codeSyntaxHighlighting: true
            }
        });

        // Replace the textarea with rendered Markdown
        content.innerHTML = easyMDE.options.previewRender(easyMDE.value());
    }
});
