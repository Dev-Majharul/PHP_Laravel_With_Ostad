<?php
// Function to evaluate the quiz
function evaluateQuiz(array $questions, array $answers): int
{
    $score = 0;
    foreach ($questions as $index => $question) {
        if ($answers[$index] === $question['correct']) {
            $score++;
        }
    }
    return $score;
}
// Example questions
$questions = [
    ['question' => "Why don't skeletons fight?", 'correct' => 'THEY DONT HAVE THE GUTS'],

    ['question' => "If you could have one superpower, what would it be?", 'correct' => 'UNLIMITED WIFI'],

    ['question' => "If money doesn't grow on trees, why do banks have branches?", 'correct' => 'TO CONFUSE US'],
];


// Collect answers from the user
$answers = [];
foreach ($questions as $index => $question) {
    echo ($index + 1) . ". " . $question['question'] . "\n";
    $answers[] = strtoupper(trim(readline("Your answer: ")));
}
// Calculate score and provide feedback
$score = evaluateQuiz($questions, $answers);
echo "\nYou scored $score out of " . count($questions) . ".\n";
if ($score === count($questions)) {
    echo "Well done! You nailed it! 🎯 Now go flex your brain somewhere else! 😆\n";
} elseif ($score > 1) {
    echo "Almost a genius moment! Just one step away! Better luck next time! 🤏😂\n";
} else {
    echo "Logging out… Your brain’s cache is cleared! 🧠💾\n";
}
