<footer id="footer">
    <div id="social-container">
        <ul>
            <li>
                <a href="#"><i class="fab fa-facebook-square"></i></a>
            </li>
            <li>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </li>
            <li>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </li>
        </ul>
    </div>
    <p>&copy; 2025 Game Rank</p>
</footer>

<script>
    function closeToast() {
        const toast = document.getElementById("toast");
        if (toast) {
            toast.style.display = "none";
        }
    }

    function showMenu(event) {
        event.stopPropagation();

        const menu = document.getElementById("user-menu");
        const currentDisplay = window.getComputedStyle(menu).display;

        menu.style.display = currentDisplay === "none" ? "block" : "none";
    }

    document.addEventListener("click", function(event) {
        const menu = document.getElementById("user-menu");

        if (!menu.contains(event.target)) {
            menu.style.display = "none";
        }
    });

    document.getElementById("image").addEventListener("change", function(event) {
        const fileInput = event.target;
        const fileNameSpan = document.getElementById("file-name");

        if (fileInput.files.length > 0) {
            fileNameSpan.textContent = fileInput.files[0].name;
        } else {
            fileNameSpan.textContent = "";
        }
    });

    const select = document.getElementById("category-select");

    select.addEventListener("change", function() {
        if (select.value) {
            select.classList.add("has-value");
        } else {
            select.classList.remove("has-value");
        }
    });
</script>
</body>

</html>