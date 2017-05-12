<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/gmail.setup.php';

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Gmail($client);

$user = 'me';

$messages = listMessages($service, $user);

/**
 * Get list of Messages in user's mailbox.
 *
 * @param  Google_Service_Gmail $service Authorized Gmail API instance.
 * @param  string $userId User's email address. The special value 'me'
 * can be used to indicate the authenticated user.
 * @return array Array of Messages.
 */
function listMessages($service, $userId) {
    $pageToken = NULL;
    $messages = array();
    $opt_param = array();

    try {
        $messagesResponse = $service->users_messages->listUsersMessages($userId, $opt_param);
        if ($messagesResponse->getMessages()) {
            $messages = array_merge($messages, $messagesResponse->getMessages());
        }
    } catch (Exception $e) {
        print 'An error occurred: ' . $e->getMessage();
    }

    foreach ($messages as $message) {
        print 'Message with ID: ' . $message->getId() . PHP_EOL;
    }

    return $messages;
}
