document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById("markdown-editor")) {
        new EasyMDE({
            element: document.getElementById("markdown-editor"),
            spellChecker: false,
            autosave: {
                enabled: true,
                uniqueId: "blog_content",
                delay: 1000,
            },
            placeholder: "Write your blog using Markdown...",
            status: false,
            toolbar: [
                "bold", "italic", "heading", "|",
                "quote", "unordered-list", "ordered-list", "|",
                "link", "image", "table", "|",
                "preview", "side-by-side", "fullscreen"
            ],
        });
    }
});
