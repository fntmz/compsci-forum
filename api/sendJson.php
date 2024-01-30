<?php
function sendJson($status,  $message,  $extra = array())
{
    $response = array('status' => $status);
    if ($message) $response['message'] = $message;
    echo "
        <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>$status $message</title>
        <link rel=\"stylesheet\" href=\"../assets/main.css\">
        <script src=\"https://cdn.tailwindcss.com\"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            color: \"rgb(var(--color))\",
                            \"bg-color\": \"rgb(var(--bg-color))\",
                            \"custom-gray\": \"rgb(var(--gray))\",
                            accent: \"rgb(var(--accent))\",
                            \"alt-accent\": \"rgb(var(--alt-accent))\",
                        },
                        transitionProperty: {
                            width: \"width\",
                            height: \"height\",
                            filter: \"filter\",
                        },
                        borderWidth: {
                            1: \"1px\",
                        },
                        container: {
                            center: true,
                        },
                    },
                },
            }
        </script>
        </head>

        <body>
            <div class=\"flex flex-col items-center justify-center h-screen\">
                <h1 class=\"mb-4 text-2xl\">$message</h1>
                <br><button class=\"bg-accent text-white px-4 py-3 rounded-full\" onclick=\"window.location.href = '../home.php'\">Click here to go to the home page, reload to get updated information</button>
                <br><button class=\"bg-accent text-white px-4 py-3 rounded-full\" onclick=\"window.history.back()\">Click here to return to previous page, reload to get updated information</button>
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
            };
        </script>
        </body>
    ";
    exit;
}
