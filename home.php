<?php
session_start();
require_once("../../mysql.php");
date_default_timezone_set("UTC");

if (!isset($_SESSION['id'])) {
    header('Location: ./login.html');
}

$username_sql = "
        SELECT username
        FROM `forum_users`
        WHERE id = :id
    ";
$username_result = $db->prepare($username_sql);
$username_result->bindParam(':id', $_SESSION['id']);
$username_result->execute();
$username = $username_result->fetch(PDO::FETCH_ASSOC);
$username = $username['username'];

// GET POSTS
$posts = array();
$posts_sql = "
        SELECT forum_posts.id, username, caption, date_created
        FROM `forum_posts`
        LEFT JOIN forum_users ON forum_posts.author_id = forum_users.id
        ORDER BY date_created DESC
    ";
$posts_result = $db->prepare($posts_sql);
$posts_result->execute();
while ($row = $posts_result->fetch(PDO::FETCH_ASSOC)) {
    array_push($posts, array($row['id'], $row['username'], $row['caption'], $row['date_created']));
}

$comments = array();
$comments_sql = "
        SELECT forum_comments.id, post_id, username, content
        FROM `forum_comments`
        LEFT JOIN forum_users ON forum_comments.author_id = forum_users.id
        ORDER BY post_id DESC, forum_comments.id DESC
    ";
$comments_result = $db->prepare($comments_sql);
$comments_result->execute();
while ($row = $comments_result->fetch(PDO::FETCH_ASSOC)) {
    array_push($comments, array($row['id'], $row['post_id'], $row['username'], $row['content']));
}
?>

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
            <a href="./postCreate.php" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center">
                    <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 448 512">
                        <path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>
                </div>
                <div>Create</div>
                </button>
                <a href="./profile.php" class="flex items-center">
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
            <button onclick="window.location.href = './api/logout.php'" class="flex items-center">
                <div class="h-16 w-20 grid place-items-center"><svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 512 512">
                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                    </svg>
                </div>
                <div>Logout</div>
            </button>
        </div>
    </header>


    <!-- (\=============== MAIN COMPONENT ===============/) -->
    <main class="flex justify-center">
        <div class="p-8">
            <div class="h-screen w-[40rem]">
                <?php foreach ($posts as $index => $post) : ?>
                    <div class="p-2 border-custom-gray border-b-1">
                        <div class="flex justify-between">
                            <div>
                                <span class="text-sm text-accent"><?php echo $post[1] ?></span> said
                            </div>
                            <?php if ($username == $post[1]) : ?>
                                <form method='post' action="./api/postDelete.php">
                                    <button type="submit">
                                        <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width=".75rem" height=".75rem" viewBox="0 0 448 512">
                                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                        <input type="hidden" name="post_id" value="<?php echo $post[0]; ?>">
                                        <button>
                                </form>
                            <?php endif ?>
                        </div>
                        <div>
                            "<?php echo $post[2] ?>"
                            <span class="text-sm text-custom-gray">
                                on <?php echo $post[3] ?>
                            </span>
                        </div>
                        <div class="mt-1 grid grid-cols-2 gap-x-2 text-xs">
                            <div class="col-span-1">
                                <?php foreach ($comments as $comment) : if ($comment[1] == $post[0]) : ?>
                                        <div class="mt-2 break-words">
                                            <span class="text-accent">
                                                <?php echo $comment[2] ?>
                                            </span>
                                            replied "<?php echo $comment[3] ?>"
                                        </div>
                                <?php endif;
                                endforeach; ?>
                            </div>
                            <div class="col-span-1 col-start-2">
                                <form method="post" action="./api/commentCreate.php">
                                    <div class="flex">
                                        <input name="caption" class="w-full p-1 border-b-1 border-transparent focus:border-accent" placeholder="Reply..." required>
                                        <button type="submit">
                                            <svg class="fill-color" xmlns="http://www.w3.org/2000/svg" width=".75rem" height=".75rem" viewBox="0 0 512 512">
                                                <path d="M16.1 260.2c-22.6 12.9-20.5 47.3 3.6 57.3L160 376V479.3c0 18.1 14.6 32.7 32.7 32.7c9.7 0 18.9-4.3 25.1-11.8l62-74.3 123.9 51.6c18.9 7.9 40.8-4.5 43.9-24.7l64-416c1.9-12.1-3.4-24.3-13.5-31.2s-23.3-7.5-34-1.4l-448 256zm52.1 25.5L409.7 90.6 190.1 336l1.2 1L68.2 285.7zM403.3 425.4L236.7 355.9 450.8 116.6 403.3 425.4z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <input type="hidden" name="post_id" value="<?php echo $post[0]; ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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