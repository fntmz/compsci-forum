<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./assets/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
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
    </script>
</head>

<body>
    <!-- (\=============== NAVBAR COMPONENT ===============/) -->
    <header class="hover:w-72 fixed top-0 left-0 h-screen w-20 bg-bg-color border-r-1 border-custom-gray transition-width duration-500 ease-cubic-bezier(0.8, 0, 0.2, 1) overflow-hidden">
        <nav class="mt-24 w-72 flex flex-col">
            <a href="/" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center">
                    <HomeIcon class="fill-color" />
                </div>
                <div>Home</div>
            </a>
            <button class="flex items-center" @click="setSearchBarState">
                <div class="h-16 w-20 grid place-items-center">
                    <SearchIcon class="fill-color" />
                </div>
                <div>Search</div>
            </button>
            <a href="/messages" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center">
                    <MessageIcon class="fill-color" />
                </div>
                <div>Messages</div>
            </a>
            <button class="flex items-center" @click="setCreatePostState">
                <div class="h-16 w-20 grid place-items-center">
                    <PlusSquare class="fill-color" />
                </div>
                <div>Create</div>
            </button>
            <a href="/" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center">
                    <ProfileIcon class="fill-color" />
                </div>
                <div>Profile</div>
            </a>
        </nav>
        <div class="absolute bottom-0 left-0 w-72 flex flex-col">
            <button class="flex items-center" onclick="ToggleDarkmode()">
                <div class="h-16 w-20 grid place-items-center">
                    <MoonSolid class="fill-color" />
                </div>
                <div>Change Theme</div>
            </button>
            <button class="flex items-center">
                <div class="h-16 w-20 grid place-items-center">
                    <SettingsIcon class="fill-color" />
                </div>
                <div>Settings</div>
            </button>
        </div>
    </header>


    <!-- (\=============== MAIN COMPONENT ===============/) -->
    <main class="flex justify-center">
        <div class="p-8">
            <div class="h-screen w-[40rem]">

            </div>
        </div>
    </main>

    <!-- (\=============== CREATE POST COMPONENT ===============/) -->
    <?php if ($createPostState) : ?>
        <div class="create-post-element">
            <!-- Your create post content here -->
        </div>
    <?php endif; ?>

    <script src="./assets/darkmode.js" defer></script>
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

        // (\=============== CREATE POST STATE ===============/)
        const createPostState = {
            state: false,
            setCreatePostState() {
                this.state = !this.state;
            },
        };
    </script>
</body>

</html>