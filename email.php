<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-f5555435701e83ba461a84ea3724f52e');
$domain = "sandboxbb5414fe26d94969aa76e2ece53f668e.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Excited User <postmaster@sandboxbb5414fe26d94969aa76e2ece53f668e.mailgun.org>',
    'to'      => 'Baz <joelunmsm@gmail.com>',
    'subject' => 'Hello',
    'text'    => 'Testing some Mailgun awesomness!'
));
