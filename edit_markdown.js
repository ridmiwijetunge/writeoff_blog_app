document.addEventListener("DOMContentLoaded", function() {
    var easyMDE = new EasyMDE({
        element: document.getElementById("content"),
        spellChecker: true,
        autosave: {
            enabled: true,
            uniqueId: "blogContent_" + Date.now(),
            delay: 1000,
        },
        placeholder: "Write your blog here...",
        renderingConfig: {
            singleLineBreaks: false,
            codeSyntaxHighlighting: true,
        },
        toolbar: [
            "bold", "italic", "heading", "|",
            "quote", "unordered-list", "ordered-list", "|",
            "link", "image", "table", "|",
            "preview", "side-by-side", "fullscreen"
        ]
    });
});
