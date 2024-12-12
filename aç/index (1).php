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

$totalFollowers = count($followers);
$totalFollowing = count($following);
$notFollowingBack = count(array_diff($following, $followers));
$notFollowedBack = count(array_diff($followers, $following));

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takipçi Analizi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">Takipçi Analizi</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Toplam Takipçi</h2>
                <p class="text-4xl text-indigo-600 font-bold"><?= $totalFollowers; ?></p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Toplam Takip Edilen</h2>
                <p class="text-4xl text-green-600 font-bold"><?= $totalFollowing; ?></p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Takip Etmeyenler</h2>
                <p class="text-4xl text-red-600 font-bold"><?= $notFollowingBack; ?></p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Takip Edenler</h2>
                <p class="text-4xl text-blue-600 font-bold"><?= $notFollowedBack; ?></p>
            </div>
        </div>
        <div class="mt-10 flex justify-center space-x-4">
            <a href="etmeyenler.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded shadow-lg transition duration-300">Takip Etmeyenler</a>
            <a href="edenler.php" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded shadow-lg transition duration-300">Takip Edenler</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
