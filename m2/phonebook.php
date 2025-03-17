<?php
// Contact Management Terminal-Based App
$contacts = [];


// Function to add a contact
function addContact(array &$contacts, string $name, string $email, string $phone): void
{
    $contacts[] = [
        'name' => strtoupper($name),
        'email' => strtoupper($email),
        'phone' => strtoupper($phone)
    ];
}
// Function to display all contacts
function viewContact(array $contacts): void
{
    if (empty($contacts)) {
        echo "\033[33m No contacts available.\033[0m\n";
    } else {
        foreach ($contacts as $index => $contact) {
            // Color code for each contact
            // 32 is green, 35 is purple, 36 is cyan

            echo "\n\033[36m" . str_repeat("=", 40) . "\033[0m\n";
            echo "\033[32mContact #" . ($index + 1) . "\033[0m\n";
            echo "\033[35mName:\033[0m  {$contact['name']}\n";
            echo "\033[35mEmail:\033[0m {$contact['email']}\n";
            echo "\033[35mPhone:\033[0m {$contact['phone']}\n";
            echo "\033[36m" . str_repeat("=", 40) . "\033[0m\n";
        }
    }
}
// Terminal-based interface
while (true) {
    echo "\nContact Management Menu:\n";
    echo "1. Add Contact\n2. View Contacts\n3. Exit\n";
    $choice = (int) readline("Choose an option: ");
    if ($choice === 1) {
        $name = readline("Enter name: ");
        $email = readline("Enter email: ");
        $phone = readline("Enter phone number: ");
        addContact($contacts, $name, $email, $phone);
        echo "$name added to contacts.\n";
    } elseif ($choice === 2) {
        viewContact($contacts);
    } elseif ($choice === 3) {
        echo "Mission Aborted! 🚀\n";
        break;
    } else {
        echo "Invalid choice. Please try again.\n";
    }
}
