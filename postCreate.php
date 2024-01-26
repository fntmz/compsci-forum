<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./assets/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // (\=============== TAILWIND CONFIG ===============/)
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        color: "rgb(var(--color))",
                        "bg-color": "rgb(var(--bg-color))",
                        "custom-gray": "rgb(var(--gray))",
                        accent: "rgb(var(--accent))",
                        "alt-accent": "rgb(var(--alt-accent))",
                    },
                    transitionProperty: {
                        width: "width",
                        height: "height",
                        filter: "filter",
                    },
                    borderWidth: {
                        1: "1px",
                    },
                    container: {
                        center: true,
                    },
                },
            },
        }

        if (!localStorage.getItem('id')) {
            window.location.href = './login.html'
        }
        window.onload = (event) => {
            document.querySelector('input[name="author_id"]').value = localStorage.getItem('id')
        };
    </script>
</head>

<body>
    <!-- (\=============== NAVBAR COMPONENT ===============/) -->
    <header class="hover:w-72 fixed top-0 left-0 h-screen w-20 bg-bg-color border-r-1 border-custom-gray transition-width duration-500 ease-cubic-bezier(0.8, 0, 0.2, 1) overflow-hidden">
        <nav class="mt-24 w-72 flex flex-col">
            <a href="./home.php" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center">
                    <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 576 512">
                        <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                    </svg>
                </div>
                <div>Home</div>
            </a>
            <button class="flex items-center" @click="setSearchBarState">
                <div class="h-16 w-20 grid place-items-center">
                    <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 512 512">
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                </div>
                <div>Search</div>
            </button>
            <a class="flex items-center" disabled>
                <div class="h-16 w-20 grid place-items-center">
                    <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 30 30">
                        <path d="M 15 3 C 7.82 3 2 7.925 2 14 C 2 17.368 3.7933281 20.378484 6.6113281 22.396484 C 6.6832805 23.932468 6.4452784 26.053382 4.3261719 27.03125 A 0.5 0.5 0 0 0 4.3222656 27.033203 A 0.5 0.5 0 0 0 4 27.5 A 0.5 0.5 0 0 0 4.5 28 C 4.5119372 28 4.5232366 27.998109 4.5351562 27.998047 A 0.5 0.5 0 0 0 4.5429688 27.998047 C 6.9769949 27.982445 9.0432734 26.667034 10.46875 25.277344 C 10.92075 24.836344 11.550875 24.619328 12.171875 24.736328 C 13.081875 24.909328 14.028 25 15 25 C 22.18 25 28 20.075 28 14 C 28 7.925 22.18 3 15 3 z" />
                    </svg>
                </div>
                <div>Messages</div>
            </a>
            <a href="./postCreate.php" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center">
                    <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 448 512">
                        <path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>
                </div>
                <div>Create</div>
                </button>
                <a class="flex items-center">
                    <div class="h-16 w-20 grid place-items-center">
                        <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 30 30">
                            <path d="M18,19v-2c0.45-0.223,1.737-1.755,1.872-2.952c0.354-0.027,0.91-0.352,1.074-1.635c0.088-0.689-0.262-1.076-0.474-1.198 c0,0,0.528-1.003,0.528-2.214c0-2.428-0.953-4.5-3-4.5c0,0-0.711-1.5-3-1.5c-4.242,0-6,2.721-6,6c0,1.104,0.528,2.214,0.528,2.214 c-0.212,0.122-0.562,0.51-0.474,1.198c0.164,1.283,0.72,1.608,1.074,1.635C10.263,15.245,11.55,16.777,12,17v2c-1,3-9,1-9,8h24 C27,20,19,22,18,19z" />
                        </svg>
                    </div>
                    <div>Profile</div>
                </a>
        </nav>
        <div class="absolute bottom-0 left-0 w-72 flex flex-col">
            <button class="flex items-center" onclick="ToggleDarkmode()">
                <div class="h-16 w-20 grid place-items-center">
                    <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 384 512">
                        <path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z" />
                    </svg>
                </div>
                <div>Change Theme</div>
            </button>
            <button onclick="localStorage.clear('id'); window.location.href = './login.html'" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center"><svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 512 512">
                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                    </svg>
                </div>
                <div>Logout</div>
            </button>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="h-screen flex flex-col items-center justify-center">
                <div class="w-[40rem]">
                    <form action="./api/postCreate.php" method="POST" class="flex flex-col">
                        <div class="flex flex-col mb-4">
                            <label for="caption" class="mb-2">What are you thinking about?</label>
                            <input type="text" name="caption" id="caption" class="border-1 border-custom-gray rounded-sm p-2" placeholder="..." required>
                        </div>
                        <input type="hidden" name="author_id">
                        <button type="submit" class="bg-accent text-white rounded-sm p-2">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script defer>
        // (\=============== DARKMODE ===============/)
        if (
            localStorage.darkmode === "dark" ||
            (!("darkmode" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }

        function ToggleDarkmode() {
            if (localStorage.darkmode == "light") {
                localStorage.setItem("darkmode", "dark");
                document.documentElement.classList.add("dark");
            } else {
                localStorage.setItem("darkmode", "light");
                document.documentElement.classList.remove("dark");
            }
        }
    </script>
</body>

</html>