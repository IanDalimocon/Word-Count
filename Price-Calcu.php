<?php

// Function to tokenize the text into words
function tokenizeText($text) {
    // Tokenize the text using regular expression
    $words = preg_split('/\W+/', $text, -1, PREG_SPLIT_NO_EMPTY);
    return $words;
}

// Function to calculate word frequencies
function calculateWordFrequencies($words) {
    // Count the occurrences of each word
    $wordCounts = array_count_values($words);
    return $wordCounts;
}

// Function to sort words by frequency
function sortWords($wordCounts, $sortOrder) {
    if ($sortOrder == 'asc') {
        asort($wordCounts);
    } else {
        arsort($wordCounts);
    }
    return $wordCounts;
}

// Function to display word frequencies
function displayWordFrequencies($wordCounts, $limit) {
    $count = 0;
    foreach ($wordCounts as $word => $frequency) {
        echo "$word: $frequency<br>";
        $count++;
        if ($count >= $limit) {
            break;
        }
    }
}

// Main code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST['text'];
    $sortOrder = $_POST['sort'];
    $limit = $_POST['limit'];

    // Tokenize the text
    $words = tokenizeText($text);

    // Calculate word frequencies
    $wordCounts = calculateWordFrequencies($words);

    // Sort words by frequency
    $sortedWordCounts = sortWords($wordCounts, $sortOrder);

    // Display word frequencies
    displayWordFrequencies($sortedWordCounts, $limit);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Word Frequency Counter</h1>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="text">Paste your text here:</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select><br><br>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" value="10" min="1"><br><br>
        
        <input type="submit" value="Calculate Word Frequency">
    </form>
</body>
</html>