<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/3/2018
 * Time: 1:18 PM
 */
class Mail_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function send_mail ($to, $subject, $msg, $label=NULL, $from=NULL, $attatchments=NULL) {
        /*
        [NAME]

        [BUTTON]

        [TEXT]

        [ADDITIONAL_TEXT] Markups*/
        
        $from = ($from == NULL) ? $this->Util_model->get_option("site_email") : $from;
        $label = SITE_TITLE;
        $site_title = SITE_TITLE;
        $site_url = SITE_URL;
        $logo = base_url()."assets/img/logo.png";
        
        $template_start = "<table role='presentation' width='100%' border='0' cellpadding='0' cellspacing='0'>";
        $template_start .= "<tr>";
        $template_start .= "<td align='center' style='background-color:#2c3e50; padding:15px 0px;'>";
        $template_start .= "<img src='$logo'>";
        $template_start .= "</td>";
        $template_start .= "</tr>";
        $template_start .= "<tr>";
        $template_start .= "<td>";
        
        $template_end = "</td>";
        $template_end .= "</tr>";
        $template_end .= "<tr>";
        $template_end .= "<td>";
        $template_end .= "<table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%'>";
        $template_end .= "<tr>";
        $template_end .= "<td class='content-block' align='center'>";
        $template_end .= "<span class='apple-link'>Thank you for choosing and believing in us</span>";
        $template_end .= "<br> $site_title Support Team";
        $template_end .= "</td>";
        $template_end .= "</tr>";
        $template_end .= "<tr>";
        $template_end .= "<td class='content-block powered-by' align='center'>";
        $template_end .= "Powered by <a href='$site_url'>$site_title</a>";
        $template_end .= "</td>";
        $template_end .= "</tr>";
        $template_end .= "</table>";
        $template_end .= "</td>";
        $template_end .= "</tr>";
        $template_end .= "</table>";

