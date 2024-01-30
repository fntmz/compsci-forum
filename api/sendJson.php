<?php
function sendJson($status,  $message,  $extra = array())
{
    $response = array('status' => $status);
    if ($message) $response['message'] = $message;
    $json = json_encode(array_merge($response, $extra));
    echo "
        <head>
        <title>$status $message</title>
        <link rel=\"stylesheet\" href=\"../assets/main.css\">
        <script src=\"https://cdn.tailwindcss.com\"></script>
        </head>
        <body>
            <div class=\"flex flex-col items-center justify-center h-screen\">
                <h1 class=\"mb-4 text-xl\">$message</h1>
                <br><button onclick=\"window.history.back()\"><u>Click here to return to previous page, reload to get updated information</u></button>
                <br><button onclick=\"window.location.href = '../home.php'\"><u>Click here to go to the home page, reload to get updated information</u></button>
            </div>

            <script defer>
            // (\=============== DARKMODE ===============/)
            if (
                localStorage.darkmode === \"dark\" ||
                (!(\"darkmode\" in localStorage) &&
                    window.matchMedia(\"(prefers-color-scheme: dark)\").matches)
            ) {
                document.documentElement.classList.add(\"dark\");
            } else {
                document.documentElement.classList.remove(\"dark\");
            }
    
            function ToggleDarkmode() {
                if (localStorage.darkmode == \"light\") {
                    localStorage.setItem(\"darkmode\", \"dark\");
                    document.documentElement.classList.add(\"dark\");
                } else {
                    localStorage.setItem(\"darkmode\", \"light\");
                    document.documentElement.classList.remove(\"dark\");
                }
            }
        </script>
        </body>
    ";
    exit;
}
