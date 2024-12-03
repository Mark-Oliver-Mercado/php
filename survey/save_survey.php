<?php
// Path to the XML file
$xmlFile = 'survey_data.xml';

// Check if the file exists
if (!file_exists($xmlFile)) {
    // Create the XML structure if the file doesn't exist
    $xmlContent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<survey_responses></survey_responses>";
    file_put_contents($xmlFile, $xmlContent);
}

// Load the XML file
$xml = simplexml_load_file($xmlFile);

// Sanitize the user input using htmlspecialchars to prevent issues with special characters
$name = htmlspecialchars($_POST['name']);
$age = htmlspecialchars($_POST['age']);
$opinion = $_POST['opinion'];

// Remove any newline or carriage return characters from the opinion field
$opinion = str_replace(["\r", "\n"], ' ', $opinion);  // Replace newlines with a space
$opinion = htmlspecialchars($opinion);  // Escape any remaining special characters

// Create a new <response> element
$response = $xml->addChild('response');
$response->addChild('name', $name);
$response->addChild('age', $age);
$response->addChild('opinion', $opinion);

// Save the updated XML back to the file with pretty formatting
$xml->asXML($xmlFile);

// Redirect back to the form
header('Location: thank_you.html');
exit;
?>