        if (strstr($to, ',')) {
            $to = explode(",", $to);
            foreach ($to as $s_to) {
                if (is_connected()) {
                    $msg = htmlspecialchars_decode($msg);
                    $send = $this->Util_model->send_mail($from,$s_to,$subject,$template_start.$msg.$template_end,$label);
                    return $send['return'];
                } else {
                    return true;
                }
            }
        } else {
            if (is_connected()) {
                $msg = htmlspecialchars_decode($msg);
                $send = $this->Util_model->send_mail($from,$to,$subject,$template_start.$msg.$template_end,$label);
                return $send['return'];
            } else {
                return true;
            }
        }
    }

    public function template () {
        $site_title = SITE_TITLE;
        $site_url = $this->Util_model->get_option("site_url");
        $tagline = $this->Util_model->get_option("site_tagline");

        $template = "<!doctype html>";
        $template .= "<html>";
        $template .= "<head>";
        $template .= "<meta name='viewport' content='width=device-width' />";
        $template .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
        $template .= "<title>$site_title</title>";
        $template .= "<style>";
        $template .= "img {";
        $template .= "border: none;";
        $template .= "-ms-interpolation-mode: bicubic;";
        $template .= "max-width: 100%;";
        $template .= "}";
        $template .= "body {";
        $template .= "background-color: #f6f6f6;";
        $template .= "font-family: sans-serif;";
        $template .= "-webkit-font-smoothing: antialiased;";
        $template .= "font-size: 14px;";
        $template .= "line-height: 1.4;";
        $template .= "margin: 0;";
        $template .= "padding: 0;";
        $template .= "-ms-text-size-adjust: 100%;";
        $template .= "-webkit-text-size-adjust: 100%;";
        $template .= "}";
        $template .= "table {";
        $template .= "border-collapse: separate;";
        $template .= "mso-table-lspace: 0pt;";
        $template .= "mso-table-rspace: 0pt;";
        $template .= "width: 100%; }";
        $template .= "table td {";
        $template .= "font-family: sans-serif;";
        $template .= "font-size: 14px;";
        $template .= "vertical-align: top;";
        $template .= "}";
        $template .= ".body {";
        $template .= "background-color: #f6f6f6;";
        $template .= "width: 100%;";
        $template .= "}";
        $template .= ".container {";
        $template .= "display: block;";
        $template .= "margin: 0 auto !important;";
        $template .= "max-width: 580px;";
        $template .= "padding: 10px;";
        $template .= "width: 580px;";
        $template .= "}";
        $template .= ".content {";
        $template .= "box-sizing: border-box;";
        $template .= "display: block;";
        $template .= "margin: 0 auto;";
        $template .= "max-width: 580px;";
        $template .= "padding: 10px;";
        $template .= "}";
        $template .= ".main {";
        $template .= "background: #ffffff;";
        $template .= "border-radius: 3px;";
        $template .= "width: 100%;";
        $template .= "}";
        $template .= ".wrapper {";
        $template .= "box-sizing: border-box;";
        $template .= "padding: 20px;";
        $template .= "}";
        $template .= ".content-block {";
        $template .= "padding-bottom: 10px;";
        $template .= "padding-top: 10px;";
        $template .= "}";
        $template .= "clear: both;";
        $template .= "margin-top: 10px;";
        $template .= "text-align: center;";
        $template .= "width: 100%;";
        $template .= "}";
        $template .= ".footer td,";
        $template .= ".footer p,";
        $template .= ".footer span,";
        $template .= ".footer a {";
        $template .= "color: #999999;";
        $template .= "font-size: 12px;";
        $template .= "text-align: center;";
        $template .= "}";
        $template .= "h1, h2, h3, h4 {";
        $template .= "color: #000000;";
        $template .= "font-family: sans-serif;";
        $template .= "font-weight: 400;";
        $template .= "line-height: 1.4;";
        $template .= "margin: 0;";
        $template .= "margin-bottom: 30px;";
        $template .= "}";
        $template .= "h1 {";
        $template .= "font-size: 35px;";
        $template .= "font-weight: 300;";
        $template .= "text-align: center;";
        $template .= "text-transform: capitalize;";
        $template .= "}";
        $template .= "p, ul, ol {";
        $template .= "font-family: sans-serif;";
        $template .= "font-size: 14px;";
        $template .= "font-weight: normal;";
        $template .= "margin: 0;";
        $template .= "margin-bottom: 15px;";
        $template .= "}";
        $template .= "p li,";
        $template .= "ul li,";
        $template .= "ol li {";
        $template .= "list-style-position: inside;";
        $template .= "margin-left: 5px;";
        $template .= "}";
        $template .= "a {";
        $template .= "color: #3498db;";
        $template .= "text-decoration: underline;";
        $template .= "}";
        $template .= ".btn {";
        $template .= "box-sizing: border-box;";
        $template .= "width: 100%; }";
        $template .= ".btn > tbody > tr > td {";
        $template .= "padding-bottom: 15px; }";
        $template .= ".btn table {";
        $template .= "width: auto;";
        $template .= "}";
        $template .= ".btn table td {";
        $template .= "background-color: #ffffff;";
        $template .= "border-radius: 5px;";
        $template .= "text-align: center;";
        $template .= "}";
        $template .= ".btn a {";
        $template .= "background-color: #ffffff;";
        $template .= "border: solid 1px #3498db;";
        $template .= "border-radius: 5px;";
        $template .= "box-sizing: border-box;";
        $template .= "color: #3498db;";
        $template .= "cursor: pointer;";
        $template .= "display: inline-block;";
        $template .= "font-size: 14px;";
        $template .= "font-weight: bold;";
        $template .= "margin: 0;";
        $template .= "padding: 12px 25px;";
        $template .= "text-decoration: none;";
        $template .= "text-transform: capitalize;";
        $template .= "}";
        $template .= ".btn-primary table td {";
        $template .= "background-color: #3498db;";
        $template .= "}";
        $template .= ".btn-primary a {";
        $template .= "background-color: #3498db;";
        $template .= "border-color: #3498db;";
        $template .= "color: #ffffff;";
        $template .= "}";
        $template .= ".last {";
        $template .= "margin-bottom: 0;";
        $template .= "}";
        $template .= ".first {";
        $template .= "margin-top: 0;";
        $template .= "}";
        $template .= ".align-center {";
        $template .= "text-align: center;";
        $template .= "}";
        $template .= ".align-right {";
        $template .= "text-align: right;";
        $template .= "}";
        $template .= ".align-left {";
        $template .= "text-align: left;";
        $template .= "}";
        $template .= ".clear {";
        $template .= "clear: both;";
        $template .= "}";
        $template .= ".mt0 {";
        $template .= "margin-top: 0;";
        $template .= "}";
        $template .= ".mb0 {";
        $template .= "margin-bottom: 0;";
        $template .= "}";
        $template .= ".preheader {";
        $template .= "color: transparent;";
        $template .= "display: none;";
        $template .= "height: 0;";
        $template .= "max-height: 0;";
        $template .= "max-width: 0;";
        $template .= "opacity: 0;";
        $template .= "overflow: hidden;";
        $template .= "mso-hide: all;";
        $template .= "visibility: hidden;";
        $template .= "width: 0;";
        $template .= "}";
        $template .= ".powered-by a {";
        $template .= "text-decoration: none;";
        $template .= "}";
        $template .= "hr {";
        $template .= "border: 0;";
        $template .= "border-bottom: 1px solid #f6f6f6;";
        $template .= "margin: 20px 0;";
        $template .= "}";
        $template .= "@media only screen and (max-width: 620px) {";
        $template .= "table[class=body] h1 {";
        $template .= "font-size: 28px !important;";
        $template .= "margin-bottom: 10px !important;";
        $template .= "}";
        $template .= "table[class=body] p,";
        $template .= "table[class=body] ul,";
        $template .= "table[class=body] ol,";
        $template .= "table[class=body] td,";
        $template .= "table[class=body] span,";
        $template .= "table[class=body] a {";
        $template .= "font-size: 16px !important;";
        $template .= "}";
        $template .= "table[class=body] .wrapper,";
        $template .= "table[class=body] .article {";
        $template .= "padding: 10px !important;";
        $template .= "}";
        $template .= "table[class=body] .content {";
        $template .= "padding: 0 !important;";
        $template .= "}";
        $template .= "table[class=body] .container {";
        $template .= "padding: 0 !important;";
        $template .= "width: 100% !important;";
        $template .= "}";
        $template .= "table[class=body] .main {";
        $template .= "border-left-width: 0 !important;";
        $template .= "border-radius: 0 !important;";
        $template .= "border-right-width: 0 !important;";
        $template .= "}";
        $template .= "table[class=body] .btn table {";
        $template .= "width: 100% !important;";
        $template .= "}";
        $template .= "table[class=body] .btn a {";
        $template .= "width: 100% !important;";
        $template .= "}";
        $template .= "table[class=body] .img-responsive {";
        $template .= "height: auto !important;";
        $template .= "max-width: 100% !important;";
        $template .= "width: auto !important;";
        $template .= "}";
        $template .= "}";
        $template .= "@media all {";
        $template .= ".ExternalClass {";
        $template .= "width: 100%;";
        $template .= "}";
        $template .= ".ExternalClass,";
        $template .= ".ExternalClass p,";
        $template .= ".ExternalClass span,";
        $template .= ".ExternalClass font,";
        $template .= ".ExternalClass td,";
        $template .= ".ExternalClass div {";
        $template .= "line-height: 100%;";
        $template .= "}";
        $template .= ".apple-link a {";
        $template .= "color: inherit !important;";
        $template .= "font-family: inherit !important;";
        $template .= "font-size: inherit !important;";
        $template .= "font-weight: inherit !important;";
        $template .= "line-height: inherit !important;";
        $template .= "text-decoration: none !important;";
        $template .= "}";
        $template .= "#MessageViewBody a {";
        $template .= "color: inherit;";
        $template .= "text-decoration: none;";
        $template .= "font-size: inherit;";
        $template .= "font-family: inherit;";
        $template .= "font-weight: inherit;";
        $template .= "line-height: inherit;";
        $template .= "}";
        $template .= ".btn-primary table td:hover {";
        $template .= "background-color: #34495e !important;";
        $template .= "}";
        $template .= ".btn-primary a:hover {";
        $template .= "background-color: #34495e !important;";
        $template .= "border-color: #34495e !important;";
        $template .= "}";
        $template .= "}";
        $template .= "</style>";
        $template .= "</head>";
        $template .= "<body class=''>";
        $template .= "<span class='preheader'><b>$site_title</b>, $tagline";
        $template .= "<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>";
        $template .= "<tr>";
        $template .= "<td>&nbsp;</td>";
        $template .= "<td class='container'>";
        $template .= "<div class='content'>";
        $template .= "<table width='100%' role='presentation' border='0' cellpadding='0' cellspacing='0'>";
        $template .= "<tr>";
        $template .= "<td align='center' style='background-color:#5e76ac; padding:15px 0px;'>";
        $template .= "<img src='".base_url()."assets/general/images/logo.png'>";
        $template .= "</td>";
        $template .= "</tr>";
        $template .= "</table>";
        $template .= "<!-- START CENTERED WHITE CONTAINER -->";
        $template .= "<table role='presentation' class='main'>";
        $template .= "<!-- START MAIN CONTENT AREA -->";
        $template .= "<tr>";
        $template .= "<td class='wrapper'>";
        $template .= "<table role='presentation' border='0' cellpadding='0' cellspacing='0'>";
        $template .= "<tr>";
        $template .= "<td>";
        $template .= "<p><b>Hi [NAME],</b></p>";
        $template .= "<p>[TEXT]</p>";
        $template .= "<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary'>";
        $template .= "<tbody>";
        $template .= "<tr>";
        $template .= "<td align='left'>";
        $template .= "<table role='presentation' border='0' cellpadding='0' cellspacing='0'>";
        $template .= "<tbody>";
        $template .= "<tr>";
        $template .= "<td> [BUTTON] </td>";
        $template .= "</tr>";
        $template .= "</tbody>";
        $template .= "</table>";
        $template .= "</td>";
        $template .= "</tr>";
        $template .= "</tbody>";
        $template .= "</table>";
        $template .= "<p>[ADDITIONAL_TEXT]</p>";
        $template .= "<p>Support Team</p>";
        $template .= "</td>";
        $template .= "</tr>";
        $template .= "</table>";
        $template .= "</td>";
        $template .= "</tr>";
        $template .= "<!-- END MAIN CONTENT AREA -->";
        $template .= "</table>";
        $template .= "<!-- END CENTERED WHITE CONTAINER -->";
        $template .= "<!-- START FOOTER -->";
        $template .= "<div class='footer'>";
        $template .= "<table role='presentation' border='0' cellpadding='0' cellspacing='0'>";
        $template .= "<tr>";
        $template .= "<td class='content-block' align='center'>";
        $template .= "<span class='apple-link'>We really appreciate your patronage and we are open to serving you better.</span>";
        $template .= "<br> $site_title Support Team";
        $template .= "</td>";
        $template .= "</tr>";
        $template .= "<tr>";
        $template .= "<td class='content-block powered-by' align='center'>";
        $template .= "Powered by <a href='$site_url'>$site_title</a>.";
        $template .= "</td>";
        $template .= "</tr>";
        $template .= "</table>";
        $template .= "</div>";
        $template .= "<!-- END FOOTER -->";
        $template .= "</div>";
        $template .= "</td>";
        $template .= "<td>&nbsp;</td>";
        $template .= "</tr>";
        $template .= "</table>";
        $template .= "</body>";
        $template .= "</html>";

        return $template;
    }

    public function send_notification ($heading, $text, $btn, $additional, $first="Ava Links") {
        $to = $this->Util_model->get_option("notification_email");

        $message = "<p>$text</p>";
        $message .= $btn."<br>";
        $message .= $additional;

        return $this->Util_model->send_mail($this->Util_model->get_option('site_email'), $to, $heading, $message);
    }

}