<footer>
    Pinecone Studio
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         width="521.63px" height="585.316px" viewBox="0 0 521.63 585.316"
         style="enable-background:new 0 0 521.63 585.316;"
         xml:space="preserve">
<g id="Logo_Black">
    <path style="fill:#90A4AE;" d="M475.34,322.605h-0.029L317.5,404.799h0.842c-25.434,13.249-45.396,47.551-45.396,76.234v52.134
		v52.149l203.242-106.273c25.434-13.246,45.441-47.555,45.441-76.23V350.67v-52.148L475.34,322.605z"/>
    <path style="fill:#90A4AE;" d="M46.291,286.112h0.026l157.808,82.188h-0.84c25.437,13.242,45.398,47.551,45.398,76.23v52.149
		v52.138L45.444,442.541C20.007,429.296,0,394.99,0,366.307v-52.142v-52.138L46.291,286.112z"/>
    <path style="fill:#607D8B;" d="M425.287,201.219h-0.504L306.176,262.86h0.723c-19.066,9.942-33.953,35.662-33.953,57.175v39.114
		v39.11l153.189-79.706c19.074-9.942,34.84-35.673,34.84-57.184v-39.106V183.15L425.287,201.219z"/>
    <path style="fill:#607D8B;" d="M96.342,164.718h0.503l118.606,61.645h-0.723c19.07,9.938,33.954,35.665,33.954,57.176v39.106
		v39.113L95.495,282.044c-19.075-9.938-34.84-35.665-34.84-57.176v-39.106v-39.11L96.342,164.718z"/>
    <path style="fill:#455B65;" d="M372.197,121.548h0.539l-78.633,41.092h0.982c-12.721,6.623-22.141,23.775-22.141,38.117v26.067
		v26.067l100.104-53.131c12.725-6.615,21.205-23.771,21.205-38.109V135.58v-26.067L372.197,121.548z"/>
    <g>
        <path style="fill:#263238;" d="M318.645,97.684c0.781-12.01-6.439-23.735-13.998-34.798C304.635,62.875,261.66,0,261.66,0
			l-38.917,54.651c-8.212,11.752-5.508,28.348,6.016,36.88c9.773,7.245,21.321,14.731,29.504,23.985
			c8.548,9.675,10.644,20.117,11.941,32.232c1.393-0.512,32.406-20.926,42.465-34.55C316.518,107.997,318.307,102.81,318.645,97.684
			z"/>
    </g>
    <path style="fill:#455B65;" d="M149.43,85.042h-0.537l78.635,41.093h-0.983c12.719,6.626,22.139,23.779,22.139,38.117v26.071
		v26.071l-100.103-53.135c-12.721-6.619-21.205-23.771-21.205-38.113V99.078V73.011L149.43,85.042z"/>
</g>
</svg>
</footer>
</body>
<?php

if (PROD) {
    ?>
    <script src="/static/js/build.min.js"></script>
<?php
} else {
    ?>
    <script src="/static/js/libs/jquery-2.1.3.js"></script>
    <script src="/static/js/libs/crypto/sha512.js"></script>
    <script src="/static/js/libs/crypto/aes.js"></script>
    <script src="/static/js/libs/crypto/pbkdf2.js"></script>
    <script src="/static/js/src/config.js"></script>
    <script src="/static/js/src/cookie.js"></script>
    <script src="/static/js/src/editable.js"></script>
    <script src="/static/js/src/crypto.js"></script>
    <script src="/static/js/src/form.js"></script>
    <script src="/static/js/src/home.js"></script>
    <script src="/static/js/src/date.js"></script>
    <script src="/static/js/src/api.js"></script>
    <script src="/static/js/src/middleware.js"></script>
    <script src="/static/js/src/middleware/crypt.js"></script>
    <script src="/static/js/src/todo.js"></script>
    <script src="/static/js/src/diary.js"></script>
    <script src="/static/js/src/journal.js"></script>

<?php
}
?>
</html>