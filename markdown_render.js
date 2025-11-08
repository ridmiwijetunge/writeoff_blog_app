document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('.markdown-content');
    containers.forEach(div => {
        const md = div.getAttribute('data-markdown');
        div.innerHTML = marked.parse(md);

        div.style.padding = "20px";
        div.style.backgroundColor = "#fff";
        div.style.borderRadius = "12px";
        div.style.boxShadow = "0 4px 12px rgba(0,0,0,0.08)";
        div.style.lineHeight = "1.8";
        div.style.color = "#333";
    });
});
