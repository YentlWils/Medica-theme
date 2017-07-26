<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 26/07/2017
 * Time: 21:33
 */

function sendContactFormToSiteAdmin () {
    try {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['firstname']) || empty($_POST['subject'])) {
            throw new Exception('Bad form parameters. Check the markup to make sure you are naming the inputs correctly.');
        }
        if (!is_email($_POST['email'])) {
            throw new Exception('Email address not formatted correctly.');
        }

        $headers = 'From: Medica Website <'. get_option('medica_email') .'>';
        $send_to = "contact@medica.be";
        $subject = 'Zoekertje komen draaien/tappen: '. $_POST['subject'] .' - '.$_POST['name'] .' '.$_POST['firstname'];
        $message = "Reactie van ".$_POST['name']." ". $_POST['firstname'] . " \n\n Stuur terug naar to: " . $_POST['email'];

        if (wp_mail($send_to, $subject, $message, $headers)) {
            echo json_encode(array('status' => 'success', 'message' => 'Contact message sent.'));
            exit;
        } else {
            throw new Exception('Failed to send email. Check AJAX handler.');
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        exit;
    }
}
add_action("wp_ajax_contact_send", "sendContactFormToSiteAdmin");
add_action("wp_ajax_nopriv_contact_send", "sendContactFormToSiteAdmin");