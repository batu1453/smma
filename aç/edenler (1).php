<?php

$followersFile = 'connections/followers_and_following/followers_1.html';
$followingFile = 'connections/followers_and_following/following.html';

function extractUsernames($filename) {
    $usernames = [];
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(file_get_contents($filename));
    libxml_clear_errors();
    $tags = $dom->getElementsByTagName('a');
    foreach ($tags as $tag) {
        $usernames[] = $tag->nodeValue;
    }
    return array_unique(array_map('trim', $usernames));
}

$followers = extractUsernames($followersFile);
$following = extractUsernames($followingFile);

$notFollowedBack = array_diff($followers, $following);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sizi Takip Edenler</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mx-auto py-10">
        <div class="mb-6 flex justify-start">
            <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow-md transition duration-300">
                Geri Dön
            </a>
        </div>
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">Sizi Takip Eden Ama <br> Sizin Takip Etmediğiniz Kullanıcılar</h1>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kullanıcı Adı</th>
                        <th>Profil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($notFollowedBack) > 0): ?>
                        <?php $index = 1; ?>
                        <?php foreach ($notFollowedBack as $user): ?>
                            <tr>
                                <td><?= $index++; ?></td>
                                <td><?= htmlspecialchars($user); ?></td>
                                <td>
                                    <a href="https://instagram.com/<?= htmlspecialchars($user); ?>" target="_blank" class="text-blue-500 hover:underline">
                                        Tıkla
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Tüm kullanıcıları takip ediyorsunuz.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>